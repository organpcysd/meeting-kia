<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Quotation;
use App\Models\Quotation_detail;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use App\Models\Car_gift;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Quotation::where('quotation_status','pending')->get();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('serial_number',function($data){
                $serial_number = "<a href='#' class='pe-auto' onclick='modalshow(". $data['id'] . ")'>". '<i class="fa-solid fa-eye"></i>' .' '. $data['serial_number'] . "</a>";
                return $serial_number;
            })
            ->addColumn('customer_name',function($data){
                $customer_name = $data->customer->customer_prefix->title . ' ' . $data->customer->f_name;
                return $customer_name;
            })
            ->addColumn('nickname',function($data){
                $nickname = $data->customer->nickname;
                return $nickname;
            })
            ->addColumn('user_name',function($data){
                $user_name = $data->user->f_name . ' ' . $data->user->l_name;
                return $user_name;
            })
            ->addColumn('created_at',function($data){
                $created_at = $data['created_at'];
                return $created_at;
            })
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<a type="button" class="btn btn-info" href="'. route('quotation.pdf', ['quotation' => $data['id']]) .'" target="_blank"><i class="fa fa-print"></i></a>
                        <a id = "editbtn" type="button" class="btn btn-warning" href="'. route('quotation.edit', ['quotation' => $data['id']]) .'"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['btn','nickname','created_at','customer_name','user_name','select','serial_number'])
            ->make(true);
        }
        return view('admin.quotation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::whereIn('status',['pending','traffic','quotation'])->get();
        $users = User::all();
        $cars = Car::all();
        $accessories = Car_gift::all();
        return view('admin.quotation.create',compact('customers','users','cars','accessories'));
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
            'table' => 'quotation',
            'field' => 'serial_number',
            'length' => 11,
            'prefix' => 'TCQ' . date('y') . date('m')
        ];
        // now use it
        $serial_number = IdGenerator::generate($config);

        $quotation = new Quotation();
        $quotation->serial_number = $serial_number;
        $quotation->customer_id = $request->customer;
        $quotation->user_id = $request->user;
        $quotation->contact_id = $request->contact;
        $quotation->car_id = $request->car;
        $quotation->place_send = $request->place_send;
        $quotation->estimate_send = $request->estimate_send;
        $quotation->allow_status = 'follow';
        $quotation->quotation_status = 'pending';
        $quotation->created_at = Carbon::now();
        $quotation->updated_at = Carbon::now();

        if($quotation->save()) {
            $quotation_detail = new Quotation_detail();
            $quotation_detail->quotation_id = $quotation->id;
            $quotation_detail->condition = $request->condition;
            $quotation_detail->price_car = $request->price_car;
            $quotation_detail->payment_discount = $request->payment_discount;
            $quotation_detail->price_car_net = $request->price_car_net;
            $quotation_detail->payment_down = $request->payment_down;
            $quotation_detail->payment_down_discount = $request->payment_down_discount;
            $quotation_detail->term_credit = $request->term_credit;
            $quotation_detail->interest = $request->interest;
            $quotation_detail->hire_purchase = $request->hire_purchase;
            $quotation_detail->term_payment = $request->term_payment;
            $quotation_detail->deposit_roll = $request->deposit_roll;
            $quotation_detail->payment_decorate = $request->payment_decorate;
            $quotation_detail->payment_insurance = $request->payment_insurance;
            $quotation_detail->payment_other = $request->payment_other;
            $quotation_detail->car_change = $request->car_change;
            $quotation_detail->payment_car_turn = $request->payment_car_turn;
            $quotation_detail->accessories = $request->accessories;
            $quotation_detail->subtotal = $request->subtotal;

            if($quotation_detail->save()){
                $quotation_detail->car_gift()->attach($request->gift);
                Alert::success('เพิ่มข้อมูลสำเร็จ');
                return redirect()->route('quotation.index');
            }
        }

        Alert::error('ไม่สามารถเพิ่มข้อมูลได้');
        return redirect()->route('quotation.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotations = Quotation::whereId($id)->with('customer','contact','user','quotation_detail','car','car.car_model','car.car_level','car.car_color')->first();
        return response()->json(['quotations' => $quotations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $customers = Customer::whereIn('status',['pending','traffic','quotation'])->get();
        $users = User::all();
        $cars = Car::all();
        $accessories = Car_gift::all();
        return view('admin.quotation.edit',compact('quotation','customers','users','cars','accessories'));
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
        $quotation = Quotation::whereId($id)->first();
        $quotation->customer_id = $request->customer;
        $quotation->user_id = $request->user;
        $quotation->contact_id = $request->contact;
        $quotation->car_id = $request->car;
        $quotation->place_send = $request->place_send;
        $quotation->estimate_send = $request->estimate_send;
        $quotation->allow_status = 'follow';
        $quotation->quotation_status = 'pending';
        $quotation->updated_at = Carbon::now();

        if($quotation->save()) {
            $quotation_detail = Quotation_detail::whereId($quotation->quotation_detail->quotation_id)->first();
            $quotation_detail->quotation_id = $quotation->id;
            $quotation_detail->condition = $request->condition;
            $quotation_detail->price_car = $request->price_car;
            $quotation_detail->payment_discount = $request->payment_discount;
            $quotation_detail->price_car_net = $request->price_car_net;
            $quotation_detail->payment_down = $request->payment_down;
            $quotation_detail->payment_down_discount = $request->payment_down_discount;
            $quotation_detail->term_credit = $request->term_credit;
            $quotation_detail->interest = $request->interest;
            $quotation_detail->hire_purchase = $request->hire_purchase;
            $quotation_detail->term_payment = $request->term_payment;
            $quotation_detail->deposit_roll = $request->deposit_roll;
            $quotation_detail->payment_decorate = $request->payment_decorate;
            $quotation_detail->payment_insurance = $request->payment_insurance;
            $quotation_detail->payment_other = $request->payment_other;
            $quotation_detail->car_change = $request->car_change;
            $quotation_detail->payment_car_turn = $request->payment_car_turn;
            $quotation_detail->accessories = $request->accessories;
            $quotation_detail->subtotal = $request->subtotal;
            $quotation_detail->updated_at = Carbon::now();


            if($quotation_detail->save()){
                $quotation_detail->car_gift()->sync($request->gift);
                Alert::success('บันทึกข้อมูลสำเร็จ');
                return redirect()->route('quotation.index');
            }
        }

        Alert::error('ไม่สามารถแก้ไขข้อมูลได้');
        return redirect()->route('quotation.edit', ['quotation' => $id]);
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

        $quotation = Quotation::whereId($id)->first();

        if ($quotation->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataCar(Request $request){
        $car = Car::whereId($request->id)->first();
        return response()->json($car);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $quotation = Quotation::whereIn('id',$ids);

        if($quotation->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->route('quotation.index');
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->route('quotation.index');
    }

    public function pdf(Quotation $quotation){
        $price_string = $this->Convert($quotation->quotation_detail->price_car);
        $pdf = PDF::loadView('admin.quotation.pdf',['quotations' => $quotation, 'price_string' => $price_string]);
        return @$pdf->stream();
    }

    public function Convert($amount_number){
        $amount_number = number_format($amount_number, 2, ".","");
        $pt = strpos($amount_number , ".");
        $number = $fraction = "";
        if ($pt === false)
            $number = $amount_number;
        else
        {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        $ret = "";
        $baht = $this->ReadNumber ($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = $this->ReadNumber($fraction);
        if ($satang != "")
            $ret .=  $satang . "สตางค์";
        else
            $ret .= "ถ้วน";
        return $ret;
    }

    public function ReadNumber($number){
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000)
        {
            $ret .= $this->ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while($number > 0)
        {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
                ((($divider == 10) && ($d == 1)) ? "" :
                ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }
}
