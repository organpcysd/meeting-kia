<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car_model;
use App\Models\Car_type;
use App\Models\Car_level;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car_model::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<button class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></button>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn','select'])
            ->make(true);
        }
        return view('admin.car.model.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.model.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carmodels = new Car_model();
        $carmodels->model_name = $request->carmodel;

        $carmodels->created_at = Carbon::now();
        $carmodels->updated_at = Carbon::now();

        if($carmodels->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('carmodel.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('carmodel.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carmodel = Car_model::whereId($id)->first();
        return response()->json($carmodel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carmodel = Car_model::whereId($id)->first();
        return view('admin.car.model.edit',compact('carmodel'));
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

        $carmodels = Car_model::whereId($id)->first();

        $carmodels->model_name = $request->carmodel_edit;
        $carmodels->updated_at = Carbon::now();

        if($carmodels->save()){
            $status = true;
            $message = 'อัพเดทข้อมูลเรียบร้อย';
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

        $carmodel = Car_model::whereId($id)->first();

        if ($carmodel->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $carmodel = Car_model::whereIn('id',$ids);

        if($carmodel->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('carmodel.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('carmodel.index');
    }
}
