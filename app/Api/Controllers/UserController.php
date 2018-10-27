<?php

namespace euro_hms\Api\Controllers;

use Brotzka\DotenvEditor\DotenvEditor;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

// Need to Define Only Contracts
// use euro_hms\Api\Contracts\UserContract;
use JWTAuth;
use euro_hms\Models\User;
use euro_hms\Models\UserTypes;
use euro_hms\Models\Role;
use euro_hms\Api\Repositories\UserRepository;
use euro_hms\Api\Repositories\UserTypesRepository;
use euro_hms\Custom\Helper\Common;
use Hash;
/**
 * Users Resource Description.
 *
 * @Resource("users")
 *
 * @Author mtilokani@aecordigital.com
 */
class UserController extends BaseController
{
    public function __construct()
    {
        $this->userRepoObj = new UserRepository();
        // $this->middleware('auth');
        // $this->middleware('jwt.auth');
    }



    /**
     * Create New User Result.
     *
     * @Post("/user/create")
     *
     * @Versions({"v1"})
     * @Request("name=test", contentType="application/x-www-form-urlencoded")
     */
    public function createUser(Request $request)
    {
        // Data Initilization
        $data = $request->all()['userData'];
        // dd($data);
        $roleId = Role::where('slug', 'doctor')->first()->id;

        \Log::info('User Create Method Called');
        $userData=array();
        $userData['user']=array();
        $userPassword = NULL;
        $token = str_random(30);
        //$data['is_mobile_user'] = 0;
        // Validation checks for Email Validation



        // // Also check From Desktop
        // $userData['user']['is_mobile_user'] = false;
        // if(isset($data['registerType']) && trim($data['registerType']) == 'mobile') {
        //   $userData['user']['is_mobile_user'] = true;
        //   $data['userType'] = '5';
        //   $data['organisation'] = 'EuroSportring';
          $userPassword = Hash::make(trim($data['password']));
        // }
        // here we check that if userType is


        $userData['user']['first_name']=$data['fName'];
        $userData['user']['email']=$data['email'];
        $userData['user']['address']=$data['address'];
        $userData['user']['mobile_no']=$data['mobileNo'];
        $userData['user']['user_type']=$data['userType'];
        $userData['user']['status']='Active';
        // We cant Allow untikl its set password
        $userData['user']['password']=$userPassword;
        $userData['user']['token'] = $token;
        \Log::info($userData);
        \Log::info('Insert in UserTable');
        $existData = $this->userRepoObj->chkUserExist($data);
        $cntExistData = $existData->count();
        if($cntExistData > 0) {
            return ['status_code' => '301', 'message' => 'User Already exist.'];

        }
          
        $userRes=$this->userRepoObj->create($userData['user']);
       \Log::info('deleted user');
        if($userRes['status'] == false )
          {
            return ['status_code' => '200', 'message' => 'User is not activated.'];
          }
        $userObj = $userRes['user'];
        // $userObj->roles()->sync($data['userType'])
        // $userObj->attachRole($data['userType']);
        // Here we add code for Mobile Users to relate tournament to users
        $user_id = $userObj->id;


        if ($data) {
            \Log::info('Sent email');
            $email_details = array();
            $email_details['first_name'] = $data['fName'];
            $email_details['token'] = $token;
            $email_details['is_mobile_user'] = 0;
            $recipient = $data['email'];

                $email_templates = 'emails.Welcome';
                $email_msg = 'Welcome to VINS Patient Management';


           //  if($userObj->is_mobile_user == 1) {
           // //   $email_templates = 'emails.users.mobile_create';
           //    $email_msg = 'Euro-Sportring email verification';
           //    $email_details['is_mobile_user'] = 1;
           //  }
            // Common::sendMail($email_details, $recipient, $email_msg, $email_templates);
            return ['status_code' => '200', 'message' => 'Please check your inbox to verify your email address and complete your account registration.'];
        }

        // return $this->userObj->create($request);
    }

