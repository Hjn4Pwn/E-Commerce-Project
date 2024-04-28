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
}
