<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Received;
use App\Models\Received_detail;
use App\Models\Receivedfollow;

class ReceivedFollowController extends Controller
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
                $btn = '<a type="button" class="btn btn-info" href="'. route('receivedfollow.show', ['receivedfollow' => $data['id']]) .'">ติดตามหลังการขาย</i></a>';
                return $btn;
            })
            ->rawColumns(['customer_name','nickname','car','user_name','btn'])
            ->make(true);
        }
        return view('admin.received.follow.index');
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
        $receivedfollow = new Receivedfollow();
        $receivedfollow->received_id = $request->received_id;
        $receivedfollow->follow_up = $request->follow_up;
        $receivedfollow->follow_up_customer = $request->follow_up_customer;
        $receivedfollow->recomment_ceo = $request->recomment_ceo;
        $receivedfollow->follow_date = $request->follow_date;
        $receivedfollow->created_at = Carbon::now();
        $receivedfollow->updated_at = Carbon::now();

        if($receivedfollow->save()){
            alert::success('บันทึกข้อมูลสำเร็จ');
            return redirect()->route('receivedfollow.show',['receivedfollow' => $request->received_id]);
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
    public function show(Received $receivedfollow, Request $request)
    {
        if($request->ajax()){
            $data = Receivedfollow::where('received_id',$receivedfollow->id);

            return DataTables::make($data)
            ->addIndexColumn()
            ->addColumn('select',function($data){
                $select = '<input type="checkbox" class="select" id="select" name="select[]" value="'. $data['id'] . '">';
                return $select;
            })
            ->addColumn('btn',function($data){
                $btn = '<button id = "editbtn" type="button" class="btn btn-warning" onclick="modaledit('. $data['id'] .')"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-danger" onclick="deleteConfirmation('. $data['id'] .')"><i class="fa fa-trash" data-toggle="tooltip" title="ลบข้อมูล"></i></button>';
                return $btn;
            })
            ->rawColumns(['btn','select'])
            ->make(true);
        }

        return view('admin.received.follow.follow',compact('receivedfollow'));
    }

    public function getDataReceivedfollow(Receivedfollow $receivedfollow){
        return response()->json(['receivedfollow' => $receivedfollow]);
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
        $status = false;
        $message = 'ไม่สามารถอัพเดทข้อมูลได้';

        $receivedfollow = Receivedfollow::whereId($id)->first();

        $receivedfollow->follow_up = $request->follow_up_edit;
        $receivedfollow->follow_up_customer = $request->follow_up_customer_edit;
        $receivedfollow->recomment_ceo = $request->recomment_eco_edit;
        $receivedfollow->follow_date = $request->follow_date_edit;
        $receivedfollow->updated_at = Carbon::now();

        // dd($customer_follow->recomment_ceo);
        if($receivedfollow->save()){
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

        $receivedfollow = Receivedfollow::whereId($id)->first();

        if ($receivedfollow->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multidel(Request $request){
        $ids = $request->select;
        $receivedfollow = Receivedfollow::whereIn('id',$ids);

        if($receivedfollow->delete()) {
            Alert::success('ลบข้อมูลเรียบร้อย');
            return redirect()->back();
        }

        Alert::error('ไม่สามารถลบข้อมูลได้');
        return redirect()->back();
    }
}
