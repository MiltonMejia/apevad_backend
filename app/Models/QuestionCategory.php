<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
