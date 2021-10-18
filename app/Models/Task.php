<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['title', 'description', 'deadline'];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function steps()
    {
        return $this->hasMany(TaskStep::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
