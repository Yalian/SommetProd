<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Administration\Contract;
use App\Models\Administration\Product;
use App\Models\Inventory\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.admin.product.index')->render();

        } catch (\Throwable $e) {

            return response()->json([
                'message' => [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $contracts = Contract::all();
            $materials = Material::all();

            return view('admin.admin.product.create', [
                'contracts' => $contracts,
                'materials' => $materials
            ])->render();

        } catch (\Throwable $e) {

            return response()->json([
                'message' => [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $product = new Product();
            $product->name = $request->name;
            $product->contract_id = $request->contract;

            $product->save();

            $arr = json_decode($request['materials']);

            foreach ($arr as $m){
                $material = Material::find($m->id);

                $product->material()->save($material);
            }



        }catch (\Throwable $e){
            return response()->json([
                'message'=> [
                    'type'=>'error',
                    'text'=> $e->getMessage()
                ]
            ]);
        }

        return response()->json([
            'message'=>[
                'type'=> 'success',
                'text'=>'Guardado Correctamente'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function list(Request $request)
    {
        try{
            $p = Product::query()->where('contract_id', $request->term)->get(['id','name']);
            $products = [];

            foreach ($p as $pro){
                $products[] = ['id'=>$pro->id, 'text'=> $pro->name];
            }

            return response()->json($products);

        }catch (\Throwable $e){
            return response()->json([
                'message'=>[
                    'type'=>'error',
                    'text'=>$e->getMessage()
                ]
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function data()
    {

        return DataTables::of(Product::query()->with('material','contract')->get())
            ->setRowId('id', function ($product) {
                return $product->id;
            })
            ->addColumn('name', function ($product) {
                return $product->name;
            })
            ->addColumn('contract', function ($product){
                return $product->contract->name;
            })
            ->addColumn('action', function ($product){
                return '<a class="btn btn-sm btn-success"><span class="fa fa-pencil"></span></a>';
            })
            ->make(true);
    }
}
