<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public const STARTED = 1;
    public const PRIORITIZED = 2;
    public const FINISHED = 3;
    public const EXPIRED = 4;
    public const DELETED = 5;

    use HasFactory;
    protected $visible = ['status'];
}
