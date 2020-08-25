<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name'];

}
