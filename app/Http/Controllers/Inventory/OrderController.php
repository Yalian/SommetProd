<?php

namespace App\Http\Controllers\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Inventory\Line;
use App\Models\Inventory\Material;
use App\Models\Inventory\Order;
use App\Models\Inventory\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        return view('admin.inventory.order.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function data()
    {
        return DataTables::of(Order::all())
            ->setRowId('id', function ($order) {
                return $order->id;
            })
            ->addColumn('guide', function ($order) {
                return $order->guide;
            })
            ->addColumn('date', function ($order) {
                return $order->date;
            })
            ->addColumn('total', function ($order) {
                return '$ ' . $order->sub_total;
            })
            ->addColumn('discount', function ($order) {
                return '$ ' . $order->discount;
            })
            ->addColumn('final', function ($order) {
                return '$ ' . $order->total;
            })
            ->addColumn('action', function ($order) {
                return "<a class='btn-sm btn-success' href='" . route('order.show', ['id' => $order->id]) . "'><span class='fa fa-clipboard'></span></a>";
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
        $materials = Material::all();
        return view('admin.inventory.order.create', ['materials' => $materials]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lines = json_decode($request['lines']);

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        \Illuminate\Support\Facades\Storage::disk('images')->put($filename, File::get($file));

        $order = new Order([
            'guide' => $request['guide'],
            'date' => $request['date'],
            'sub_total' => $request['subTotal'],
            'discount' => $request['discount'],
            'total' => $request['total'],
            'img_name' => $filename
        ]);
        $order->save();

        foreach ($lines as $l) {
            $line = new Line([
                'material_id' => $l->id,
                'unit' => $l->unit,
                'quantity' => $l->quantity,
                'unit_price' => $l->pu,
                'percentage' => $l->percentage,
                'unit_price_discount' => $l->pud,
                'sub_total' => $l->subTotal,
                'iva' => $l->iva,
                'total' => $l->total
            ]);

            $order->lines()->save($line);

            $storage = Storage::find($l->id);

            switch ($l->unit) {
                case 'Mts':
                    $storage->qty_mts += $l->quantity;
                    break;
                case 'Kgs':
                    $storage->qty_kgs += $l->quantity;
                    break;
                case'Unidades':
                    $storage->qty_units += $l->quantity;
                    break;
            }
            $storage->save();
        }

        try {
            $view = view('order.index')->render();
        } catch (\Throwable $e) {
            return response()->json([
                'message' => [
                    'type' => 'error',
                    'text' => $e
                ]
            ]);
        }

        return response()->json([
            'message' => [
                'text'=> 'Factura ingresada correctamente!',
                'type' => 'success'
            ],
            'view' => $view
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
        $order = Order::where('id', $id)->with('lines.material')->first();

        return view('admin.inventory.order.show', ['order' => $order]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
