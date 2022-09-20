<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *@property string id
 *@property string title
 *@property string body
 *
 *@property Carbon created_at
 *@property Carbon updated_at
 *@property Carbon deleted_at
 */
class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
