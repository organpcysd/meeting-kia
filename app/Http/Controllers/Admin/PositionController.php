<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\User_prefix;
use App\Models\User_position;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User_position::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('select',function($data){
                    $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                    return $select;
                })
                ->addColumn('btn',function ($data){
                    $btn = '<a id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></a>
                            <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                    return $btn;
                })
                ->addColumn('publish',function ($data){
                    if($data['publish']){
                        $publish = '<label class="switch">
                                    <input type="checkbox" checked value= "0" id="' . $data['id'] . '" onchange="publish(this)">
                                    <span class="slider round"></span>
                                    </label>';
                    }else{
                        $publish = '<label class="switch">
                                  <input type="checkbox" value="1" id="'.$data['id'].'" onchange="publish(this)">
                                  <span class="slider round"></span>
                                </label>';
                    }

                    return $publish;
                })
                ->rawColumns(['btn','publish','select'])
                ->make(true);
        }
        return view('admin.position.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.position.create');
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
            'position' => 'required|unique:user_positions,name',
        ],[
            'position.unique' => 'มีตำแหน่งนี้อยู่แล้ว',
            'position.required' => 'กรุณากรอกตำแหน่ง',
        ]);

        $position = new User_position();
        $position->name = $request->position;
        $position->created_at = Carbon::now();
        $position->updated_at = Carbon::now();

        if($position->save()){
        Alert::success('เพิ่มข้อมูลสำเร็จ');
        return redirect()->route('position.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('position.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = User_position::whereId($id)->first();
        return response()->json($position);
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

        $position = User_position::whereId($id)->first();

        $position->name = $request->position_edit;
        $position->updated_at = Carbon::now();

        if ($position->save()){
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

        $position = User_position::whereId($id)->first();

        if ($position->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $position = User_position::whereId($id)->first();
        $position->publish = $request->data;

        $position->updated_at = Carbon::now();

        // $user_has_position = User_has_position::where('position_id',3)->pluck('user_id')->all();

        if($position->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $position = User_position::whereIn('id',$ids);

        if($position->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('position.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('position.index');
    }
}
