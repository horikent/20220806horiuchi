<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; 

class Todo extends Model
{
    use HasFactory;
    use Sortable; 

    protected $fillable = ['date', 'book', 'author', 'publisher', 'created_at' , 'updated_at' , 'user_id'];

    public function user(){
    return $this->belongsTo('App\Models\User');
    }
}