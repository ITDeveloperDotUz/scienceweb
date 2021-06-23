<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleScholarProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'citations', 'citations_five_year', 'h_index', 'h_index_five_year',
        'i10_index', 'i10_index_five_year', 'by_year', 'gs_user_id', 'name', 'organization',
        'domain', 'interests', 'avatar'
    ];

    public function refresh()
    {

    }
}
