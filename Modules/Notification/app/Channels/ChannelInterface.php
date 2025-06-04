<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;

interface ChannelInterface
{
    /**
     * Send the notification through the channel.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return mixed
     */
    public function send($notifiable, Notification $notification);
    
    /**
     * Check if the channel is available/enabled for a notifiable entity.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return bool
     */
    public function isAvailable($notifiable, Notification $notification): bool;
    
    /**
     * Return the unique name of the channel.
     *
     * @return string
     */
    public function getName(): string;
} 