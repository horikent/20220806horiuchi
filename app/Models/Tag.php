<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
    'tag'
    ];

public function relate(Request $request)
    {
        $tags = Tag::all();
        return view('/index', ['tags' => $tags]);
    }

    public function todos(){
        return $this->hasMany('App\Models\Todo');    
    }

    public function getTag(){
        return $this->tag;
    }
}
