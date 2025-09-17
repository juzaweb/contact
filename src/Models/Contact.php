<?php

namespace Juzaweb\Modules\Contact\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Juzaweb\Core\Models\Model;
use Juzaweb\Core\Traits\HasAPI;

class Contact extends Model
{
    use HasAPI, HasUuids;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'created_by_id',
        'created_by_type',
    ];

    public function createdBy()
    {
        return $this->morphTo();
    }
}
