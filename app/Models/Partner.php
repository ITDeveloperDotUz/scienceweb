<?php

namespace App\Models;

use App\Models\DBConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $connectionCredentials = [];

    public function databaseConnection()
    {
        return $this->hasOne(DBConnection::class, 'connection', 'connection');
    }
}
