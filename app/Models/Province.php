<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    // protected $table = 'provinces';
    protected $fillable = ['code', 'name'];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_code', 'code');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'province_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'province_id');
    }
}
