<?php

namespace App\Notifications;

use App\Models\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportantStockUpdate extends Notification
{
    use Queueable;

    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject('Important Stock Update for ' . $this->stock->product->name)
            ->line('We have an important update to the product you have been tracking.')
            ->action('Buy It Now', url($this->stock->url))
            ->line('Go get it!');
    }
}
