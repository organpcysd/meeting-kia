<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Models\Traffic;
use App\Models\Traffic_car_item;
use App\Models\Traffic_source;
use App\Models\Traffic_channel;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use App\Models\Car_model;
use App\Models\Car_level;
use App\Models\Car_color;


class TrafficController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Traffic::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-warning" href="'.route('traffic.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['btn','select'])
            ->make(true);
        }
        return view('admin.traffic.traffic.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        $sources = Traffic_source::all();
        $channels = Traffic_channel::all();
        $carmodels = Car_model::all();
        $carlevels = Car_level::all();
        $carcolors = Car_color::all();

        return view('admin.traffic.traffic.create',compact('customers','users','carmodels','carlevels','carcolors','sources','channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $traffic = new Traffic();

        if($request->dicision_input != null){
            $traffic->dicision = $request->dicision_input;
        }else{
            $traffic->dicision = $request->dicision;
        }

        if($request->location_input != null){
            $traffic->location = $request->location_input;
        }else{
            $traffic->location = $request->location;
        }

        if($request->staff_pick != null){
            $traffic->testdrive = "Y";
        }else{
            $traffic->testdrive = "N";
        }

        $traffic->customer_id = $request->customer;
        $traffic->user_id = $request->user;
        $traffic->dicision = $request->dicision;
        $traffic->source_id = $request->traffic_source;
        $traffic->target = $request->target;
        $traffic->contact_result = $request->contact_result;
        $traffic->channel_id = $request->traffic_channel;
        $traffic->tenor = $request->tenor;
        $traffic->staff_pick = $request->staff_pick;
        $traffic->created_at = Carbon::now();
        $traffic->updated_at = Carbon::now();

        if($traffic->save()){
            $traffic_car_item = new Traffic_car_item();
            $traffic_car_item->traffic_id = $traffic->id;
            $traffic_car_item->model_id = json_encode($request->carmodel);
            $traffic_car_item->level_id = json_encode($request->carlevel);
            $traffic_car_item->color_id = json_encode($request->carcolor);

            if($request->file('imgs')){
                $getImage = $request->file('imgs');
                $newname = time().'.'.$getImage->extension();
                Storage::putFileAs('public', $getImage, $newname);
                $traffic->addMedia(storage_path('app\public\\').$newname)->toMediaCollection('traffic');
            }

            if($traffic_car_item->save()){
                Alert::success('เพิ่มข้อมูลสำเร็จ');
                return redirect()->route('traffic.index');
            }
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('traffic.create');

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
        $traffic = Traffic::whereId($id)->first();
        $customers = Customer::all();
        $users = User::all();
        $sources = Traffic_source::all();
        $channels = Traffic_channel::all();
        $carmodels = Car_model::all();
        $carlevels = Car_level::all();
        $carcolors = Car_color::all();
        return view('admin.traffic.traffic.edit',compact('traffic','customers','users','sources','channels','carmodels','carlevels','carcolors'));
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
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';

        $traffic = Traffic::whereId($id)->first();

        if ($traffic->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataCarlevels(Request $request){
        // dd($request->model_id);
        $carlevels = Car_level::whereIn('model_id',$request->model_id)->get();
        // dd($carlevels);
        return response()->json($carlevels);
    }

    public function getDataCarcolors(Request $request){
        // dd($request->level_id);
        $carcolors = Car::whereIn('level_id',$request->level_id)->distinct()->pluck('color_id')->toArray();
        $colors = Car_color::whereIn('id',$carcolors)->get();
        // dd($colors);
        return response()->json($colors);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $traffic = traffic::whereIn('id',$ids);

        if($traffic->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('traffic.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('traffic.index');
    }

    public function getDataTraffic(Traffic $traffic){
        $traffic_car_item = Traffic_car_item::where('traffic_id',$traffic->id)->get();
        return response()->json(['traffic' => $traffic,'traffic_car_item' => $traffic_car_item]);
    }
}
