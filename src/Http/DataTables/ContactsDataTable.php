<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 */

namespace Juzaweb\Modules\Contact\Http\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Juzaweb\Modules\Contact\Models\Contact;
use Juzaweb\Modules\Core\DataTables\Action;
use Juzaweb\Modules\Core\DataTables\BulkAction;
use Juzaweb\Modules\Core\DataTables\Column;
use Juzaweb\Modules\Core\DataTables\DataTable;

class ContactsDataTable extends DataTable
{
    protected string $actionUrl = 'contacts/bulk';

    public function query(Contact $model): QueryBuilder
    {
        return $model->newQuery()->filter(request()->all());
    }

    public function getColumns(): array
    {
        return [
            Column::checkbox(),
            Column::id(),
            Column::editLink('subject', admin_url('contacts/{id}/edit'), __('contact::translation.title')),
            Column::make('name', __('contact::translation.name')),
            Column::make('email', __('contact::translation.email')),
            Column::make('phone', __('contact::translation.phone')),
            Column::make('status', __('contact::translation.status'))->center()->width(100),
            Column::createdAt(),
            Column::actions(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            BulkAction::delete()->can('contacts.delete'),
        ];
    }

    public function actions(Model $model): array
    {
        return [
            Action::edit(admin_url("contacts/{$model->id}/edit"))
                ->can('contacts.edit'),
            Action::delete()
                ->can('contacts.delete'),
        ];
    }
}
