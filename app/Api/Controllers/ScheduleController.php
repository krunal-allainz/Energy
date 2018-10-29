<?php

namespace Energy\Api\Controllers;

use Energy\Models\ScheduleRequest;
use Energy\Api\Repositories\ScheduleRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function __construct(){
        $this->scheduleOBJ = new ScheduleRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * 
     */
    public function show(Request $request)
    {
        //
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Energy\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Energy\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Energy\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
        //
    }


    /**
    *
    **/
    public function updateSupplierQty(){
        $result = $this->scheduleOBJ->updateSupplierQty();
        if(count($result)>0)
        {
            return ['code' => 200 ,'data'=>$result,'message'=>'update Supplier Quntity successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
}
