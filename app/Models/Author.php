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

    //functions
    public function book()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
        function scopeSearch($query)
        {
            if (request()->keyword) {
                $keyword = request()->keyword;
                $query = Author::where('name', 'like', '%' . $keyword . '%');
            }
            return $query;
        }
    }
    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $keyword = request()->keyword;
            $query = Author::where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
