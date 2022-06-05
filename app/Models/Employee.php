<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'sex',
        'area_id',
        'bulletin',
        'description'
    ];

    protected $appends = [
        'BulletinLabel'
    ];

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('email', $search_term)
            ->orWhere('sex', $search_term)
            ->orWhere('name', 'like', '%' . $search_term . '%');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_roles');
    }

    public function getBulletinLabelAttribute()
    {
        switch ($this->bulletin) {
            case true:
                return 'SI';
            case false:
                return 'NO';
            default:
                return $this->bulletin;
        }
    }
}
