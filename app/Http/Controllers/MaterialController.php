<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Category;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Material::orderBy('id', 'DESC')->with('categories')->paginate(5);
        $categories = Category::all();
        return view('material')->with(['data'=>$data, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource / update existing resource in storage.
     */
    public function store(Request $request, Material $material)
    {

        if(!$request->id) {
            $request->validate([
                'name' => 'required|unique:materials|max:100',
            ]);
        }
        $request->validate([
            'category_id'=>'required',
            'opening_balance'=>'required'
        ]);
        $inputData = array(
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'opening_balance' => $request->input('opening_balance'),
        );
        
        if(!empty($request->input('id'))) {
            Material::where('id', $request->id)->update( $inputData );  
        } else {
            Material::create( $inputData ) ; 
        }
        return redirect()->back()->with('message', 'Material saved successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $categories = Category::all();
        $material_data = Material::find($material->id);
        $material_data = !empty($material_data) ? $material_data : array();
        $data = Material::orderBy('id', 'DESC')->paginate(5);
        return view('material')->with(['material_data'=>$material_data, 'data'=>$data , 'categories'=>$categories]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $materialId = Material::find( $material );
        $materialId->each->delete();
        return redirect()->to('/material')->with(['message'=> 'Deleted successfully']); 
    }
}
