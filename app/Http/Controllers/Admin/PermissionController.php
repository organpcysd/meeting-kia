<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Permission::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-warning" href="'.route('permission.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                            <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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
            'permission' => 'required|unique:permissions,name',
        ],[
            'permission.required' => 'กรุณากรอกสิทธิ์การเข้าถึง',
            'permission.unique' => 'มีสิทธิ์การเข้าถึงนี้อยู่แล้ว',
        ]);

        $permission = Permission::create(['name' => $request->permission]);

        if($permission){
            $permission->created_at = Carbon::now();
            $permission->updated_at = Carbon::now();

            $permission->save();
            alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('permission.index');
        }

        return redirect()->route('permission.create');
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
        $permission = Permission::whereId($id)->first();

        return view('admin.permission.edit',compact('permission'));
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
        $permission = Permission::whereId($id)->first();
        $request->validate([
            'permission' => 'required',
        ],[
            'permission.required' => 'กรุณากรอกสิทธิ์การเข้าถึง',
        ]);

        if($request->has('permission') && $permission->name != $request->permission){
            $request->validate([
                'permission' => 'unique:permissions,name',
            ],[
                'permission.unique' => 'มีสิทธิ์การเข้าถึงนี้อยู่แล้ว',
            ]);
        }

        $permission->name = $request->permission;
        $permission->updated_at = Carbon::now();

        if ($permission->save()){
            alert::success('บันทึกข้อมูล');
            return redirect()->route('permission.index');
        }

        alert::error('บันทึกข้อมูลไม่สำเร็จ');
        return redirect()->route('permission.update');

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

        $permission = Permission::whereId($id)->first();

        if ($permission->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
