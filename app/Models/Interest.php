<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    // В твоей миграции колонка называется 'name', исправлено!
    protected $fillable = [
        'user_id',
        'name',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --- SCOPES ---

    // Scope: Сортировка от новых к старым
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
