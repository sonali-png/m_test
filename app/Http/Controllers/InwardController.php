<?php

namespace App\Http\Controllers;

use App\Models\Inward;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Material;

use DB;
class InwardController extends Controller
{
    /**
     * create form for adding inward and Display a listing of the all inward outward details .
     */
    public function index(Request $request)
    {
        $data = Inward::orderBy('id', 'DESC')->with('categories', 'materials')->paginate(5);
        $materials = Material::all();
        return view('inward')->with(['data'=>$data, 'materials'=>$materials]);
    }

    /* get opening balance of material */
    public function getBalance(Request $request)
    {
        $materialId = $request->input('id');
        $materials = Material::find($materialId);
        $balance = !empty($materials) ? $materials->opening_balance : 0;
        $OutwardBal = Inward::select('outward_qty')->where('material_id' , $materialId)->orderBy('updated_at','DESC')->first();
        $currentBalance  = isset($OutwardBal->outward_qty) ? $OutwardBal->outward_qty : $balance;
        return $currentBalance;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required',
            'description' => 'required',
            'qty' => 'required',
            'transaction_at'=>'required'
        ]);

        $materialId = $request->input('material_id');
        $materials = Material::find($materialId);
        $alreadyInInward = Inward::where(['material_id' => $materialId])->first();
        $quantity = $request->input('qty');
        $inwardQuantity  = $request->input('inward_qty');
        $description  = $request->input('description');
        $outwardQuantity = $inwardQuantity + $quantity;

        $inputData = array(
            'material_id' => $request->input('material_id'),
            'category_id' => $materials->categories->id,
            'inward_qty'  => $quantity,
            'outward_qty'  => $outwardQuantity,
            'transaction_at'=> $request->input('transaction_at'),
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'description' => $description,
        );

        
        if(empty($alreadyInInward)) {
            $initialData = array(
                'material_id' => $request->input('material_id'),
                'category_id' => $materials->categories->id,
                'inward_qty'  => $inwardQuantity,
                'outward_qty'  => $inwardQuantity,
                'transaction_at'=> date("Y-m-d",strtotime($materials->updated_at)),
                'created_at' => (String)($materials->created_at),
                'updated_at' => (String)($materials->created_at),
                'description' => 'Initial stock'
            );
            $inputData = array($initialData, $inputData);
        }
        Inward::insert( $inputData ) ; 
        return redirect()->back()->with('message', 'Data saved successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function showList(Request $request)
    {
        $inwards = Material::find($request->id);
        return view('inward_outward_details')->with(['inward_details'=>$inwards, 'page'=>'show']);
    }
}
