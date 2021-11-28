<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'semester',
        'degree_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
