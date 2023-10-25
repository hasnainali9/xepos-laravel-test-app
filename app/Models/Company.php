<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'logo',
        'website'
    ];


    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
            $query->orWhere('email', 'like', '%' . $filters['search'] . '%');
            $query->orWhere('website', 'like', '%' . $filters['search'] . '%');
        }
        return $query;
    }


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }




}