    /**
     * Edit User
     *
     * @GET("/user/edit/{$id}")
     *
     */
    public function edit(Request $request, $userId)
    {
        return $this->userObj->edit($userId);
    }

    public function getUserDetailsByID(Request $request)
    {
      
        return $this->userRepoObj->getUserDetailsByID($request->all()['userId']);
    }


    public function getUserDetails(Request $request)
    {
        $noOfPage = $request->noOfPage;
        $userDetails =  $this->userRepoObj->getUserDetails($noOfPage);

        if ($userDetails) {
            return ['code' => '200','data'=>$userDetails, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }
    /**
     * [getDepartmentByName description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getDepartmentByName(Request $request)
    {
        return $this->userRepoObj->getDepartmentByName($request->all()['name']);
    }

    /**
     * [getUserDetailsByType description]
     * @param  Request $request [type,status]
     * @return [array]           [description]
     */
    public function getUserDetailsByType(Request $request)
    {
        $type = $request->type;
        $status   =  $request->status;
        $userDetails=$this->userRepoObj->get_user_details_by_type($type,$status);
        if ($userDetails) {
            return ['code' => '200','data'=>$userDetails, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
        //return 
    }

    /**
     * [getCrossRefferalUser description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCrossRefferalUser(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $user_list=$this->userRepoObj->get_cross_refferal_user($doctor_id);
        if ($user_list) {
            return ['code' => '200','data'=>$user_list, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [getDepartmentById description]
     * @param  Request $request [id]
     * @return [array]           [description]
     */
     public function getDepartmentById(Request $request)
    {
        return $this->userRepoObj->getDepartmentById($request->all()['id']);
    }

    /**
     * [getUserNameById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getUserNameById(Request $request)
    {
        return $this->userRepoObj->getUserNameById($request->all()['id']);
    }

    /**
     * get user name for signature
     * 
     * 
     */
    public function getUserNameByIdForSignature(Request $request)
    {
        return $this->userRepoObj->getUserNameByIdForSignature($request->all()['id']);
    }

     /**
     * [getUserDetailById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getUserDetaileById(Request $request)
    {
        $id = $request->id;
        return $this->userRepoObj->getUserDetaileById($id);
    }

    public function getUserDetailByUserId(Request $request){
        $userId = $request->userId;
        $userData = $this->userRepoObj->getUserDetailByUserId($userId);
         
        if ($userData) {
            return ['code' => '200','data'=>$userData, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }
    /**
    *
    *
    * @return list of user types
    *
    */
    
    public function getUserType(){
         $this->userTypeRepoObj = new UserTypesRepository();
         $userTypesList = $this->userTypeRepoObj->getUserType();
         if ($userTypesList) {
            return ['code' => '200','data'=>$userTypesList, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
    *
    *  check user existing status
    *
    */   

    public function checkExistUser (Request $request){
        $type = $request->type;
        $value = $request->value;

       $result = $this->userRepoObj->checkExistUser($type,$value);
      
       return  $result;
    }

    /**
    *
    *
    *
    *
    **/

    public function getDoctoreInfoById(Request $request){
        $id = $request->id;
        $type = $request->typeId;

         $result = $this->userRepoObj->getDoctoreInfoById($id,$type);

         if ($result) {
            return ['code' => '200','data'=>$result, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }

    }

    /**
    *
    *
    *
    **/

    public function deleteUserById(Request $request){
        $userId = $request->userId; 

        $result = $this->userRepoObj->deleteUserById($userId);
         if ($result) {
            return ['code' => '200','data'=>$result, 'message' => 'Record Sucessfully deleted'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
    *
    *
    **/

    public function editUserById(Request $request){
        $userData = $request->userData;
        $userId = $request->userId;
         $result = $this->userRepoObj->editUserById($userData,$userId);
         if ($result) {
            return ['code' => '200','data'=>$result, 'message' => 'Record Sucessfully updated'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }

    }

    
}
