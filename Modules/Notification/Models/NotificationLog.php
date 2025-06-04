<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Core\Libraries\Traits\Scopes;

class NotificationLog extends Model
{
    use SoftDeletes, Scopes;
    
    protected $table = 'notification_logs';
    
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'notification_type',
        'channel',
        'data',
        'status',
        'error',
        'attempts',
        'read_at',
        'sent_at',
        'scheduled_for'
    ];
    
    protected $casts = [
        'data' => 'array',
        'attempts' => 'integer',
        'read_at' => 'datetime',
        'sent_at' => 'datetime',
        'scheduled_for' => 'datetime',
    ];
    
    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_READ = 'read';
    const STATUS_FAILED = 'failed';
    
    /**
     * Get the notifiable entity that the notification belongs to.
     */
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Scope a query to only include pending notifications.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }
    
    /**
     * Scope a query to only include failed notifications.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }
    
    /**
     * Scope a query to only include sent notifications.
     */
    public function scopeSent($query)
    {
        return $query->where('status', self::STATUS_SENT);
    }
    
    /**
     * Scope a query to only include notifications that need to be sent now.
     */
    public function scopeScheduledNow($query)
    {
        return $query->where('status', self::STATUS_PENDING)
            ->where(function($q) {
                $q->whereNull('scheduled_for')
                  ->orWhere('scheduled_for', '<=', now());
            });
    }
    
    /**
     * Mark notification as sent.
     */
    public function markAsSent(): self
    {
        $this->status = self::STATUS_SENT;
        $this->sent_at = now();
        $this->save();
        
        return $this;
    }
    
    /**
     * Mark notification as delivered.
     */
    public function markAsDelivered(): self
    {
        $this->status = self::STATUS_DELIVERED;
        $this->save();
        
        return $this;
    }
    
    /**
     * Mark notification as read.
     */
    public function markAsRead(): self
    {
        $this->status = self::STATUS_READ;
        $this->read_at = now();
        $this->save();
        
        return $this;
    }
    
    /**
     * Mark notification as failed with an error message.
     */
    public function markAsFailed(?string $error = null): self
    {
        $this->status = self::STATUS_FAILED;
        if ($error) {
            $this->error = $error;
        }
        $this->attempts += 1;
        $this->save();
        
        return $this;
    }
    
    /**
     * Check if the notification can be retried.
     */
    public function canRetry(): bool
    {
        $maxAttempts = config('notification.retry.max_attempts', 3);
        return $this->status === self::STATUS_FAILED && $this->attempts < $maxAttempts;
    }

    public function scopeSearch($query)
    {
        $this->scopeBasicSearch($query);

        $request = request();
        if ($request->has('query')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('id', 'like', "%{$request->input('query')}%");
                $query->orWhere('notification_type', 'like', "%{$request->input('query')}%");
                $query->orWhere('channel', 'like', "%{$request->input('query')}%");
            });
        }

        return $query;
    }

} 