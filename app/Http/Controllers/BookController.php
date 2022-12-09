<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function book()
    {
        $book = Book::search()->paginate(4);
        return view('book.book', compact('book'));
    }
    public function add()
    {
        $author = Author::get();
        return view('book.add', compact('author'));
    }
    public function added(AddBookRequest $request)
    {
        $request->validated();
        $file = $request->file('image');
        $file_name = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $file_name);
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $file_name,
            'status' => $request->status,
            'author_id' => $request->author_id
        ];
        Book::create($data);
        return redirect()->route('book.book')->with('notification', 'Added Successfully');
    }
    public function update($id)
    {
        $author = Author::get();
        $book = Book::find($id);
        return view('book.update', compact('author', 'book'));
    }
    public function updated($id, UpdateBookRequest $request)
    {
        $book = Book::find($id);
        $request->validated();
        $file_name = $book->image;
        if ($request->has('image')) {
            unlink('uploads/' . $file_name);
            $file = $request->file('image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $file_name,
            'status' => $request->status,
            'author_id' => $request->author_id
        ];
        $added = Book::find($id)->update($data);
        return redirect()->route('book.book')->with('notification', 'Updated Successfully');
    }
    public function delete($id)
    {
        $book = Book::find($id);
        try {
            unlink("uploads/" . $book->image);
            $book->delete();
            return redirect()->back()->with(
                'notification',
                'Deleted successfully'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'errors',
                'Deleted unsuccessfully because of being linked to the book(s) in store'
            );
        }
    }
    public function detail($id)
    {
        $book = Book::find($id);
        $discount = $book->sale_price == 0 ? 0 : (1 - ($book->sale_price / $book->price)) * 100;
        $discount = number_format($discount, 2, '.', ',');
        return view('book.detail', compact('book', 'discount'));
    }
    public function back()
    {
        return redirect()->route('book.book');
    }
}
