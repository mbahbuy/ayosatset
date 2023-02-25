<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        return view('dashboard.categories',[
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request){
        $rules = Validator::make( $request->all(), [
            'name' => 'required|max:255|unique:categories'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'add_category');
        }
        $data = $rules->validated();
        $data['slug'] = Str::slug($data['name'], '-');
        Category::create($data);
        return back()->with('success', 'Category (\'' . $data['name'] . '\') telah ditambahkan');
    }

    public function update(Request $request, Category $category){
        $rules = Validator::make( $request->all(), [
            'name' => [
                'required', 'different:$category->name', 'unique:categories'
            ]
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'edit_category');
        }
        $data = $rules->validated();
        $data['slug'] = Str::slug($data['name'], '-');
        $category->product()->update(['categories' => $data['slug'] ]);
        $category->update(['name' => $data['name'], 'slug' => $data['slug']]);
        return back()->with('success', 'Category (\'' . $category->name . '\') telah di update');
    }

    public function destroy(Category $category){
        $category->product()->delete();
        $category->delete();

        return back()->with('success', 'The category(' . $category->name . ') has been deleted with its products!');
    }
}
