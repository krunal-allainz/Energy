<?php

namespace euro_hms\Api\Controllers\Auth;

use Illuminate\Http\Request;
use euro_hms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use euro_hms\Models\User;
use euro_hms\Models\MailNotification;
use euro_hms\Custom\Helper\Common;
use DB;
use Mail;
use App\Mail\EmailVerification;
use Carbon\Carbon;




class ForgotPasswordController extends Controller
{
    //
     use SendsPasswordResetEmails;

      // protected $resetView="auth.passwords.reset";
    /**
     * Get the e-mail subject line to be used for the reset link email.
     */
    protected $subject="Password Reset Link";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // dd($this->broker());
        // $this->middleware('guest');
    }

     public function resetLink(Request $request )
    {   
      
    	$this->validate($request, ['email' => 'required|email']);
    	/*$valodator = Validator::make($request->all(), 
			array(
		           'email' => 'required|email'
				)
			);*/
    	  $token=JWTAuth::getToken();

            // $this->resetEmailBuilder()

    	  /*if( ! $validator->fails() )
		    {*/
                $reseEmail =  $request->input('email');
                
		        if( $user = User::where('email',$reseEmail)->first() )
		        {
		            $token = str_random(64);
                    
                    $password_reset = \DB::table('password_resets')->where('email',  $user->email)->first();
                    
                    if(empty($password_reset)){ 
    		             DB::table(config('auth.passwords.users.table'))->insert([
    		                 'email' => $user->email, 
    		                 'token' => $token,
    		                 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              				 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		           ]);

                    }else{  
                          DB::table(config('auth.passwords.users.table'))->where('email',$user->email)->
                              update([
                                'token'=>$token,
                                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                            ]);
                    }
                     $url = '';
                $url = common::getCurrentSiteUrl();
                $resetLink = '';
                $resetLink  = $url.'/password/reset/'.$token.'?email='. $user->email;
                $type = 'password_reset_link';
               $emailData  = [ 
                   'NAME'  => $user->first_name.' '.$user->last_name, 
                    'EMAIL' => $user->email,   
                    'LINK'  => $resetLink, 
                    'SUBJECT' => 'Reset Password Link',    
                    'WITH-ATTECHMENT'  => 'no' 
                ];
              //   MailNotification::mailSendDetail($type,$emailData);


                 

           //  if($userObj->is_mobile_user == 1) {
           // //   $email_templates = 'emails.users.mobile_create';
           //    $email_msg = 'Euro-Sportring email verification';
           //    $email_details['is_mobile_user'] = 1;
           //  }
            // Common::sendMail($email_details, $recipient, $email_msg, $email_templates);
               $data = [
                    'status' => 200 ,
                    'token' => $token , 
                    'email' =>  $user->email ,
                    'link' => $resetLink,
                    'msg'   => 'Reset password link send to your mail id'
                  ];



                //Common::sendMail($email_details, $recipient, $email_msg, $email_templates);
                
              }else{
                $data = ['status' =>404 ,  'email' =>  $request->input('email')];
              }
               return $data;


                /*Mail::send('emails.welcome', [], function($message) use ($emails)
{    
    $message->to($emails)->subject('This is test e-mail');    
});
var_dump( Mail:: failures());*/
                    /*$response = Password::sendResetLink($request->only('email'), function (Message $message) {
              }
            $message->subject(trans('password reset link'));
        });*/
		         /*   Mail::send([
		                'to'      => $user->email,
		                'subject' => 'Your Password Reset Link',
		                'view'    => 'auth.passwords.reset',
		                'view_data' => [
		                    'token' => $token, 
		                    'user'  => $user,
                        'link'  => 'password/reset'+ $token
		                ]
		            ]);*/
		      
      

     /*   switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));
            case Password::INVALID_USER:
                return redirect()->back()->with('error', trans($response));
        }*/
	
    /*return redirect()->back()->withErrors(['email' => trans(Password::INVALID_USER)]);
    	   switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->response->noContent();
            case Password::INVALID_USER:
                return $this->response->errorNotFound();
        }*/
        
    	 
    }
}
