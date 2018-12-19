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
        if($result['code']==200)
        {
            return ['code' => 200 ,'data'=>$result['result'],'message'=>'Update Supplier Quntity successfully.'];
        }
        else if($result['code']==301)
        {
             return ['code' => 301 ,'data'=>$result['result'],'message'=>'Supplied quantity already updated.'];
        }
        else if($result['code']==302)
        {
             return ['code' => 302 ,'data'=>$result['result'],'message'=>'Approved quantity not added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'No record found.'];
        }
    }
}
