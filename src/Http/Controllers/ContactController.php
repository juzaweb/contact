<?php

namespace Juzaweb\Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Juzaweb\Core\Facades\Breadcrumb;
use Juzaweb\Core\Http\Controllers\AdminController;
use Juzaweb\Core\Http\Requests\BulkActionsRequest;
use Juzaweb\Modules\Contact\Enums\ContactStatus;
use Juzaweb\Modules\Contact\Http\DataTables\ContactsDataTable;
use Juzaweb\Modules\Contact\Http\Requests\ContactRequest;
use Juzaweb\Modules\Contact\Models\Contact;

class ContactController extends AdminController
{
    public function index(ContactsDataTable $dataTable)
    {
        Breadcrumb::add(__('Contacts'));

        return $dataTable->render(
            'contact::contact.index'
        );
    }

    public function edit(string $id)
    {
        Breadcrumb::add(__('Contacts'), action([self::class, 'index']));
        
        $contact = Contact::findOrFail($id);
        
        Breadcrumb::add(__('Contact :name', ['name' => $contact->subject]));
        
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
            'message' => __('Contact created successfully!'),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update([
            'status' => ContactStatus::from($request->input('status')),
        ]);

        return $this->success([
            'message' => __('Contact updated successfully!'),
        ]);
    }

    public function bulk(BulkActionsRequest $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if ($action == 'delete') {
            Contact::whereIn('id', $ids)->get()->each(fn ($item) => $item->delete());
        }

        return $this->success([
            'message' => __('Deleted successfully!'),
        ]);
    }
}
