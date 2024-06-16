<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'is_featured',
        'user_id'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function booted() {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
