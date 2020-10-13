<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
protected $fillable = ['name','format', 'link'];

public function user()
{
    return $this->belongsTo(User::class);
}
}  

