<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone'
    ];


    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search'])) {
            $query->where('first_name', 'like', '%' . $filters['search'] . '%');
            $query->orWhere('last_name', 'like', '%' . $filters['search'] . '%');
            $query->orWhere('email', 'like', '%' . $filters['search'] . '%');
            $query->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            $query->orWhereHas('company', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%');
                $query->where('email', 'like', '%' . $filters['search'] . '%');
                $query->where('website', 'like', '%' . $filters['search'] . '%');
            });
        }
        return $query;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
