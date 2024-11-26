<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $fillable = ['title'];
//set relationship with tasks table
    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
//set relationship with usrs table
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}