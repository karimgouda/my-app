<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function all(){
        $user = Auth::user();
        $books = Book::paginate(3);
        return view('books.all',["books"=>$books,"user"=>$user]);
    }

    public function show($id){
        $user = Auth::user();
        $book = Book::findOrfail($id);
        return view('books.show',["book"=>$book,"user"=>$user]);
    }


    public function create(){
        $categoreis = Category::all();
        return view('books.createTow',["categoreis"=>$categoreis]);
    }

    public function store(Request $request){

        $data = $request->validate([
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'required|image|mimes:jpg,png',
            "price"=>'required|numeric',
            "category_id"=>'required|exists:categories,id',
        ]);

        $data['image'] = Storage::putFile("books",$data['image']);
        $data['user_id']=4;
        // $this->hacMany(User::class,'user_id','id');
        Book::create($data);
        // Auth::user($data['user_id'])->id;
        session()->flash("success","data insrted successflay");
        return redirect(url('/books'));
    }

    public function edit($id){
        $categoreis = Category::all();
        $book = Book:: findOrfail($id);
        return view("books.edit",["categoreis"=>$categoreis , "book"=>$book]);
    }

    public function update(Request $request,$id){
        $data = $request->validate([
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'image|mimes:jpg,png',
            "price"=>'required|numeric',
            "category_id"=>'required|exists:categories,id'

        ]);

        $book = Book:: find($id);

        // image update
        if($request->has("image")){
            Storage::delete($book->image);
            $data['image'] = Storage::putFile("books",$data['image']);

        }

        $book->update($data);
        session()->flash('success',"data updated successflay");
        return redirect(url("/showBook/$book->id"));
    }

    public function delete($id){
        $book = Book:: findOrfail($id);
        Storage::delete($book->image);
        $book->delete();
        session()->flash('success',"data deleted successflay");
        return redirect()->action([BookController::class,"all"]);
    }
}
