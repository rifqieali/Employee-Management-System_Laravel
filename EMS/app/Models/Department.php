<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = [
        'dept_name',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}
