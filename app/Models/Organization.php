<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function contact()
    {
        return $this->hasOne(Contact::class, 'owner_id');
    }
}
