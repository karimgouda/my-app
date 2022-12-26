<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiCategoriesController extends Controller
{
    public function allApi(){
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function createApi(Request $request){

        $validator=Validator::make($request->all(),[
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'image|mimes:jpg,png'
        ]);
        if($validator->fails()){
            return response()->json([
                "msg"=>$validator->errors()
            ],409);
        }
        $imgName = Storage::putFile("categoreis",$request->image);

                    $category = Category::create([
                        "title"=>$request->title,
                        "desc"=>$request->desc,
                        "image"=>$imgName,
                    ]);

        return response()->json([
            "msg"=>"category created successfly",
            "category"=>new CategoryResource($category)
        ],201);
    }

    public function update(Request $request , $id){
        $validator=Validator::make($request->all(),[
            "title"=>'required|string|max:100',
            "desc"=>'required|string',
            "image"=>'image|mimes:jpg,png'
        ]);
        if($validator->fails()){
            return response()->json([
                "msg"=>$validator->errors()
            ],409);
        }

        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "msg"=>"Category Not Found",
            ],404);
        }
        if($request->has("image")){
            Storage::delete($category->image);
            $imgName = Storage::putFile("categoreis",$request->image);
        }
        $category->update([
            "title"=>$request->title,
            "desc"=>$request->desc,
            "image"=>$imgName
        ]);
        return response()->json([
            "msg"=>"Data Updated Successflay",
            "category"=>new CategoryResource($category)
        ],201);
    }
    public function delete($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "msg"=>"Category Not Found",
            ],404);
        }
        Storage::delete($category->image);
        $category->delete();
        return response()->json([
            "msg"=>"Data Deleted Successflay",
        ],201);
    }
}
