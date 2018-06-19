<?php

namespace App\Http\Controllers\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Inventory\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        return view('admin.inventory.stock.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function data()
    {
//        $storage = Storage::query()->with('material')->get();
//        dd($storage[0]->qty_mts);

        return DataTables::of(Storage::query()->with('material')->get())
            ->setRowId('id', function ($storage){
                return $storage->id;
            })
            ->addColumn('name', function ($storage){
                return $storage->material->name;
            })
            ->addColumn('qtyMts', function ($storage){
                return $storage->qty_mts . ' Mts';
            })
            ->addColumn('qtyKgs', function ($storage){
                return $storage->qty_kgs . ' Kg';
            })
            ->addColumn('qtyUnits', function ($storage){
                return $storage->qty_units;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.inventory.material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
