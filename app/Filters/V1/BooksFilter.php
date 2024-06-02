<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class BooksFilter extends ApiFilter{
    protected $allowedParms = [
        'title' => ['eq', 'like'],
        'publicationDate' => ['eq', 'gte', 'lte'],
        'genre' => ['eq'],
        'price' => ['eq', 'gte', 'lte', 'gt', 'lt'],
        'summary' => ['like']
    ];
    
    protected $columnMap = [
        'publicationDate' => 'publication_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gte' => '>=',
        'lte' => '<=',
        'like' => 'like',
        'gt' => '>',
        'lt' => '<'
    ];
}