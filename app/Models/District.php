<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    // protected $table = 'districts';
    protected $fillable = ['code', 'name', 'province_code'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_code');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'district_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'district_id');
    }
}
