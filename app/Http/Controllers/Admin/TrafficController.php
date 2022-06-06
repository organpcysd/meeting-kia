<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Traffic;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use App\Models\Car_model;
use App\Models\Car_level;
use App\Models\Car_color;
use App\Models\Traffic_source;
use App\Models\Traffic_channel;

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
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-info" href="'. route('follow.getData',['customer' => $data['id']]) .'">ติดตาม</a>
                        <a class="btn btn-warning" href="'.route('customer.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn'])
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
        $carmodel = $request->carmodel;
        $carlevel = $request->carlevel;
        $carcolor = $request->carcolor;


        for($c2 = 0; $c2 < count($carcolor); $c2++){
            $color = array( $carcolor[$c2]);
            $color_data[] = $color;
        }

        for($c1 = 0; $c1 < count($carlevel); $c1++){
            $level = array(
                'level' => $carlevel[$c1],
            );
            $color_data[] = $level;
        }

        for($c = 0; $c < count($carmodel); $c++){
            $model = array(
            'model' => $carmodel[$c],
            );
            $model_data[] = $model;

            $car = array('model' => $model_data,'level' => $color_data,'color' => $color_data);
            $car_data[] = $car;
        }

        dd($car_data);


        // for($c = 0; $c < count($carcolor); $c++){
        //     $color = array(
        //         'color' => $carcolor[$c],
        //     );
        //     $color_data[] = $color;
        //     for($c1 = 0; $c1 < count($carlevel); $c1++){
        //         $level = array(
        //             'level' => $carlevel[$c1],
        //         );
        //         $level_data[] = $level;
        //         for($c2 = 0; $c2 < count($carmodel); $c2++){
        //         $model = array(
        //             'model' => $carmodel[$c2],
        //             'level' => $level_data[$c1]
        //         );
        //         $model_data[] = $model;
        //         }
        //     }
        // }

        // dd($model_data);

        // for($c = 0; $c < count($carmodel); $c++){
        //     $model = array(
        //         'model' => $carmodel[$c],
        //     );
        //     $model_data[] = $model;
        //     for($c1 = 0; $c1 < count($carlevel); $c1++){
        //         $level = array(
        //             'model' => $model_data[$c],
        //             'level' => $carlevel[$c1],
        //         );
        //         $level_data[] = $level;
        //         for($c2 = 0; $c2 < count($carcolor); $c2++){
        //             $color = array(
        //                 'model' => $model_data[$c],
        //                 'level' => $level_data[$c1],
        //                 'color' => $carcolor[$c2],
        //             );
        //             $color_data[] = $color;
        //         }
        //     }
        // }

        // dd($color_data);
        // for($count = 0; $count < count($carmodel); $count++){
        //     for($count1 = 0; $count1 < count($carlevel); $count1++){
        //         for($count2 = 0; $count2 < count($carcolor); $count2++){
        //             $insert = array(
        //             'model' => $carmodel[$count],
        //             'level' => $carlevel[$count1],
        //             'color' => $carcolor[$count2]
        //         );
        //         $insert_data[] = $insert;
        //         }
        //     }
        // }
        dd($insert_data);

        // $traffic = new Traffic();

        // if($request->dicision_input != null){
        //     $traffic->dicision = $request->dicision_input;
        // }

        // if($request->location_input != null){
        //     $traffic->location = $request->dicision_input;
        // }

        // $traffic->customer_id = $request->customer;
        // $traffic->user_id = $request->user;
        // $traffic->dicision = $request->dicision;
        // $traffic->source_id = $request->traffic_source;
        // $traffic->location = $request->location;
        // $traffic->target = $request->target;
        // $traffic->contact_result = $request->contact_result;
        // $traffic->channel_id = $request->traffic_channel;
        // $traffic->tenor = $request->tenor;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
}
