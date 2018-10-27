<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'auth'], function () {
    Route::post('login','AuthController@authenticate');
    Route::get('logout','AuthController@logout');
    Route::get('check','AuthController@check');
});


/*Route::get('password/reset/{token}', '\euro_hms\Api\Controllers\PasswordController@getReset');
Route::post('password/reset', '\euro_hms\Api\Controllers\PasswordController@postReset');*/

// Route::get('password/reset/{token}', '\euro_hms\Api\Controllers\PasswordController@getReset');
// Route::post('password/reset', '\euro_hms\Api\Controllers\PasswordController@postReset');

//Route::post('password/email', 'euro_hms\Api\Controllers\PasswordController@postEmail');
Route::get('/mlogin', '\euro_hms\Http\Controllers\Auth\ResetPasswordController@userMlogin');

//Route::post('password/reset', '\euro_hms\Http\Controllers\Auth\ForgotPasswordController@resetLink');
Route::post('password/reset/link', '\euro_hms\Api\Controllers\Auth\ForgotPasswordController@resetLink');



$api = app('Dingo\Api\Routing\Router');


$api->version('v1',['middleware' => 'jwt.auth'], function ($api) {

     // for localization
    $locale = \Request::header('locale');

    if($locale != '') {
        App::setLocale($locale);
    }


    // TODO: Move Method from web to api for Mobile App
        $api->post('user/getUserDetails', '\euro_hms\Api\Controllers\UserController@getUserDetails');
        $api->post('user/create', '\euro_hms\Api\Controllers\UserController@createUser')->name('create.users'); 

         $api->post('user/getDetails', '\euro_hms\Api\Controllers\UserController@getUserDetailsByID')->name('user.getUserDetails');

        /*getting user details by status and type*/
        $api->post('user/getUserDetailByUserType', '\euro_hms\Api\Controllers\UserController@getUserDetailsByType');

         //for getting username by id 
        $api->post('user/getUserNameById', '\euro_hms\Api\Controllers\UserController@getUserNameById');

         $api->post('user/getusernameforsignature', '\euro_hms\Api\Controllers\UserController@getUserNameByIdForSignature');


           $api->post('user/types','\euro_hms\Api\Controllers\UserController@getUserType');

         $api->post('user/getimagefromurl', '\euro_hms\Api\Controllers\CustomersController@getImagefromUrl');

        $api->post('user/user_exist','\euro_hms\Api\Controllers\UserController@checkExistUser');

          $api->post('user/delete','\euro_hms\Api\Controllers\UserController@deleteUserById');

          $api->post('user/getUserDetailByUserId','\euro_hms\Api\Controllers\UserController@getUserDetailByUserId');

        $api->post('user/edit','\euro_hms\Api\Controllers\UserController@editUserById');


        //for nomination
        
        $api->post('nomination/getNominationList', '\euro_hms\Api\Controllers\NominationController@getNominationList');

         //for nomination add
        $api->post('nomination/create', '\euro_hms\Api\Controllers\NominationController@createNomination');

        //for nomination details by id
        $api->post('nomination/getNominationDetailsById', '\euro_hms\Api\Controllers\NominationController@getNominationDetailsById');

         //for nomination edit
        $api->post('nomination/edit', '\euro_hms\Api\Controllers\NominationController@editNomination');

         //for nomination delete
        $api->post('nomination/delete', '\euro_hms\Api\Controllers\NominationController@deleteNomination');


        //get invoice list 1
        $api->post('invoice/getInvoiceList1', '\euro_hms\Api\Controllers\InvoiceController@getInvoiceList1');

        $api->post('dashboard/gettimelinedata', '\euro_hms\Api\Controllers\NotificationController@show');

        $api->post('schedule/updatesuppliedqty', '\euro_hms\Api\Controllers\ScheduleController@updateSupplierQty');


         //get invoice list 2
        $api->post('invoice/getInvoiceList2', '\euro_hms\Api\Controllers\InvoiceController@getInvoiceList2');

        //for getting nomination details by date
         $api->post('nomination/getNominationDetailsByDate', '\euro_hms\Api\Controllers\NominationController@getNominationDetailsByDate');

         //get invoice list 2
        $api->post('invoice/generateinvoice', '\euro_hms\Api\Controllers\InvoiceController@generateInvoice');

         //for adding availibility
         $api->post('availability/createAvailability', '\euro_hms\Api\Controllers\AvialabilityController@createAvailability');

         //for getting availability
          $api->post('availability/getAvailability', '\euro_hms\Api\Controllers\AvialabilityController@getAvailability');
         
        $api->post('user/getbuyerlist', '\euro_hms\Api\Controllers\UserController@getBuyerList');

<<<<<<< HEAD
        $api->post('user/getbuyerrequestlist', '\euro_hms\Api\Controllers\NominationController@getBuyerRequestList');
=======
        //for total approved
        $api->post('nomination/getTotalApprovedQuantity', '\euro_hms\Api\Controllers\NominationController@getTotalApprovedQuantity');

        //for total supplied
         $api->post('nomination/getTotalSuppliedQuantity', '\euro_hms\Api\Controllers\NominationController@getTotalSuppliedQuantity');

          //for total request quantity of buyer
         $api->post('nomination/getTotalRequestedQuantity', '\euro_hms\Api\Controllers\NominationController@getTotalRequestedQuantity');

          //for total approved quantity of buyer
         $api->post('nomination/getTotalApprovedQuantityByBuyer', '\euro_hms\Api\Controllers\NominationController@getTotalApprovedQuantityByBuyer');


>>>>>>> 8ca120f783c590c8a763ba2e6961b9369d2609f1

}); 

        
        

