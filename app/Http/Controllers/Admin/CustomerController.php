<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Customer;
use App\Models\User_prefix;
use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Canton;
use App\Models\Customer_address;
use App\Models\User;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Customer::all();
            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('name',function($data){
                $name = $data['f_name'] . ' ' . $data['l_name'];
                return $name;
            })
            //url('admin/customer/follow')."/".$data['id']
            ->addColumn('btn',function($data){
                $btn = '<a class="btn btn-info" href="'. route('follow.getData',['customer' => $data['id']]) .'">ติดตาม</a>
                        <a class="btn btn-warning" href="'.route('customer.edit',$data['id']).'"><i class="fa fa-pen" data-toggle="tooltip" title="แก้ไข"></i></a>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->addColumn('staff_name',function($data){
                $staff_name = $data->user->f_name . ' ' . $data->user->l_name;
                return $staff_name;

            })
            ->addColumn('status',function($data){
                $status = 'a';
                if($data['status'] == 'pending'){
                    $status = '<h5><span class="badge badge-secondary">'. $data['status'] .'</span></h5>';
                }elseif($data['status'] == 'traffic'){
                    $status = '<h5><span class="badge badge-primary">'. $data['status'] .'</span></h5>';
                }elseif($data['status'] == 'quatation'){
                    $status = '<h5><span class="badge badge-info">'. $data['status'] .'</span></h5>';
                }elseif($data['status'] == 'booked'){
                    $status = '<h5><span class="badge badge-warning text-white">'. $data['status'] .'</span></h5>';
                }elseif($data['status'] == 'success'){
                    $status = '<h5><span class="badge badge-success">'. $data['status'] .'</span></h5>';
                }elseif($data['status'] == 'canceled'){
                    $status = '<h5><span class="badge badge-danger">'. $data['status'] .'</span></h5>';
                }

                return $status;
            })
            ->rawColumns(['btn','name','staff_name','status'])
            ->make(true);
        }
        return view('admin.customer.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefixes = User_prefix::all();
        $provinces = Provinces::all();
        $districts = Districts::all();
        $canton = Canton::all();
        return view('admin.customer.customer.create',compact('prefixes','provinces','districts','canton'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $customer->citizen_id = $request->citizen_id;
        $customer->itax_id = $request->itax_id;
        $customer->prefix_id = $request->customer_prefix;
        $customer->f_name = $request->fname;
        $customer->l_name = $request->lname;
        $customer->nickname = $request->nickname;
        $customer->born = $request->born;
        $customer->vocation = $request->vocation;
        $customer->phone = $request->phone;
        $customer->fax = $request->fax;
        $customer->email = $request->email;
        $customer->line_id = $request->lineid;
        $customer->hobby = $request->hobby;
        $customer->customer_type = 'urgent';
        $customer->status = 'pending';
        $customer->staff_id = $request->staff_id;
        $customer->created_at = Carbon::now();
        $customer->updated_at = Carbon::now();

        if($customer->save()){
            $address = new Customer_address();
            $address->customer_id = $customer->id;
            $address->house_number = $request->house_number;
            $address->alley = $request->alley;
            $address->group = $request->group;
            $address->road = $request->road;
            $address->village = $request->village;
            $address->province_id = $request->provinces;
            $address->district_id = $request->districts;
            $address->canton_id = $request->canton;
            $address->zipcode = $request->zipcode;
            $address->created_at = Carbon::now();
            $address->updated_at = Carbon::now();

            if($address->save()){
                alert::success('เพิ่มข้อมูลสำเร็จ');
                return redirect()->route('customer.index');
            }
        }

        alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('customer.create');

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
        $customer = Customer::whereId($id)->first();
        $address = $customer->customer_address;
        $prefixes = User_prefix::all();
        $provinces = Provinces::all();

        return view('admin.customer.customer.edit',compact('customer','address','prefixes','provinces'));
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
        $customer = Customer::whereId($id)->first();

        $customer->citizen_id = $request->citizen_id;
        $customer->itax_id = $request->itax_id;
        $customer->prefix_id = $request->customer_prefix;
        $customer->f_name = $request->fname;
        $customer->l_name = $request->lname;
        $customer->nickname = $request->nickname;
        $customer->born = $request->born;
        $customer->vocation = $request->vocation;
        $customer->phone = $request->phone;
        $customer->fax = $request->fax;
        $customer->email = $request->email;
        $customer->line_id = $request->lineid;
        $customer->hobby = $request->hobby;
        $customer->customer_type = 'urgent';
        $customer->status = 'normal';
        $customer->staff_id = $request->staff_id;
        $customer->updated_at = Carbon::now();

        if($customer->save()){
            $address = Customer_address::whereId($request->address_id)->first();
            $address->customer_id = $customer->id;
            $address->house_number = $request->house_number;
            $address->alley = $request->alley;
            $address->group = $request->group;
            $address->road = $request->road;
            $address->village = $request->village;
            $address->province_id = $request->provinces;
            $address->district_id = $request->districts;
            $address->canton_id = $request->canton;
            $address->zipcode = $request->zipcode;
            $address->updated_at = Carbon::now();

            if($address->save()){
                alert::success('บันทึกข้อมูลสำเร็จ');
                return redirect()->route('customer.index');
            }
        }

        alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('customer.edit');
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

        $page = Customer::whereId($id)->first();

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getDataProvinces(Request $request){
        $districts = Districts::where('province_id',$request->id)->get();
        return $districts;
    }

    public function getDataDistricts(Request $request){
        $canton = Canton::where('district_id',$request->id)->get();
        return $canton;
    }

    public function getDataZipcode(Request $request){
        $zipcode = Canton::where('id',$request->id)->get();
        return $zipcode;
    }
}
