<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car;
use App\Models\Car_stock;


class CarStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($car);
    }

    public function getData(Car $car,Request $request)
    {
        if($request->ajax()){
            $data = Car_stock::where('car_id',$car->id);
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('btn',function($data){
                $btn = '<button id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->addColumn('status',function($data){
                $car_status = $data['status'];
                if($car_status = 'pending'){
                    $status = '<label class="btn btn-primary btn-sm">รอจำหน่าย</label>';
                }

                return $status;
            })
            ->rawColumns(['btn','status'])
            ->make(true);
        }
        return view('admin.car.stock.index',compact('car'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carstock = new Car_stock();
        $carstock->car_id = $request->car_id;
        $carstock->number_chassis = $request->number_chassis;
        $carstock->number_engine = $request->number_engine;
        $carstock->status = "pending";

        if($carstock->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('stock.getData',['car' => $request->car_id]);
        }

        alert::error('เพิ่มข้อมูลไม่สำเร็จ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car_stock = Car_stock::whereId($id)->first();
        return response()->json($car_stock);
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
        $status = false;
        $message = 'ไม่สามารถอัพเดทข้อมูลได้';

        $carstock = Car_stock::whereId($id)->first();
        $carstock->number_chassis = $request->number_chassis_edit;
        $carstock->number_engine = $request->number_engine_edit;
        $carstock->updated_at = Carbon::now();

        if($carstock->save()){
            $status = true;
            $message = 'บันทึกข้อมูล';
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';

        $page = Car_stock::whereId($id)->first();

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }
}
