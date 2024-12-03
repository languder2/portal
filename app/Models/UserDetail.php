<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'users_details';

    protected $fillable = [
        'uid',
        'snils',
        'citizenship',
        'document_type',
        'document_serial',
        'document_number',
        'document_issue_date',
        'document_issue_whom',
        'document_issue_whom_code',
        'address',
        'residence_address',
        'inn',
        'sex',
        'birthday',
        'phone',
    ];
}
