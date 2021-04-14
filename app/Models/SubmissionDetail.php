<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['submission_id', 'locale', 'key', 'value'];
}
