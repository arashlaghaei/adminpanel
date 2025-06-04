<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class NotificationRateLimit extends Model
{
    protected $table = 'notification_rate_limits';
    
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'notification_type',
        'channel',
        'count',
        'date'
    ];
    
    protected $casts = [
        'count' => 'integer',
        'date' => 'date',
    ];
    
    /**
     * Get the notifiable entity that the rate limit belongs to.
     */
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Increment the rate limit counter for a specific notification and channel.
     */
    public static function incrementRate($notifiable, string $notificationType, string $channel): self
    {
        $today = now()->toDateString();
        
        $rateLimit = self::firstOrNew([
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->getKey(),
            'notification_type' => $notificationType,
            'channel' => $channel,
            'date' => $today,
        ]);
        
        $rateLimit->count = ($rateLimit->count ?? 0) + 1;
        $rateLimit->save();
        
        return $rateLimit;
    }
    
    /**
     * Check if a notification type has reached its rate limit for a notifiable entity.
     */
    public static function hasReachedLimit($notifiable, string $notificationType, string $channel): bool
    {
        $today = now()->toDateString();
        
        $rateLimit = self::where([
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->getKey(),
            'notification_type' => $notificationType,
            'channel' => $channel,
            'date' => $today,
        ])->first();
        
        if (!$rateLimit) {
            return false;
        }
        
        // Get the max allowed notifications from config
        $typeSpecificLimit = config("notification.rate_limits.types.{$notificationType}", null);
        $defaultLimit = config('notification.rate_limits.default', 10);
        $maxAllowed = $typeSpecificLimit ?? $defaultLimit;
        
        return $rateLimit->count >= $maxAllowed;
    }
    
    /**
     * Reset all rate limits for a specific date (useful for testing).
     */
    public static function resetForDate(string $date = null): void
    {
        $date = $date ?? now()->toDateString();
        
        self::where('date', $date)->update(['count' => 0]);
    }
} 