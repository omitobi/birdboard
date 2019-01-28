<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public function path(string $suffix = '')
    {
        return "/projects/$this->id".($suffix ?? '');
    }
}
