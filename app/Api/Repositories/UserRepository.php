<?php

namespace Energy\Api\Repositories;

use Energy\Models\User;
use Energy\Models\Role;
use DB;
use Hash;

class UserRepository {


    public function __construct()
    {
      $this->userImagePath = getenv('S3_URL').'/assets/img/users/';
    }
    public function getAllUsers()
    {
        return User::all();
    }
    public function createUserFavourites($userFavouriteData)
    {
      return UserFavourites::create($userFavouriteData);
    }
    public function getUserDetailsByID($userID) {
        return User::find($userID);
    }
    public function chkUserExist($searchData) {
        return User::where('mobile_no',$searchData['mobileNo'])->orWhere('email',$searchData['email'])->get();
    }

    public function getDepartmentByName($name) {
        return User::select('department')->where('first_name', $name)->first();
    }

    public function getUserDetails($noOfPage)
    {

        $data = User::paginate($noOfPage);
        return $data;
    }

    public function create($data)
    {
        // dd($data);
        $userData = [
        'first_name' => $data['first_name'],
        'user_type'=>$data['user_type'],
        'email' => $data['email'],
        'address' => $data['address'],
        'password' => $data['password'],
        'mobile_no'=>$data['mobile_no'],
        'token' => $data['token'],
        'status'=>'Active',
        'is_verified' => 1,
        'is_active' =>  1,
        //'user_image'=>(isset($data['user_image']) && $data['user_image']!='') ?  $data['user_image'] : ''
        ];

        $user = User::create($userData);
        $user->attachRole($data['user_type']);
        return ['status'=>'created','user'=>$user];
        
    }
        

    
    public function delete($id)
    {
        return User::find($id)->delete();
    }

    public function update($data, $userId)
    {
        return User::where('id', $userId)->update($data);
    }

    public function getUserById($userId)
    {
        return User::with(["personDetail", "roles"])->findOrFail($userId);
    }

    public function createPassword($usersDetail)
    {
        $mobileUserRoleId = Role::where('slug', 'mobile.user')->first()->id;
        $key = $usersDetail['key'];
        $password = (isset($usersDetail['password']) && $usersDetail['password']!='') ? $usersDetail['password'] : '';
        $usersPassword = User::where('token', $key)->first();
        // echo "<pre>";print_r($usersPassword);echo "</pre>";exit;
        $users = User::where("id", $usersPassword->id)->first();
        $users->is_verified = 1;
        $users->is_active = 1;
        $users->token = '';
        if($password != '')
          $users->password = Hash::make($password);
        // $users->password = $password;
        $user =  $users->save();
        return ($users->roles[0]->id == $mobileUserRoleId) ? 'Mobile' : 'Desktop';

    }

    public function changeTournamentPermission($data) {
      $user = User::find($data['user']['id']);
      $user->tournaments()->sync([]);
      $user->tournaments()->attach($data['tournaments']);
      return true;
    } 

    public function getUserTournaments($id) {
      $user = User::find($id);
      return $user->tournaments()->pluck('id');
    }

    /**
     * [getUserDetailsByType description]
     * @param  [type] $type   [description]
     * @param  [type] $status [description]
     * @return [array]         [description]
     */
    public function get_user_details_by_type($type,$status)
    {
        if($type=='All')
        {
            return User::where('status',$status)->get();
        }
        else
        {
            return User::where('user_type',$type)->where('status',$status)->get(); 
        }
        
    }

    /**
     * [get_cross_refferal_user description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
     public function get_cross_refferal_user($id)
    {
        return User::where('id','!=',$id)->get();
        
    }

    /**
     * [getDepartmentById description]
     * @param  [type] $id [description]
     * @return [department]     [description]
     */
    public function getDepartmentById($id) {
        $dept=User::select('department')->where('id', $id)->first();
        return $dept->department;
    }

    /**
     * [getUserNameById description]
     * @param  [type] $id [description]
     * @return [name]     [description]
     */
    public function getUserNameById($id) {
        $record=User::where('id', $id)->first();
        return strtolower($record->first_name.' '.$record->last_name);
    }

    /**
     * 
     * 
     * 
     */
    public function getUserNameByIdForSignature($id) {
        $record=User::select('signature_path as signature')->where('id', $id)->first();
        return json_encode($record->signature);
    }

    /**
     * [getUserDetailById description]
     * @param  [type] $id [description]
     * @return [name]     [description]
     */
    public function getUserDetaileById($id) {
        $record=User::where('id', $id)->first();
        return $record;
    }

    public function getUserDetailByUserId($userId){
       $record=User::where('id', $userId)->first();
        return $record;

    }

    public function checkExistUser($type,$value){
      return  User::where($type,$value)->count();
    }

    public function getDoctoreInfoById($id,$type){
        $result = array();
        $record=User::where('id', $id)->where('user_type',$type)->first();
        $result['name'] = $record->first_name.' '.$record->last_name  ;
        $result['dagree'] = $record->dagree;
        $result['department'] = $record->department;
        $result['regNo'] = $record->RegNo;
        return $result;
    }

    public function deleteUserById($id){
        $result = User::where('id',$id)->first();

        if($result != null){
          $result->delete();
        }
      return $result;
    }

    public function editUserById($userData,$userId){
       $newPwd = '';
       $dept = Null;
       $dagree = null;
       $regNo = null;
       $signature_path = null;

       $fname = $userData['fName'];
       $lname = $userData['lName'];
       $mno = $userData['mobileNo'];  
       $address =  $userData['address'];
       $userType =  $userData['userType'];


       if($userType == 1){
         $dept =  $userData['department'];
         $dagree =   $userData['dagree'];
         $regNo =   $userData['regNo'];
         $signature_path =  $userData['signaturefile'];
       }

       if($userData['password'] != ''){
          $password = Hash::make($userData['password']);
            $result = User::where('id',$userId)->update(array('first_name' => $fname, 'last_name' => $lname , 'mobile_no' => $mno , 'address' => $address ,'user_type' => $userType,'password' => $password, 'department' => $dept,'dagree' =>  $dagree,'RegNo' => $regNo , 'signature_path' => $signature_path));
       }
        else{

          $result = User::where('id',$userId)->update(array('first_name' => $fname, 'last_name' => $lname , 'mobile_no' => $mno , 'address' => $address ,'user_type' => $userType, 'department' => $dept,'dagree' =>  $dagree,'RegNo' => $regNo , 'signature_path' => $signature_path));
       }

      
      return $result ;

    }

    /**
     * [getUserNameInfoById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
     public function getUserNameInfoById($id) {
        $record=User::where('id', $id)->first();
        return ucwords($record->first_name);
    }

}
