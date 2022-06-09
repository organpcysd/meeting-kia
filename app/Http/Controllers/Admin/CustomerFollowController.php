<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Customer;
use App\Models\Customer_follow;

class CustomerFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
         //
    }

    public function getData(Customer $customer,Request $request)
    {
        // dd($customer);
        if($request->ajax()){
            $data = Customer_follow::where('customer_id',$customer->id);

            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<a id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></a>';
                return $btn;
            })
            ->rawColumns(['btn','select'])
            ->make(true);
        }
        return view('admin.customer.follow.index',compact('customer'));
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
        // dd($request);
        $customer_follow = new Customer_follow();
        $customer_follow->customer_id = $request->customer_id;
        $customer_follow->follow_up = $request->follow_up;
        $customer_follow->follow_up_customer = $request->follow_up_customer;
        $customer_follow->recomment_ceo = $request->recomment_ceo;
        $customer_follow->follow_date = $request->follow_date;
        $customer_follow->created_at = Carbon::now();
        $customer_follow->updated_at = Carbon::now();

        if($customer_follow->save()){
            alert::success('บันทึกข้อมูลสำเร็จ');
            return redirect()->route('follow.getData',['customer' => $request->customer_id]);
        }

        alert::error('บันทึกข้อมูลไม่สำเร็จ');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer_follow = Customer_follow::whereId($id)->first();
        return response()->json($customer_follow);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $customer_follow = Customer_follow::where($id)->first();
        // return response()->json($customer_follow);
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

        $customer_follow = Customer_follow::whereId($id)->first();

        $customer_follow->follow_up = $request->follow_up_edit;
        $customer_follow->follow_up_customer = $request->follow_up_customer_edit;
        $customer_follow->recomment_ceo = $request->recomment_eco_edit;
        $customer_follow->follow_date = $request->follow_date_edit;
        $customer_follow->updated_at = Carbon::now();

        // dd($customer_follow->recomment_ceo);
        if($customer_follow->save()){
            $status = true;
            $message = 'อัพเดทข้อมูลเรียบร้อย';
        }

        return response()->json(['status'=>$status,'message'=>$message]);
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

        $customer_follow = Customer_follow::whereId($id)->first();

        if ($customer_follow->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function changestatus(Request $request){

        $status = false;
        $message = 'ไม่สามารถเปลี่ยนสถานะได้';

        $customer = Customer::whereId($request->id)->first();
        $customer->status = $request->cus_status;

        if ($customer->save()){
            $status = true;
            $message = 'อัพเดทสถานะเรียบร้อยแล้ว';
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $customer_follow = Customer_follow::whereIn('id',$ids);

        if($customer_follow->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->back();
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->back();
    }
}
