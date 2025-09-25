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
use Juzaweb\Modules\Contact\Models\Contact;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'name' => ['required', 'string', 'max:200'],
			'email' => ['required', 'email'],
			'phone' => ['nullable', 'string', 'max:20'],
			'subject' => ['required', 'string', 'max:200'],
			'message' => ['required'],
		];
    }

    public function save()
    {
        Contact::create($this->validated());
    }
}
