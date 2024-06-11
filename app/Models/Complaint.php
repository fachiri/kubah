<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_role',
        'ktp',
        'category',
        'status',
        'description',
        'location',
        'incident_date',
        'incident_time',
        'user_id',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
            $model->ulid = Str::ulid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(Evidence::class);
    }
}
