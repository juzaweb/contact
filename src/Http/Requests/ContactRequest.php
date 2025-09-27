<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 */

namespace Juzaweb\Modules\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Notification;
use Juzaweb\Modules\Contact\Models\Contact;
use Juzaweb\Modules\Contact\Notifications\ThankNotification;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'name' => ['required', 'string', 'max:200'],
			'email' => ['required', 'email:rfc,dns'],
			'phone' => ['nullable', 'string', 'max:20'],
			'subject' => ['required', 'string', 'max:200'],
			'message' => ['required'],
		];
    }

    public function save()
    {
        $contact = Contact::create(
            [
                ...$this->validated(),
                'ip_address' => $this->ip(),
                'user_agent' => $this->userAgent(),
                'created_by_id' => $this->user()?->id,
                'created_by_type' => $this->user()?->getMorphClass(),
            ]
        );

        Notification::route('mail', $contact->email)
            ->notify(new ThankNotification($contact));
    }
}
