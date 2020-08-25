<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';
    protected $fillable = ['id', 'status', 'warmth', 'contact_id', 'created_at', 'updated_at'];
}
