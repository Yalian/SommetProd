<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Administration\Contract;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.contract.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.contract.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $contract = new Contract();
            $contract->name = $request->name;
            $contract->address = $request->address;

            $contract->save();

        } catch (\Throwable $e) {

            return response()->json([
                'message' => [
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]
            ]);
        }

        return response()->json([
            'message' => [
                'type' => 'success',
                'text' => 'Contrato creado satisfactoriamente!'
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
        $contract = Contract::find($id);

        return view('admin.admin.contract.edit', ['contract' => $contract]);
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
        try {
            $contract = Contract::find($id);
            $contract->name = $request->name;
            $contract->address = $request->address;

            $contract->save();
        } catch (\Throwable $e) {
            return response()->json([
                'message' => [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ]
            ]);
        }

        return response()->json([
            'message' => [
                'type' => 'success',
                'text' => 'Actualizado correctamente!'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function data()
    {
        $contracts = Contract::all();

        return DataTables::of($contracts)
            ->setRowId('id')
            ->addColumn('name', function ($contract) {
                return $contract->name;
            })
            ->addColumn('action', function ($contract) {
                return '<a class="btn-sm btn-success" id="edit" data-href="' . route('contratos.edit', ['id' => $contract->id]) . '"><span class="fa fa-pencil"></span></a>';
            })
            ->addColumn('address', function ($contract) {
                return $contract->address;
            })
            ->rawColumns(['action'])
            ->make();
    }
}
