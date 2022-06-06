<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_prefix;
use App\Models\User_position;
use App\Models\User_has_position;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn',function ($data){
                    if(Auth::user()->id == $data['id']){
                        $btn = '<a class="btn btn-warning" href="'.route('user.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                                <button class="btn btn-danger" disabled><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                    }else{
                        $btn = '<a class="btn btn-warning" href="'.route('user.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                                <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                    }
                    return $btn;
                })
                ->addColumn('fullname',function($data){
                    $fullname = $data['f_name'] . ' ' . $data['l_name'];
                    return $fullname;
                })
                ->addColumn('status',function($data){
                    if($data['status']){
                        if(Auth::user()->id == $data['id']){
                            $status = '<label class="switch">
                                    <input type="checkbox" checked value= "0" id="' . $data['id'] . '" onchange="status(this)" disabled>
                                    <span class="slider round"></span>
                                    </label>';
                        }else{
                            $status = '<label class="switch">
                                    <input type="checkbox" checked value= "0" id="' . $data['id'] . '" onchange="status(this)">
                                    <span class="slider round"></span>
                                    </label>';
                        }
                    }else{
                        if(Auth::user()->id == $data['id']){
                            $status = '<label class="switch">
                                  <input type="checkbox" value="1" id="'.$data['id'].'" onchange="status(this)" disabled>
                                  <span class="slider round"></span>
                                </label>';
                        }else{
                            $status = '<label class="switch">
                                  <input type="checkbox" value="1" id="'.$data['id'].'" onchange="status(this)">
                                  <span class="slider round"></span>
                                </label>';
                        }

                    }

                    return $status;
                })
                ->rawColumns(['btn','status'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefixes = User_prefix::all();
        $roles = Role::all();
        $positions = User_position::where('publish',1)->get();
        return view('admin.user.create',compact('prefixes','roles','positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'fname'=>'required',
        //     'lname'=>'required',
        //     'nickname'=>'required',
        //     'born'=>'required',
        //     'phone'=>'required',
        //     'password' => 'required',
        //     'email' => 'required|unique:users,email',
        // ],[
        //     'email.unique' => "อีเมลนี้ถูกใช้งานแล้ว",
        // ]);

        $users = new User();
        $users->user_prefix_id = $request->user_prefix;
        $users->f_name = $request->fname;
        $users->l_name = $request->lname;
        $users->nickname = $request->nickname;
        $users->born = $request->born;
        $users->hobby = $request->hobby;
        $users->line_id = $request->lineid;
        $users->phone = $request->phone;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->created_at = Carbon::now();
        $users->updated_at = Carbon::now();

        if($users->save()){
            $users->user_position()->attach($request->position);
            $users->assignRole($request->role);

            if($request->file('imgs')){
                // dd($request->file('imgs'));
                $getImage = $request->file('imgs');
                $newname = time().'.'.$getImage->extension();
                Storage::putFileAs('public', $getImage, $newname);
                $users->addMedia(storage_path('app\public\\').$newname)->toMediaCollection('user');
            }

            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('user.index');
        }
        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('user.create');
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
        $user = User::find($id);
        $prefix = User_prefix::all();
        $roles = Role::all();
        $user_has_role = $user->roles()->get()[0]->name;
        $positions = User_position::where('publish',1)->get();;

        // dd($positions);
        return view('admin.user.edit',compact('user','prefix','roles','user_has_role','positions'));
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

        $users = User::whereId($id)->first();

        $request->validate([
            'fname'=>'required',
            'email' => 'required|unique:users,email,'. $users->id,
        ],
        [
            'email.unique' => "อีเมลนี้ถูกใช้งานแล้ว",
        ]);

        // dd($request);

        if($request->has('email') && $users->email != $request->email){
            $users->email = $request->email;
        }

        if($request->password != null){
            $users->password = bcrypt($request->password);
        }

        $users->user_prefix_id = $request->user_prefix;
        $users->f_name = $request->fname;
        $users->l_name = $request->lname;
        $users->nickname = $request->nickname;
        $users->born = $request->born;
        $users->hobby = $request->hobby;
        $users->line_id = $request->lineid;
        $users->phone = $request->phone;
        $users->updated_at = Carbon::now();

        // dd($users);
        if($users->save()){
            $users->user_position()->sync($request->position);
            $users->removeRole($users->roles()->get()[0]->name);
            $users->assignRole($request->role);

            if($request->file('imgs')){
                $medias = $users->getMedia('user');
                if(count($medias) > 0){
                    foreach ($medias as $media) {
                        $media->delete();
                    }
                }

                $getImage = $request->file('imgs');
                $newname = time().'.'.$getImage->extension();
                Storage::putFileAs('public', $getImage, $newname);
                $users->addMedia(storage_path('app\public\\').$newname)->toMediaCollection('user');
            }

            Alert::success('บันทึกข้อมูล');
            return redirect()->route('user.index');
        }

        Alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('user.edit');
        // dd($id);
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

        $users = User::whereId($id)->first();
        $users->removeRole($page->roles()->get()[0]->name);

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function status($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $users = User::whereId($id)->first();
        $users->status = $request->data;
        $users->updated_at = Carbon::now();
        if($users->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
