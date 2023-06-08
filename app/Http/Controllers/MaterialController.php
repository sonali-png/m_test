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
        $data = Material::paginate(5);
        $categories = Category::all();
        return view('material')->with(['data'=>$data, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource / update existing resource in storage.
     */
    public function store(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|unique:materials|max:100',
            'category_id'=>'required',
            'opening_balance'=>'required'
        ]);
        $inputData = array(
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'opening_balance' => $request->input('opening_balance'),
            'current_balance' => $request->input('opening_balance') + 20
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
        $material_data = Material::find($material);
        $material_data = !empty($material_data) ? $material_data[0] : array();
        $data = Material::paginate(5);
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
