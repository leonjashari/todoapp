<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;


class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        // Add other fillable fields as needed
    ];

    // Relationship with Task model
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}