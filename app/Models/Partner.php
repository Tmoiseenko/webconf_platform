<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Partner extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'partner_id',
        'title',
        'about',
        'link',
        'image_id',
        'order',
    ];

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }
}
