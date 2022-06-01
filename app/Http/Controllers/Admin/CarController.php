<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car;
use App\Models\Car_model;
use App\Models\Car_color;
use App\Models\Car_type;
use App\Models\Car_level;
use App\Models\Car_stock;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-info" href="'. route('stock.getData',['car' => $data['id']]) .'"><i class="fa fa-archive" data-toggle="tooltip" title="สต๊อก"></i></a>
                        <a class="btn btn-warning" href="'.route('car.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->addColumn('stock',function($data){
                $stock = count($data->car_stock);
                return $stock;
            })

            ->addColumn('model',function($data){
                $model = $data->car_model->model_name;
                return $model;
            })

            ->addColumn('level',function($data){
                $level = $data->car_level->level_name;
                return $level;
            })

            ->addColumn('type',function($data){
                $typel = $data->car_type->type_name;
                return $typel;
            })

            ->addColumn('color',function($data){
                $color = $data->car_color->color_name . ' ' . $data->car_color->color_code;
                return $color;
            })
            ->rawColumns(['btn','color','model','level','type','stock'])
            ->make(true);
        }
        return view('admin.car.car.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carcolors = Car_color::all();
        $carmodels = Car_model::all();
        $carlevels = Car_level::all();
        $cartypes = Car_type::all();
        return view('admin.car.car.create',compact('carcolors','carmodels','carlevels','cartypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cars = new Car();
        $cars->model_id = $request->model;
        $cars->color_id = $request->color;
        $cars->type_id = $request->type;
        $cars->level_id = $request->level;
        $cars->engine = $request->engine;
        $cars->gear = $request->gear;
        $cars->price = $request->price;
        $cars->years = $request->years;
        $cars->other = $request->other;

        $cars->created_at = Carbon::now();
        $cars->updated_at = Carbon::now();

        if($cars->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('car.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('car.index');
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
        $car = Car::whereId($id)->first();
        $models = Car_model::all();
        $carmodel = $car->car_model->model_name;
        $colors = Car_color::all();
        $carcolor = $car->car_color->color_name;
        $types = Car_type::all();
        $cartype = $car->car_type->type_name;
        $levels = Car_level::all();
        $carlevel = $car->car_level->id;
        return view('admin.car.car.edit',compact('car','colors','carcolor','models','carmodel','types','cartype','levels','carlevel'));
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
        $cars = Car::whereId($id)->first();

        $cars->model_id = $request->model;
        $cars->color_id = $request->color;
        $cars->type_id = $request->type;
        $cars->level_id = $request->level;
        $cars->engine = $request->engine;
        $cars->gear = $request->gear;
        $cars->price = $request->price;
        $cars->years = $request->years;
        $cars->other = $request->other;

        $cars->updated_at = Carbon::now();

        if($cars->save()){
            Alert::success('บันทึกข้อมูล');
            return redirect()->route('car.index');
        }

        Alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('car.edit');
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

        $page = Car::whereId($id)->first();

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataCarmodel(Request $request)
    {
        $level = car_level::where('model_id',$request->id)->get();
        return $level;
    }
}
