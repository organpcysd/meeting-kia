<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Reserved;
use App\Models\Reserved_detail;
use App\Models\Received;
use App\Models\Received_detail;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use App\Models\Car_gift;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Received::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('customer_name',function($data){
                $customer_name = $data->customer->f_name . ' ' . $data->customer->l_name;
                return $customer_name;
            })
            ->addColumn('nickname',function($data){
                $nickname = $data->customer->nickname;
                return $nickname;
            })
            ->addColumn('car',function($data){
                $car = $data->car->car_model->model_name . ' ' . $data->car->car_level->level_name . ' ' . $data->car->car_color->color_name . ' ' . $data->car->years . ' ' . $data->car->price;
                return $car;
            })
            ->addColumn('user_name',function($data){
                $user_name = $data->user->f_name . ' ' . $data->user->l_name;
                return $user_name;
            })
            ->addColumn('btn',function($data){
                $btn = '<a id = "editbtn" type="button" class="btn btn-warning" href="'. route('reserved.edit', ['reserved' => $data['id']]) .'"><i class="fa fa-pen"></i></a>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['customer_name','nickname','car','user_name','btn'])
            ->make(true);
        }
        return view('admin.received.received.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reserved = Reserved::all();
        $customers = Customer::all();
        $users = User::all();
        $cars = Car::all();
        $accessories = Car_gift::all();
        return view('admin.received.received.create',compact('reserved','customers','users','cars','accessories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getDataReserved(Reserved $reserved){
        $customers= Customer::all();
        $users = User::all();
        $cars = Car::with('car_model','car_level','car_type','car_color')->get();
        $car_gifts = Car_gift::all();
        $reserved_detail = Reserved_detail::whereId($reserved->id)->first();
        return response()->json(['reserved' => $reserved, 'customers' => $customers, 'users' => $users, 'cars' => $cars, 'reserved_detail' => $reserved_detail, 'car_gifts' => $car_gifts]);
    }
}
