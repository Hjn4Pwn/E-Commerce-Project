<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    // protected $table = 'wards';
    protected $fillable = ['code', 'name', 'district_code'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'ward_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'ward_id');
    }
}
