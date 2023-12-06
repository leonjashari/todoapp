<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        // Add other fillable fields as needed
    ];

    // Relationship with Group model
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}