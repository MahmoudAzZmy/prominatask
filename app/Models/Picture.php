<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Picture extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'name',
        'album_id',
        'pic'
    ];

    public function pic()
    {
        $media = Media::where('collection_name', 'pics_js')->where('model_id', $this->id)->first();
        return $media;
    }
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
    
}
