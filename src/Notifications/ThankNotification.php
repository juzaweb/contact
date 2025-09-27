<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\Modules\Contact\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Juzaweb\Modules\Contact\Models\Contact;

class ThankNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Contact $contact)
    {
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Thank you for contacting us'))
            ->greeting(__('Hello!') .' '. $this->contact->name)
            ->line('We have received your message. We will get back to you shortly.')
            ->line('Thank you for using ' . setting('sitename', 'our application') . '!');
    }
}
