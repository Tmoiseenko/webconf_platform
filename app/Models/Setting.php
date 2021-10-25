<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Setting extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title',
        'description',
        'iframe_link',
        'start_time',
        'end_time',
    ];
}
