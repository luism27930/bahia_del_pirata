<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
protected $fillable = ['name','format', 'link', 'success'];

public function user()
{
    return $this->belongsTo(User::class);
}
}  

