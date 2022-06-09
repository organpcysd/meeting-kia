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
use App\Models\Car_stock;
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
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
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
                $btn = '<a id = "editbtn" type="button" class="btn btn-warning" href="'. route('received.edit', ['received' => $data['id']]) .'"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['customer_name','nickname','car','user_name','btn','select'])
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
        return view('admin.received.received.create',compact('reserved','customers','users','cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //pattern
        $config = [
            'table' => 'received',
            'field' => 'serial_number',
            'length' => 11,
            'prefix' => 'TRC' . date('y') . date('m')
        ];
        // now use it
        $serial_number = IdGenerator::generate($config);

        $received = new Received();
        $received->serial_number = $serial_number;
        $received->user_id = $request->user;
        $received->customer_id = $request->customer;
        $received->reserved_id = $request->reserved;
        $received->car_id = $request->car;
        $received->stock_id = $request->chassis;
        $received->payment_by = $request->payment_by;
        $received->received_date = $request->received_date;
        $received->created_at = Carbon::now();
        $received->updated_at = Carbon::now();

        if($received->save()){
            $received_detail = new received_detail();
            $received_detail->received_id = $received->id;
            $received_detail->condition = $request->condition;
            $received_detail->payable = $request->payable;
            $received_detail->price_car = $request->price_car;
            $received_detail->payment_discount = $request->payment_discount;
            $received_detail->price_car_net = $request->price_car_net;
            $received_detail->term_credit = $request->term_credit;
            $received_detail->interest = $request->interest;
            $received_detail->hire_purchase = $request->hire_purchase;
            $received_detail->term_payment = $request->term_payment;
            $received_detail->payment_down = $request->payment_down;
            $received_detail->payment_down_discount = $request->payment_down_discount;
            $received_detail->deposit_roll = $request->deposit_roll;
            $received_detail->payment_decorate = $request->payment_decorate;
            $received_detail->payment_insurance = $request->payment_insurance;
            $received_detail->payment_other = $request->payment_other;
            $received_detail->car_change = $request->car_change;
            $received_detail->payment_car_turn = $request->payment_car_turn;
            $received_detail->subtotal = $request->subtotal;
            $received_detail->accessories = $request->accessories;

            if($received_detail->save()){
                if($request->chassis){
                    $carstock = Car_stock::whereId($request->chassis)->first();
                    $carstock->status = "sold";
                }
                alert::success('เพิ่มข้อมูลสำเร็จ');
                return redirect()->route('received.index');
            }
        }

        alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('received.create');
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
        $received = Received::whereId($id)->first();
        $reserved = Reserved::all();
        $customers = Customer::whereIn('status',['pending','traffic','quotation'])->get();
        $users = User::all();
        $cars = Car::all();
        $carstocks = Car_stock::where('car_id',$received->car_id)->get();

        return view('admin.received.received.edit',compact('received','reserved','users','cars','customers','carstocks'));
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
        $received = Received::whereId($id)->first();
        $received->serial_number = $serial_number;
        $received->user_id = $request->user;
        $received->customer_id = $request->customer;
        $received->reserved_id = $request->reserved;
        $received->car_id = $request->car;
        $received->stock_id = $request->chassis;
        $received->payment_by = $request->payment_by;
        $received->received_date = $request->received_date;
        $received->updated_at = Carbon::now();

        if($received->save()){
            $received_detail = Received_detail::where('received_id',$id)->first();
            $received_detail->received_id = $received->id;
            $received_detail->condition = $request->condition;
            $received_detail->payable = $request->payable;
            $received_detail->price_car = $request->price_car;
            $received_detail->payment_discount = $request->payment_discount;
            $received_detail->price_car_net = $request->price_car_net;
            $received_detail->term_credit = $request->term_credit;
            $received_detail->interest = $request->interest;
            $received_detail->hire_purchase = $request->hire_purchase;
            $received_detail->term_payment = $request->term_payment;
            $received_detail->payment_down = $request->payment_down;
            $received_detail->payment_down_discount = $request->payment_down_discount;
            $received_detail->deposit_roll = $request->deposit_roll;
            $received_detail->payment_decorate = $request->payment_decorate;
            $received_detail->payment_insurance = $request->payment_insurance;
            $received_detail->payment_other = $request->payment_other;
            $received_detail->car_change = $request->car_change;
            $received_detail->payment_car_turn = $request->payment_car_turn;
            $received_detail->subtotal = $request->subtotal;
            $received_detail->accessories = $request->accessories;

            if($received_detail->save()){
                alert::success('บันทึกข้อมูลสำเร็จ');
                return redirect()->route('received.index');
            }
        }

        alert::error('ไม่สามารถแก้ไขข้อมูลได้');
        return redirect()->route('received.edit');
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

        $received = Received::whereId($id)->first();

        if ($received->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataReserved(Reserved $reserved){
        $customers= Customer::all();
        $users = User::all();
        $cars = Car::with('car_model','car_level','car_type','car_color')->get();
        $reserved_detail = Reserved_detail::whereId($reserved->id)->first();
        return response()->json(['reserved' => $reserved, 'customers' => $customers, 'users' => $users, 'cars' => $cars, 'reserved_detail' => $reserved_detail]);
    }

    public function getDataCarstock(Car $car){
        $carstock = $car->car_stock;
        return response()->json(['carstock' => $carstock]);
    }

    public function getDataEngine(Car_stock $carstock){
        return response()->json(['carstock' => $carstock]);
    }

    public function getDataCustomeraddress(Customer $customer){
        $address = $customer->customer_address->with('provinces','districts','canton')->get();
        return response()->json(['address' => $address]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $received = Received::whereIn('id',$ids);

        if($received->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('received.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('received.index');
    }
}
