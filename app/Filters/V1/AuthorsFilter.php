<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AuthorsFilter extends ApiFilter{
    protected $allowedParms = [
        'name' => ['eq', 'like'],
        'nationality' => ['eq'],
        'birthDate' => ['eq', 'gte', 'lte']
    ];

    protected $columnMap = [
        'birthDate' => 'birth_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gte' => '>=',
        'lte' => '<=',
        'like' => 'like'
    ];
}