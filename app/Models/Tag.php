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

    public function createTag() {
        Tag::create([
            'id' => 1,
            'name' => '',
        ]);
    } 

    public function todos(){
    return $this->hasMany('App\Models\Todo');    
    }

    public function getTitle(){
        return 'ID'.$this->id . ':' . $this->tag;
    }
}
