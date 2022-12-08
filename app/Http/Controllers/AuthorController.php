<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function author()
    {
        $author = Author::paginate(4);
        return view('author.author', compact('author'));
    }
    public function add()
    {
        return view('author.add');
    }
    public function added(Request $request)
    {
        $rules = [
            'name' => 'required|unique:author'
        ];
        $messages = [
            'name.required' => "Author's name cannot be blank",
            'name.unique' => "Author's name is already taken"
        ];
        $request->validate($rules, $messages);
        Author::create($request->all());
        return redirect()->route('author.author')->with('notification', 'Added successfully');
    }
    public function update($id)
    {
        $author = Author::find($id);
        return view('author.update', compact('author'));
    }
    public function updated($id, Request $request)
    {
        $rules = [
            'name' => 'required|unique:author,name,' . $id
        ];
        $messages = [
            'name.required' => "Author's name cannot be blank",
            'name.unique' => "Author's name is already taken"
        ];
        $request->validate($rules, $messages);
        Author::find($id)->update($request->all());
        return redirect()->route('author.author')->with('notification', 'Updated successfully');
    }
    public function delete($id)
    {
        $author = Author::find($id);
        try {
            $author->delete();
            return redirect()->back()->with(
                'notification',
                'Deleted successfully'
            );
        }catch (\Throwable $th ) {
            return redirect()->back()->with(
                'errors',
                'Deleted unsuccessfully because of being linked to the book(s) in store'
            );
        }
    }
}