<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'device_unique_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'accesses');
    }

}
