<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';
    protected $fillable = ['name', 'price', 'sale_price', 'image', 'status', 'author_id'];
    public $timestamps = false;

    //functions
    public function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }
    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $keyword = request()->keyword;
            $query = Book::where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
