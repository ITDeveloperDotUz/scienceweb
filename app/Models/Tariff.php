<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'period', 'description', 'amount', 'expiration', 'status'];

    public function users(){
        return $this->belongsToMany(User::class, 'tariffs_users', 'tariff_id', 'user_id');
    }
}
