<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:add-category'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-category'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-category'], ['only' => ['destroy']]);
    }

    public function index(){
        $categories = Category::latest()->paginate(5);
        return view('admin.categories' , compact("categories"));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'desc' => 'string|nullable'
        ]);
        $data['created_by'] = Auth::user()->email;
        Category::create($data);
        session()->flash("success" , "category added successfully");
        return redirect(url('categories'));
    }

    public function edit($id){
        $category = Category::FindOrFail($id);
        return view('categories.edit' , compact('category'));
    }

    public function update(Request $request , $id){
        $data = $request->validate([
            'name' => 'required|string',
            'desc' => 'string|nullable'
        ]);
        $category = Category::FindOrFail($id);
        $category->update($data);
        session()->flash('success' , "category updated successfully");
        return redirect()->back();
    }


    public function destroy($id){
        $category = Category::FindOrFail($id);
        $category->delete();
        session()->flash('success' , 'category deleted successfully');
        return redirect(route('redirect'));
    }
}
