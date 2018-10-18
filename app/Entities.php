<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $table = 'entities';
    protected $guarded = ['id'];
}
