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

        $daily_customers = Customer::whereDate('created_at', Carbon::today())->get();
        $daily_traffic = Traffic::whereDate('created_at', Carbon::today())->get();
        $daily_quotations = Quotation::whereDate('created_at', Carbon::today())->get();
        $daily_reserved = Reserved::whereDate('created_at', Carbon::today())->get();
        $daily_received = Received::whereDate('created_at', Carbon::today())->get();

        return view('admin.home',compact('stocks','customers','traffic','quotations','reserved','received','daily_customers','daily_traffic','daily_quotations','daily_reserved','daily_received'));
    }

    public function getData(){
        $traffic = Traffic::all();
        $traffic_source = Traffic_source::all();
        return response()->json(['traffic' => $traffic,'traffic_source' => $traffic_source]);
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
