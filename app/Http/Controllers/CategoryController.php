<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function all(){
        $user = Auth::user();
        $categoreis = Category::paginate(3);
        return view('categoreis.all',["categoreis"=>$categoreis,"user"=>$user]);
    }
    public function show($id){
        $user = Auth::user();
        $category = Category::findOrfail($id);
        return view('categoreis.show',["category"=>$category,"user"=>$user]);
    }
    public function create(){
        return view('categoreis.create');
    }
    public function store(Request $request){

        $data = $request->validate([
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'required|image|mimes:jpg,png'
        ]);
        $data['image'] = Storage::putFile("categoreis",$data['image']);
        Category::create($data);
        session()->flash("success","data insrted successflay");
        return redirect(url('/'));
    }

    public function edit($id){
        $category = Category:: findOrfail($id);
        return view("categoreis.edit")->with("category",$category);
    }

    public function update(Request $request,$id){
        $data = $request->validate([
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'image|mimes:jpg,png'
        ]);

        $category = Category:: find($id);

        // image update
        if($request->has("image")){
            Storage::delete($category->image);
            $data['image'] = Storage::putFile("categoreis",$data['image']);

        }

        $category->update($data);
        session()->flash('success',"data updated successflay");
        return redirect(url("/show/$category->id"));
    }

    public function delete($id){
        $category = Category:: findOrfail($id);
        Storage::delete($category->image);
        $category->delete();
        session()->flash('success',"data deleted successflay");
        return redirect()->action([CategoryController::class,"all"]);

    }

    public function add(){
         $admin = User::all();
        return view('categoreis.addAdmin' ,["admin"=>$admin]);
    }
    public function insert(Request $request){
        $data = $request->validate([
            "name"=>'required|string|max:100',
            "email"=>"required|email",
            "password"=>'required|string|min:6',
            "role"=>'required'
        ]);
        $data['password']=bcrypt($data['password']);
        User::create($data);
        return redirect('/');
    }

    public function select(){
        $user = User::all();
        return view('categoreis.allUsers',["user"=>$user]);
    }
    public function selectOne($id){
        $user=User::findOrFail($id);
        return view('categoreis.showUser',["user"=>$user]);
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('success',"User deleted successflay");
        return redirect()->action([CategoryController::class,"select"]);
    }
}
