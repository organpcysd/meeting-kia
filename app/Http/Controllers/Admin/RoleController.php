<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Role::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-warning" href="'.route('role.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                            <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
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
            'role' => 'required|unique:roles,name',
        ],[
            'role.required' => 'กรุณากรอกบทบาท',
            'role.unique' => 'มีบทบาทนี้อยู่แล้ว',
        ]);

        $role = new Role();
        $role->name = $request->role;
        $role->guard_name = 'web';
        $role->created_at = Carbon::now();
        $role->updated_at = Carbon::now();

        if($role->save()){
            $role->syncPermissions([$request->permission]);
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('role.index');
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('role.create');
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
        $role = Role::whereId($id)->first();
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
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
        $role = Role::whereId($id)->first();

        $request->validate([
            'role' => 'required',
        ],[
            'role.required' => 'กรุณากรอกบทบาท',
        ]);

        if($request->has('role') && $role->name != $request->role){
            $request->validate([
                'role' => 'unique:roles,name'
            ],[
                'role.unique' => 'มีบทบาทนี้อยู่แล้ว'
            ]);
        }

        $role->name = $request->role;
        $role->updated_at = Carbon::now();
        $role->save();

        if($role->save()){
            $role->syncPermissions([$request->permission]);
            Alert::success('บันทึกข้อมูล');
            return redirect()->route('role.index');
        }

        Alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('role.edit');
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

        $role = Role::whereId($id)->first();
        $role->revokePermissionTo($role->getPermissionNames()->toarray());

        if ($role->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
