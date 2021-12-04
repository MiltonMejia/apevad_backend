<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'firstName',
        'lastName',
        'password',
        'group_id',
        'isSurveyCompleted'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function administrativeSurveys(): HasMany
    {
        $relation =  $this->hasMany(AdministrativeSurvey::class);
        return $relation->with('administrative', 'student', 'question')->orderBy('id', 'asc');
    }

    public function lastAdministrativeSurvey(): HasOne
    {
        return $this->hasOne(AdministrativeSurvey::class)->orderBy('id', 'desc');
    }

    public function teacherSurveys(): HasMany
    {
        $relation = $this->hasMany(TeacherSurvey::class);
        return $relation->with('teacher', 'student', 'question')->orderBy('id', 'asc');
    }

    public function lastTeacherSurvey(): HasOne
    {
        return $this->hasOne(TeacherSurvey::class)->orderBy('id', 'desc');
    }
}
