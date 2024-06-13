<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'is_anonim',
        'status',
        'common_user_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->common_user_id = auth()->user()->common_user->id;
            $model->ulid = Str::ulid();
        });
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function common_user(): BelongsTo
    {
        return $this->belongsTo(CommonUser::class);
    }
}
