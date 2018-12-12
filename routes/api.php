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


/*Route::get('password/reset/{token}', '\Energy\Api\Controllers\PasswordController@getReset');
Route::post('password/reset', '\Energy\Api\Controllers\PasswordController@postReset');*/

// Route::get('password/reset/{token}', '\Energy\Api\Controllers\PasswordController@getReset');
// Route::post('password/reset', '\Energy\Api\Controllers\PasswordController@postReset');

//Route::post('password/email', 'Energy\Api\Controllers\PasswordController@postEmail');
Route::get('/mlogin', '\Energy\Http\Controllers\Auth\ResetPasswordController@userMlogin');

//Route::post('password/reset', '\euro_hms\Http\Controllers\Auth\ForgotPasswordController@resetLink');
Route::post('password/reset/link', '\Energy\Api\Controllers\Auth\ForgotPasswordController@resetLink');



$api = app('Dingo\Api\Routing\Router');


$api->version('v1',['middleware' => 'jwt.auth'], function ($api) {

     // for localization
    $locale = \Request::header('locale');

    if($locale != '') {
        App::setLocale($locale);
    }


    // TODO: Move Method from web to api for Mobile App
        $api->post('user/getUserDetails', '\Energy\Api\Controllers\UserController@getUserDetails');
        $api->post('user/create', '\Energy\Api\Controllers\UserController@createUser')->name('create.users'); 

         $api->post('user/getDetails', '\Energy\Api\Controllers\UserController@getUserDetailsByID')->name('user.getUserDetails');

        /*getting user details by status and type*/
        $api->post('user/getUserDetailByUserType', '\Energy\Api\Controllers\UserController@getUserDetailsByType');

         //for getting username by id 
        $api->post('user/getUserNameById', '\Energy\Api\Controllers\UserController@getUserNameById');

         $api->post('user/getusernameforsignature', '\Energy\Api\Controllers\UserController@getUserNameByIdForSignature');


           $api->post('user/types','\Energy\Api\Controllers\UserController@getUserType');

         $api->post('user/getimagefromurl', '\Energy\Api\Controllers\CustomersController@getImagefromUrl');

        $api->post('user/user_exist','\Energy\Api\Controllers\UserController@checkExistUser');

          $api->post('user/delete','\Energy\Api\Controllers\UserController@deleteUserById');

          $api->post('user/getUserDetailByUserId','\Energy\Api\Controllers\UserController@getUserDetailByUserId');

        $api->post('user/edit','\Energy\Api\Controllers\UserController@editUserById');


        //for nomination
        
        $api->post('nomination/getNominationList', '\Energy\Api\Controllers\NominationController@getNominationList');

         //for nomination add
        $api->post('nomination/create', '\Energy\Api\Controllers\NominationController@createNomination');

        //for nomination details by id
        $api->post('nomination/getNominationDetailsById', '\Energy\Api\Controllers\NominationController@getNominationDetailsById');

         //for nomination edit
        $api->post('nomination/edit', '\Energy\Api\Controllers\NominationController@editNomination');

         //for nomination delete
        $api->post('nomination/delete', '\Energy\Api\Controllers\NominationController@deleteNomination');


        //get invoice list 1
        $api->post('invoice/getInvoiceList1', '\Energy\Api\Controllers\InvoiceController@getInvoiceList1');

        $api->post('dashboard/gettimelinedata', '\Energy\Api\Controllers\NotificationController@show');

        $api->post('schedule/updatesuppliedqty', '\Energy\Api\Controllers\ScheduleController@updateSupplierQty');


         //get invoice list 2
        $api->post('invoice/getInvoiceList2', '\Energy\Api\Controllers\InvoiceController@getInvoiceList2');

        //for getting nomination details by date
         $api->post('nomination/getNominationDetailsByDate', '\Energy\Api\Controllers\NominationController@getNominationDetailsByDate');

         //get invoice list 2
        $api->post('invoice/generateinvoice', '\Energy\Api\Controllers\InvoiceController@generateInvoice');

         //for adding availibility
         $api->post('availability/createAvailability', '\Energy\Api\Controllers\AvailabilityController@createAvailability');

         //for getting availability
          $api->post('availability/getAvailability', '\Energy\Api\Controllers\AvailabilityController@getAvailability');
         
        $api->post('user/getbuyerlist', '\Energy\Api\Controllers\NominationController@getBuyerList');


        $api->post('nomination/getbuyerrequestlist', '\Energy\Api\Controllers\NominationController@getBuyerRequestList');

        //for total requested
         $api->post('nomination/getTotalRequestedQuantityForSeller', '\Energy\Api\Controllers\NominationController@getTotalRequestedQuantityForSeller');

        //for total approved
        $api->post('nomination/getTotalApprovedQuantity', '\Energy\Api\Controllers\NominationController@getTotalApprovedQuantity');

        //for total supplied
         $api->post('nomination/getTotalSuppliedQuantity', '\Energy\Api\Controllers\NominationController@getTotalSuppliedQuantity');

          //for total request quantity of buyer
         $api->post('nomination/getTotalRequestedQuantity', '\Energy\Api\Controllers\NominationController@getTotalRequestedQuantity');

          //for total approved quantity of buyer

         $api->post('nomination/getTotalApprovedQuantityByBuyer', '\Energy\Api\Controllers\NominationController@getTotalApprovedQuantityByBuyer');

          $api->post('nomination/getNominationDetailsByDateById', '\Energy\Api\Controllers\NominationController@getNominationDetailsByDateById');

         $api->post('nomination/getTotalApprovedQuantityByBuyer', '\Energy\Api\Controllers\NominationController@getTotalApprovedQuantityByBuyer');

           //for total supplied at buyer dashbord
         $api->post('nomination/getTotalSuppliedQuantityByBuyer', '\Energy\Api\Controllers\NominationController@getTotalSuppliedQuantityByBuyer');

          //for total approved quantity of buyer
         $api->post('nomination/getNominationCountForBuyer', '\Energy\Api\Controllers\NominationController@getNominationCountForBuyer');

         //for MDCQ
          $api->post('agreement/getAllowedQuantityByBuyerId', '\Energy\Api\Controllers\AgreementController@getAllowedQuantityByBuyerId');

        $api->post('invoice/invoicelistbybuyerid', '\Energy\Api\Controllers\InvoiceController@getInvoiceLisyByBuyerId');

        $api->post('invoice/generateinvoicebybuyer','\Energy\Api\Controllers\InvoiceController@generateInvoiceLisyByBuyerId');

        $api->post('invoice/viewbybuyer', '\Energy\Api\Controllers\InvoiceController@viewbyBuyer');

         $api->post('invoice/invoiceView', '\Energy\Api\Controllers\InvoiceController@getInvoiceView');

          $api->post('availability/getCheckAvaibilityForQuantity', '\Energy\Api\Controllers\AvailabilityController@checkAvaibilityForQuantityForApprove');

          //Add GCV
        $api->post('gcv/addGcv', '\Energy\Api\Controllers\AvailabilityController@checkAvaibilityForQuantityForApprove');


}); 

        
        

