<?php

namespace Energy\Api\Controllers;

use Energy\Models\Notification;
use Illuminate\Http\Request;
use Energy\Api\Repositories\NotificationRepository;

class NotificationController extends Controller
{

    public function __construct(){
        $this->notificationOBJ = new NotificationRepository();
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
        $usertype = $request->userType;
        $userId = $request->userId;
        $result =  $this->notificationOBJ->getTimelineData($usertype,$userId);

        if($result) {
            return ['code' => '200','data'=>$result, 'message' => 'Timeline generate successfully'];
        } else {
             //return ['code' => '300','patientData'=>'', 'message' => 'Record not found'];
            return ['code' => '300','data'=>'', 'message' => 'Something went wrong'];
        }

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
}
