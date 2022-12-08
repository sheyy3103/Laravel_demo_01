<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function book()
    {
        $book = Book::paginate(4);
        return view('book.book', compact('book'));
    }
    public function add()
    {
        $author = Author::get();
        return view('book.add', compact('author'));
    }
    public function added(Request $request)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0|between:0,'.$request->price,
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg'
        ];
        $messages = [
            'name.required' => "Book's name cannot be blank",
            'price.required' => "Price cannot be blank",
            'price.numeric' => "Price must be a number",
            'price.min' => "Price must be greater than 0",
            'sale_price.numeric' => "Sale price must be a number",
            'sale_price.min' => "Sale price must be greater than 0",
            'sale_price.between' => "Sale price cannot be greater than price",
            'image.required' => "Please select an image",
            'image.mimes' => "Ivalid type of image",
        ];
        $request->validate($rules, $messages);
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
        return view('book.update', compact('author','book'));
    }
    public function updated($id, Request $request)
    {
        $book = Book::find($id);
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0|between:0,'.$request->price,
            'image' => 'mimes:jpg,jpeg,png,gif,svg'
        ];
        $messages = [
            'name.required' => "Book's name cannot be blank",
            'price.required' => "Price cannot be blank",
            'price.numeric' => "Price must be a number",
            'price.min' => "Price must be greater than 0",
            'sale_price.numeric' => "Sale price must be a number",
            'sale_price.min' => "Sale price must be greater than 0",
            'sale_price.between' => "Sale price cannot be greater than price",
            'image.mimes' => "Ivalid type of image",
        ];
        $request->validate($rules, $messages);
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
}
