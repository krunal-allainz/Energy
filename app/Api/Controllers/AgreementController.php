<?php

namespace Energy\Api\Controllers;


use Illuminate\Routing\Controller;
use Energy\Models\AgreementRequest;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Agreement;
use euro_hms\Api\Repositories\AgreementRepository;


use DB;
use Carbon\Carbon;

class AgreementController extends Controller
{
    public function __construct(){
        $this->nomObj = new AgreementRepository();

      //  $this->notificationOBJ = new NotificationRepository();
    }
    

    
}
