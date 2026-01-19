<?php

namespace Juzaweb\Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Juzaweb\Modules\Contact\Enums\ContactStatus;
use Juzaweb\Modules\Contact\Http\DataTables\ContactsDataTable;
use Juzaweb\Modules\Contact\Http\Requests\ContactRequest;
use Juzaweb\Modules\Contact\Models\Contact;
use Juzaweb\Modules\Core\Facades\Breadcrumb;
use Juzaweb\Modules\Core\Http\Controllers\AdminController;
use Juzaweb\Modules\Core\Http\Requests\BulkActionsRequest;

class ContactController extends AdminController
{
    public function index(ContactsDataTable $dataTable)
    {
        Breadcrumb::add(__('contact::translation.contacts'));

        return $dataTable->render(
            'contact::contact.index'
        );
    }

    public function edit(string $id)
    {
        Breadcrumb::add(__('contact::translation.contacts'), action([self::class, 'index']));

        $contact = Contact::findOrFail($id);

        Breadcrumb::add(__('contact::translation.contact_name', ['name' => $contact->subject]));

        $locale = $this->getFormLanguage();

        return view(
            'contact::contact.form',
            [
                'model' => $contact,
                'action' => action([self::class, 'update'], [$id]),
                'locale' => $locale,
            ]
        );
    }

    public function store(ContactRequest $request)
    {
        $request->save();

        return $this->success([
            'message' => __('contact::translation.contact_created_successfully'),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', Rule::enum(ContactStatus::class)],
        ]);

        $contact = Contact::findOrFail($id);

        $contact->update([
            'status' => ContactStatus::from($request->input('status')),
        ]);

        return $this->success([
            'message' => __('contact::translation.contact_updated_successfully'),
        ]);
    }

    public function bulk(BulkActionsRequest $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if ($action == 'delete') {
            Contact::whereIn('id', $ids)->get()->each(fn($item) => $item->delete());
        }

        return $this->success([
            'message' => __('contact::translation.deleted_successfully'),
        ]);
    }
}
