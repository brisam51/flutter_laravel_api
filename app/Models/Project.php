<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
   protected  $fillable=['title'];
   public function Tasks(){
    return $this->hasMany(Task::class);
   }
   public function creator(){
    return $this->belongsTo(User::class,'creator_id');
   }
}