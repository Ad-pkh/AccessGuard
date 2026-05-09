<?php

declare(strict_types=1);

namespace Modules\Company\Infrastructure\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'address',
        'status',
    ];
}
