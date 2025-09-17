<?php

namespace Juzaweb\Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Juzaweb\Core\Facades\Breadcrumb;
use Juzaweb\Core\Http\Controllers\AdminController;
use Juzaweb\Modules\Blog\Http\DataTables\ContactsDataTable;
use Juzaweb\Modules\Contact\Models\Contact;

class ContactController extends AdminController
{
    public function index(ContactsDataTable $dataTable)
    {
        Breadcrumb::add(__('Contacts'));

        return $dataTable->render(
            'contact::index'
        );
    }

    public function create()
    {
        Breadcrumb::add(__('Contacts'), action([self::class, 'index']));

        Breadcrumb::add(__('Create New Contact'));

        $locale = $this->getFormLanguage();

        return view(
            'contact::create',
            [
                'model' => new Contact(),
                'action' => action([self::class, 'store']),
                'locale' => $locale,
            ]
        );
    }

    public function edit(string $id)
    {
        Breadcrumb::add(__('Contacts'), action([self::class, 'index']));
        Breadcrumb::add(__('Edit Contact'));

        $contact = Contact::findOrFail($id);
        $locale = $this->getFormLanguage();

        return view(
            'contact::edit',
            [
                'model' => $contact,
                'action' => action([self::class, 'update'], $id),
                'locale' => $locale,
            ]
        );
    }
}
