<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Program extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'author',
        'image_id',
        'topic',
        'vip',
        'started_at',
        'finished_at',
    ];

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }

    public function partner() {
        return $this->belongsTo('App\Models\Partner');
    }
}
