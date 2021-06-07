<?php

namespace App\Models\OJS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    public function publication()
    {
        return $this->setConnection('i-edu.uz')->belongsTo(Publication::class, 'publication_id', 'publication_id');
    }
}

