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
use Juzaweb\Core\DataTables\Action;
use Juzaweb\Core\DataTables\BulkAction;
use Juzaweb\Core\DataTables\Column;
use Juzaweb\Core\DataTables\DataTable;
use Juzaweb\Modules\Contact\Models\Contact;

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
            Column::editLink('subject', admin_url('contacts/{id}/edit'), __('Title')),
            Column::make('name', __('Name')),
            Column::make('status', __('Status'))->center()->width(100),
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
