<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';
    protected $fillable = ['name','price','sale_price','image','status','author_id'];
    public $timestamps = false;

    public function author(){
        return $this->hasOne(Author::class,'id','author_id');
    }
}
