<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    protected $table = 'notification_preferences';
    
    protected $fillable = [
        'user_id', 
        'notification_type', 
        'channels', 
        'is_enabled'
    ];
    
    protected $casts = [
        'channels' => 'array',
        'is_enabled' => 'boolean',
    ];
    
    /**
     * Get the user that owns this preference.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
    
    /**
     * Check if notification is enabled for a specific channel.
     */
    public function isEnabledForChannel(string $channel): bool
    {
        if (!$this->is_enabled) {
            return false;
        }
        
        return in_array($channel, $this->channels);
    }
    
    /**
     * Enable a channel for this notification preference.
     */
    public function enableChannel(string $channel): self
    {
        if (!in_array($channel, $this->channels)) {
            $channels = $this->channels;
            $channels[] = $channel;
            $this->channels = $channels;
            $this->save();
        }
        
        return $this;
    }
    
    /**
     * Disable a channel for this notification preference.
     */
    public function disableChannel(string $channel): self
    {
        if (in_array($channel, $this->channels)) {
            $this->channels = array_diff($this->channels, [$channel]);
            $this->save();
        }
        
        return $this;
    }
} 