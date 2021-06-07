<?php

namespace App\Models\OJS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function publications()
    {
        return $this->setConnection('i-edu.uz')->hasMany(Publication::class, 'publication_id', 'publication_id')
            ->with(['settings', 'citations']);
    }
}
