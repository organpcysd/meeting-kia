<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Car_gift;

class CarGiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Car_gift::all();
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
        return view('admin.car.gift.index');
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
        $request->validate([
            'cargift' => 'required|unique:car_gift,gift_name',
        ],[
            'cargift.required' => 'กรุณากรอกชื่อรายการของแถม',
            'cargift.unique' => 'มีชื่อรายการของแถมนี้อยู่แล้ว',
        ]);

        $cargift = new Car_gift();
        $cargift->gift_name = $request->cargift;
        $cargift->created_at = Carbon::now();
        $cargift->updated_at = Carbon::now();

        if($cargift->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('cargift.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('cargift.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargift = Car_gift::whereId($id)->first();
        return response()->json($cargift);
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

        $cargift = Car_gift::whereId($id)->first();

        $cargift->gift_name = $request->cargift_edit;
        $cargift->updated_at = Carbon::now();

        if ($cargift->save()){
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

        $cargift = Car_gift::whereId($id)->first();

        if ($cargift->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $cargift = Car_gift::whereIn('id',$ids);

        if($cargift->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('cargift.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('cargift.index');
    }
}
