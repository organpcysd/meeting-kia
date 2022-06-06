<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car_type;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car_type::all();
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
        return view('admin.car.type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.type.create');
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
            'cartype' => 'required|unique:car_type,type_name',
        ],[
            'cartype.required' => 'กรุณากรอกชื่อประเภทรถ',
            'cartype.unique' => 'มีชื่อประเภทรถนี้อยู่แล้ว',
        ]);

        $cartype = new Car_type();
        $cartype->type_name = $request->cartype;
        $cartype->created_at = Carbon::now();
        $cartype->updated_at = Carbon::now();

        if($cartype->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('cartype.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('cartype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cartype = Car_type::whereId($id)->first();
        return response()->json($cartype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $cartype = Car_type::whereId($id)->first();
        // return view('admin.car.type.edit',compact('cartype'));
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

        $cartype = Car_type::whereId($id)->first();

        $cartype->type_name = $request->cartype_edit;
        $cartype->updated_at = Carbon::now();

        if ($cartype->save()){
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

        $cartype = Car_type::whereId($id)->first();

        if ($cartype->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $cartype = Car_type::whereIn('id',$ids);

        if($cartype->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('cartype.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('cartype.index');
    }
}
