<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Libraries\Traits\Scopes;

class NotificationTemplate extends Model
{
    use Scopes;
    protected $table = 'notification_templates';
    
    protected $fillable = [
        'name',
        'key',
        'notification_type',
        'channels',
        'content',
        'actions',
        'is_active'
    ];
    
    protected $casts = [
        'channels' => 'array',
        'content' => 'array',
        'actions' => 'array',
        'is_active' => 'boolean',
    ];
    
    /**
     * Scope a query to only include active templates.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Get template content for a specific channel and language.
     */
    public function getContent(string $channel, string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        // اگر کانال وجود نداشت
        if (!isset($this->content[$channel])) {
            return null;
        }

        $channelContent = $this->content[$channel];

        // حالت: محتوای تک‌زبانه (string)
        if (is_string($channelContent)) {
            return $channelContent;
        }

        // حالت: محتوای چندزبانه (array)
        if (is_array($channelContent)) {
            // اگر زبان فعلی موجود بود
            if (isset($channelContent[$locale])) {
                return $channelContent[$locale];
            }

            // اگر fallback_locale تنظیم شده بود
            $defaultLocale = config('app.fallback_locale', 'en');
            return $channelContent[$defaultLocale] ?? null;
        }

        // هیچ حالتی سازگار نبود
        return null;
    }
    
    /**
     * Get template actions for a specific channel and language.
     */
    public function getActions(string $channel, string $locale = null): ?array
    {
        $locale = $locale ?? app()->getLocale();
        
        if (!isset($this->actions[$channel])) {
            return null;
        }
        
        if (isset($this->actions[$channel][$locale])) {
            return $this->actions[$channel][$locale];
        }
        
        // Fallback to default locale
        $defaultLocale = config('app.fallback_locale', 'en');
        return $this->actions[$channel][$defaultLocale] ?? null;
    }
    
    /**
     * Check if template supports a specific channel.
     */
    public function supportsChannel(string $channel): bool
    {
        return in_array($channel, $this->channels);
    }
    
    /**
     * Set content for a specific channel and locale.
     */
    public function setContentForChannel(string $channel, string $locale, string $content): self
    {
        $contentArray = $this->content ?? [];
        $contentArray[$channel][$locale] = $content;
        $this->content = $contentArray;
        
        // Ensure the channel is in the channels array
        if (!in_array($channel, $this->channels)) {
            $channels = $this->channels ?? [];
            $channels[] = $channel;
            $this->channels = $channels;
        }
        
        return $this;
    }
    
    /**
     * Set actions for a specific channel and locale.
     */
    public function setActionsForChannel(string $channel, string $locale, array $actions): self
    {
        $actionsArray = $this->actions ?? [];
        $actionsArray[$channel][$locale] = $actions;
        $this->actions = $actionsArray;
        
        return $this;
    }
} 