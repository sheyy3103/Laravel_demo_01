<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'author';
    protected $fillable = ['name', 'status'];
    public $timestamps = false;
    public function book()
    {
       return $this->hasMany(Book::class,'author_id','id');
    }
}
