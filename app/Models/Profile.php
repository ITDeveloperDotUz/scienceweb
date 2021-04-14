<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = ['public_name','swaid', 'orcid', 'avatar', 'work_org', 'work_dep',
                            'work_job', 'bio', 'address_1', 'address_2', 'keywords', 'social_links',
                            'is_public', 'h_index','i10_index','rating', 'birth_date', 'filled'];

    protected $guarded = ['*'];
}
