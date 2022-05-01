<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index');
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
        if($request->title){
            setting(['title' => $request->title])->save();
        }

        if ($request->file('favicon')){
            if(!empty(setting('favicon'))){
                File::delete(public_path(setting('favicon')));
            }
            //resize image
            $path = storage_path('tmp/uploads');
            $imgwidth = 300;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('favicon');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $full_path = public_path('uploads/setting/'.$name);
            $img = \Image::make($file->getRealPath());
            if ($img->width() > $imgwidth) {
                $img->resize($imgwidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->save($full_path);
            setting(['favicon' => 'uploads/setting/'.$name])->save();
        }

        if ($request->file('logonav')){
            if(!empty(setting('logonav'))){
                File::delete(public_path(setting('logonav')));
            }
            //resize image
            $path = storage_path('tmp/uploads');
            $imgwidth = 300;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('logonav');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $full_path = public_path('uploads/setting/'.$name);
            $img = \Image::make($file->getRealPath());
            if ($img->width() > $imgwidth) {
                $img->resize($imgwidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->save($full_path);
            setting(['logonav' => 'uploads/setting/'.$name])->save();
        }

        if ($request->file('logologin')){
            if(!empty(setting('logologin'))){
                File::delete(public_path(setting('logologin')));
            }
            //resize image
            $path = storage_path('tmp/uploads');
            $imgwidth = 300;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('logologin');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $full_path = public_path('uploads/setting/'.$name);
            $img = \Image::make($file->getRealPath());
            if ($img->width() > $imgwidth) {
                $img->resize($imgwidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->save($full_path);
            setting(['logologin' => 'uploads/setting/'.$name])->save();
        }

        Alert::success('success');
        return redirect()->route('setting.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
