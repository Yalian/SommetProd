<?php

namespace App\Http\Controllers\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Inventory\Material;
use App\Models\Inventory\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        return view('admin.inventory.material.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function data()
    {
        return DataTables::of(Material::query())
            ->setRowId('id')
            ->addColumn('name', function ($material) {
                return $material->name;
            })
            ->addColumn('colour', function ($material) {
                return $material->colour;
            })
            ->addColumn('action', function ($material) {
                return "<a class='btn btn-sm btn-success modalBtn' id='edit' href='".route('material.edit',['id' => $material->id])."' ><span class='fa fa-pencil'></span></a>";
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material();
        $material->name = $request->name;

        $material->save();

        $storage = new Storage();

        $material->storage()->save($storage);

        return response()->json($material);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return view('admin.inventory.material.edit', ['material' => $material]);
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
        $material = Material::find($id);
        $material->name = $request->name;
        $material->save();


        return response()->redirectToRoute('material.index');
    }


}
