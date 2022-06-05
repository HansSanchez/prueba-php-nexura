<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('name', 'like', '%' . $search_term . '%');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_roles');
    }
}
