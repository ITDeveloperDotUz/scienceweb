<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublonsProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'citations_per_year', 'per_month_graph', 'publication_stats', 'per_year_graph', 'institutions',
        'researchFields', 'publons_user_id', 'publons_user_name', 'avatar', 'citations', 'publications_count',
        'h_index', 'average_per_year', 'average_per_item'
    ];

}
