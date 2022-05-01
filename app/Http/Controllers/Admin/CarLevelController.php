<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car_level;
use App\Models\Car_model;


class CarLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car_level::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('model',function($data){
                $model = Car_level::find($data['id'])->car_model->model_name;
                return $model;
            })
            ->addColumn('btn',function($data){
                $btn = '<button class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></button>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn','model'])
            ->make(true);
        }

        $carmodels = Car_model::all();
        return view('admin.car.level.index',compact('carmodels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carmodels = Car_model::all();
        return view('admin.car.level.create',compact('carmodels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'carlevel' => 'required|unique:car_level,level_name',
        ],[
            'carlevel.required' => 'กรุณากรอกชื่อประเภทรถ',
            'carlevel.unique' => 'มีชื่อประเภทรถนี้อยู่แล้ว',
        ]);

        $carlevel = new Car_level();
        $carlevel->level_name = $request->carlevel;
        $carlevel->model_id = $request->carmodel;
        $carlevel->created_at = Carbon::now();
        $carlevel->updated_at = Carbon::now();

        if($carlevel->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('carlevel.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('carlevel.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carlevel = Car_level::whereId($id)->first();
        $models = Car_model::all();
        $carmodel = Car_level::find($id)->car_model->model_name;

        return response()->json(['carlevel' => $carlevel,'models' => $models, 'carmodel' => $carmodel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $carlevel = Car_level::whereId($id)->first();
        // $models = Car_model::all();
        // $carmodel = Car_level::find($id)->car_model->model_name;
        // return view('admin.car.level.edit',compact('models','carmodel','carlevel'));
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
        $message = 'ไม่สามารถบันทึกข้อมูลได้';
        $carlevel = Car_level::whereId($id)->first();
        // $request->validate([
        //     'carlevel' => 'required',
        // ],[
        //     'carlevel.required' => 'กรุณากรอกชื่อประเภทรถ'
        // ]);

        // if($request->has('carlevel') && $carlevel->level_name != $request->carlevel){
        //     $request->validate([
        //         'carlevel' => 'unique:car_level,level_name',
        //     ],[
        //         'carlevel.unique' => 'มีชื่อประเภทรถนี้อยู่แล้ว',
        //     ]);
        // }

        $carlevel->level_name = $request->carlevel_edit;
        $carlevel->model_id = $request->carmodel_edit;
        $carlevel->updated_at = Carbon::now();

        if ($carlevel->save()){
            $status = true;
            $message = 'อัพเดทข้อมูลเรียบร้อย';
            return response()->json(['status' => $status,'message' => $message]);
        }

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

        $page = Car_level::whereId($id)->first();

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
