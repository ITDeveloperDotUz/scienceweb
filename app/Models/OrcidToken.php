<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcidToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token', 'token_type', 'refresh_token', 'expires_in', 'scope', 'name', 'orcid'
    ];

    protected $guarded = ['*'];
}
