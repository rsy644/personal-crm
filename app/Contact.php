<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'telephone_number', 'agency_id'];
}
