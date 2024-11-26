<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $fillable = ['title'];
    //set relationship with tasks table
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    //set relationship with usrs table
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('creator', function (Builder $builder) {
            $builder->where('creator_id', Auth::id());
        });
    }
}
