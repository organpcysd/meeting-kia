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
            ->addColumn('permission',function($data){
                $permission = $data->getPermissionNames()->toArray();
                return $permission;
            })
            ->addColumn('btn',function($data){
                $btn = '<a id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['btn','permission'])
            ->make(true);
        }
        $permissions = Permission::all();
        return view('admin.role.index',compact('permissions'));
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
        $role = Role::whereId($id)->first();
        $permissions = Permission::all();
        $perm = $role->getPermissionNames();
        return response()->json(['role' => $role,'permissions' => $permissions,'perm' => $perm]);
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

        $role = Role::whereId($id)->first();

        $role->name = $request->role_edit;
        $role->updated_at = Carbon::now();

        if ($role->save()){
            $role->syncPermissions([$request->perm_edit]);
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

        $role = Role::whereId($id)->first();
        $role->revokePermissionTo($role->getPermissionNames()->toarray());

        if ($role->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
