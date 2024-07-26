<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;


class CategoryController extends Controller
{




    public function index() {
        $categories = Category::orderBy('created_at','DESC')->get();

        return view('category.list',[
            'categories' => $categories,
        ]);
    }
    public function create() {
        return view('category.create');
    }
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5',
            'category_id' => 'nullable|exists:categories,id',
        ];

         Validator::make($request->all(),$rules);

        $category = new Category();
        $category->name = $request->name;

        $category->save();


        return redirect()->route('category.index')->with('success','Category added successfully.');
    }

    public function edit($id) {


        $category = Category::findOrFail($id);
        return view('category.edit',[
            'category' => $category
        ]);
    }

    public function update( Request $request, Category $category) {


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $category->update($validated);

        return redirect()->route('category.index')->with('success','Category updated successfully.');

    }

    public function destroy($id) {
        $category = Category::find($id);

        $category->delete();

        return redirect()->route('category.index')->with('success','Category deleted successfully.');
    }





}
