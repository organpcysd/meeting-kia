<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Car_stock;
use App\Models\Customer;
use App\Models\Traffic;
use App\Models\Traffic_source;
use App\Models\Quotation;
use App\Models\Reserved;
use App\Models\Received;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Car_stock::all();
        $customers = Customer::all();
        $traffic = Traffic::all();
        $quotations = Quotation::all();
        $reserved = Reserved::all();
        $received = Received::all();

        return view('admin.home',compact('stocks','customers','traffic','quotations','reserved','received'));
    }

    public function getData($btnvalue){
        if($btnvalue === 'btndaily'){
            $customers = Customer::whereDate('created_at', Carbon::today())->get()->count();
            $traffic = Traffic::whereDate('created_at', Carbon::today())->get()->count();
            $quotations = Quotation::whereDate('created_at', Carbon::today())->get()->count();
            $reserved = Reserved::whereDate('created_at', Carbon::today())->get()->count();
            $received = Received::whereDate('created_at', Carbon::today())->get()->count();
        }elseif($btnvalue === 'btnmonthly'){
            $customers = Customer::whereMonth('created_at', Carbon::now()->month)->get()->count();
            $traffic = Traffic::whereMonth('created_at', Carbon::now()->month)->get()->count();
            $quotations = Quotation::whereMonth('created_at', Carbon::now()->month)->get()->count();
            $reserved = Reserved::whereMonth('created_at', Carbon::now()->month)->get()->count();
            $received = Received::whereMonth('created_at', Carbon::now()->month)->get()->count();
        }elseif($btnvalue === 'btnyearly'){
            $customers = Customer::whereYear('created_at', Carbon::now()->year)->get()->count();
            $traffic = Traffic::whereYear('created_at', Carbon::now()->year)->get()->count();
            $quotations = Quotation::whereYear('created_at', Carbon::now()->year)->get()->count();
            $reserved = Reserved::whereYear('created_at', Carbon::now()->year)->get()->count();
            $received = Received::whereYear('created_at', Carbon::now()->year)->get()->count();
        }else{
            $customers = Customer::all()->count();
            $traffic = Traffic::all()->count();
            $quotations = Quotation::all()->count();
            $reserved = Reserved::all()->count();
            $received = Received::all()->count();
        }

        return response()->json(['customers' => $customers,'traffic' => $traffic, 'quotations' => $quotations, 'reserved' => $reserved, 'received' => $received]);
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
}
