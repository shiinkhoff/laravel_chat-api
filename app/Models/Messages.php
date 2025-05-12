<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'image_url',
        'is_read'
    ];

    // Relasi ke Conversation
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // Relasi ke User sebagai pengirim
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
