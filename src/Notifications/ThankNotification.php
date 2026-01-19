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
            ->subject(__('contact::translation.thank_you_for_contacting_us'))
            ->greeting(__('contact::translation.hello') .' '. $this->contact->name)
            ->line(__('contact::translation.we_have_received_your_message_we_will_get_back_to_you_shortly'))
            ->line(__('contact::translation.thank_you_for_using_sitename', ['sitename' => setting('sitename', 'our application')]));
    }
}
