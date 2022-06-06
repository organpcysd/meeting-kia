<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car_color;

class CarColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car_color::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<button id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn','select'])
            ->make(true);
        }
        return view('admin.car.color.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.color.create');
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
            'carcolor' => 'required|unique:car_color,color_name',
        ],[
            'carcolor.required' => 'กรุณากรอกชื่อสีรถ',
            'carcolor.unique' => 'มีชื่อสีรถนี้อยู่แล้ว',
        ]);

        $carcolor = new Car_color();
        $carcolor->color_name = $request->carcolor;
        $carcolor->color_code = $request->colorcode;
        $carcolor->created_at = Carbon::now();
        $carcolor->updated_at = Carbon::now();

        if($carcolor->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('carcolor.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('carcolor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carcolor = Car_color::whereId($id)->first();
        return response()->json($carcolor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $carcolor = Car_color::whereId($id)->first();
        // return view('admin.car.color.edit',compact('carcolor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $status = false;
        $message = 'ไม่สามารถอัพเดทข้อมูลได้';

        $carcolor = Car_color::whereId($id)->first();

        $carcolor->color_name = $request->carcolor_edit;
        $carcolor->color_code = $request->colorcode_edit;
        $carcolor->updated_at = Carbon::now();

        if ($carcolor->save()){
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

        $carcolor = Car_color::whereId($id)->first();

        if ($carcolor->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $carcolor = Car_color::whereIn('id',$ids);

        if($carcolor->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('carcolor.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('carcolor.index');
    }
}
