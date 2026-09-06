<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'title',
        'email',
        'emp_status',
        'department_id',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => trim(($attributes['first_name'] ?? '') . ' ' . ($attributes['last_name'] ?? '')),
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['emp_status'] ?? null,
        );
    }
}
