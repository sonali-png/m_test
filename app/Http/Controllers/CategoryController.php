<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $data = Category::paginate(5);
        return view('category', compact('data'));
    }

    /**
     * Store a newly created resource/ update existing record in storage.
    */
    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        if(!empty($request->id)) {
            Category::where('id', $request->id)->update( ['name' => $request->input('name')] );  
        } else {
            Category::create( ['name' => $request->input('name')] );  
        }
        return redirect()->back()->with('message', 'Category saved successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category_data = Category::find($category);
        $category_data = !empty($category_data) ? $category_data[0] : array();
        $data = Category::paginate(5);
        return view('category')->with(['category_data'=>$category_data, 'data'=> $data]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $categoryId = Category::find( $category );
        $categoryId->each->delete();
        $data = Category::paginate(5);
        return redirect()->to('/category')->with(['message'=> 'Deleted successfully']); 
    }
}
