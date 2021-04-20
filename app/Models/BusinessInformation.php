<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInformation extends Model
{
    use HasFactory;

    protected $table = "business_informations";

    protected $fillable = [
        'name',
        'email',
        'contactNumber',
        'address',
        'city',
        'logo_path',
        'google_map_src',
        'display',
    ];
}
