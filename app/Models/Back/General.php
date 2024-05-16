<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'landing_image',
        'email',
        'phone_number',
        'address',
        'created_at',
        'updated_at',
    ];
}
