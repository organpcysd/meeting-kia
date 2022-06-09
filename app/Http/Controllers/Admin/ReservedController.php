<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Reserved;
use App\Models\Reserved_detail;
use App\Models\quotation;
use App\Models\quotation_detail;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use App\Models\Car_gift;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ReservedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Reserved::all();
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
            ->addColumn('payable',function($data){
                if($data->reserved_detail){
                    $payable = $data->reserved_detail->payable;
                }else{
                    $payable = 0;
                }
                return $payable;
            })
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<a id = "editbtn" type="button" class="btn btn-warning" href="'. route('reserved.edit', ['reserved' => $data['id']]) .'"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['customer_name','nickname','car','user_name','btn','payable','select'])
            ->make(true);
        }
        return view('admin.reserved.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quotations = Quotation::all();
        $customers = Customer::all();
        $users = User::all();
        $cars = Car::all();
        $accessories = Car_gift::all();
        return view('admin.reserved.create',compact('quotations','customers','users','cars','accessories'));
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
            'table' => 'reserved',
            'field' => 'serial_number',
            'length' => 11,
            'prefix' => 'TCB' . date('y') . date('m')
        ];
        // now use it
        $serial_number = IdGenerator::generate($config);

        $reserved = new Reserved();
        $reserved->serial_number = $serial_number;
        $reserved->user_id = $request->user;
        $reserved->quotation_id = $request->quotation;
        $reserved->customer_id = $request->customer;
        $reserved->contact_id = $request->contact;
        $reserved->car_id = $request->car;
        $reserved->place_send = $request->place_send;
        $reserved->estimate_send = $request->estimate_send;
        $reserved->status_reserved = 'pending';
        $reserved->payment_by = $request->payment_by;
        $reserved->payment_bank = $request->payment_bank;
        $reserved->payment_no = $request->payment_no;
        $reserved->reserved_date = $request->reserved_date;
        $reserved->created_at = Carbon::now();
        $reserved->updated_at = Carbon::now();

        if($reserved->save()){
            $reserved_detail = new Reserved_detail();
            $reserved_detail->reserved_id = $reserved->id;
            $reserved_detail->condition = $request->condition;
            $reserved_detail->payable = $request->payable;
            $reserved_detail->price_car = $request->price_car;
            $reserved_detail->payment_discount = $request->payment_discount;
            $reserved_detail->price_car_net = $request->price_car_net;
            $reserved_detail->term_credit = $request->term_credit;
            $reserved_detail->interest = $request->interest;
            $reserved_detail->payment_regis = $request->payment_regis;
            $reserved_detail->hire_purchase = $request->hire_purchase;
            $reserved_detail->first_purchase = $request->first_purchase;
            $reserved_detail->term_payment = $request->term_payment;
            $reserved_detail->payment_down = $request->payment_down;
            $reserved_detail->payment_down_discount = $request->payment_down_discount;
            $reserved_detail->deposit_roll = $request->deposit_roll;
            $reserved_detail->payment_decorate = $request->payment_decorate;
            $reserved_detail->payment_insurance = $request->payment_insurance;
            $reserved_detail->payment_other = $request->payment_other;
            $reserved_detail->car_change = $request->car_change;
            $reserved_detail->payment_car_turn = $request->payment_car_turn;
            $reserved_detail->subtotal = $request->subtotal;
            $reserved_detail->accessories = $request->accessories;
            $reserved_detail->accessories_buy = $request->accessories_buy;

            if($reserved_detail->save()){
                $reserved_detail->car_gift()->attach($request->gift);
                alert::success('เพิ่มข้อมูลสำเร็จ');
                return redirect()->route('reserved.index');
            }
        }

        alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('reserved.create');
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
        $reserved = Reserved::whereId($id)->first();
        $quotations = Quotation::all();
        $customers = Customer::whereIn('status',['pending','traffic','quotation'])->get();
        $users = User::all();
        $cars = Car::all();
        $accessories = Car_gift::all();

        return view('admin.reserved.edit',compact('quotations','reserved','users','cars','accessories','customers'));
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
        $reserved = Reserved::whereId($id)->first();
        $reserved->user_id = $request->user;
        $reserved->quotation_id = $request->quotation;
        $reserved->customer_id = $request->customer;
        $reserved->contact_id = $request->contact;
        $reserved->car_id = $request->car;
        $reserved->place_send = $request->place_send;
        $reserved->estimate_send = $request->estimate_send;
        $reserved->status_reserved = 'pending';
        $reserved->payment_by = $request->payment_by;
        $reserved->payment_bank = $request->payment_bank;
        $reserved->payment_no = $request->payment_no;
        $reserved->reserved_date = $request->reserved_date;
        $reserved->updated_at = Carbon::now();

        if($reserved->save()){
            $reserved_detail = Reserved_detail::where('reserved_id',$id)->first();
            $reserved_detail->condition = $request->condition;
            $reserved_detail->payable = $request->payable;
            $reserved_detail->price_car = $request->price_car;
            $reserved_detail->payment_discount = $request->payment_discount;
            $reserved_detail->price_car_net = $request->price_car_net;
            $reserved_detail->term_credit = $request->term_credit;
            $reserved_detail->interest = $request->interest;
            $reserved_detail->payment_regis = $request->payment_regis;
            $reserved_detail->hire_purchase = $request->hire_purchase;
            $reserved_detail->first_purchase = $request->first_purchase;
            $reserved_detail->term_payment = $request->term_payment;
            $reserved_detail->payment_down = $request->payment_down;
            $reserved_detail->payment_down_discount = $request->payment_down_discount;
            $reserved_detail->deposit_roll = $request->deposit_roll;
            $reserved_detail->payment_decorate = $request->payment_decorate;
            $reserved_detail->payment_insurance = $request->payment_insurance;
            $reserved_detail->payment_other = $request->payment_other;
            $reserved_detail->car_change = $request->car_change;
            $reserved_detail->payment_car_turn = $request->payment_car_turn;
            $reserved_detail->subtotal = $request->subtotal;
            $reserved_detail->accessories = $request->accessories;
            $reserved_detail->accessories_buy = $request->accessories_buy;

            if($reserved_detail->save()){
                $reserved_detail->car_gift()->sync($request->gift);
                alert::success('บันทึกข้อมูลสำเร็จ');
                return redirect()->route('reserved.index');
            }
        }

        alert::error('ไม่สามารถแก้ไขข้อมูลได้');
        return redirect()->route('reserved.edit');
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

        $reserved = Reserved::whereId($id)->first();

        if ($reserved->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataQuotation(Quotation $quotation){
        $customers= Customer::all();
        $users = User::all();
        $cars = Car::with('car_model','car_level','car_type','car_color')->get();
        $car_gifts = Car_gift::all();
        $accessories = $quotation->quotation_detail->car_gift()->get();
        $quotation_detail = Quotation_detail::whereId($quotation->id)->first();
        return response()->json(['quotation' => $quotation, 'customers' => $customers, 'users' => $users, 'cars' => $cars, 'quotation_detail' => $quotation_detail, 'accessories' => $accessories, 'car_gifts' => $car_gifts]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $reserved = Reserved::whereIn('id',$ids);

        if($reserved->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('reserved.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('reserved.index');
    }
}
