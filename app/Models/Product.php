<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'category' => 10,
            'name' => 10,
            'details' => 5,
            'description' => 2,
        ],
    ];

    protected $fillable = [
        'category',
        'name',
        'price',
        'units',
        'details',
        'description',
        'image_path',
    ];
}
