<?php

namespace euro_hms\Models;

 use Illuminate\Database\Eloquent\Model;	
 use euro_hms\Mail\SendMail;	
 use Illuminate\Support\Facades\Mail;	
 	
 class MailNotification extends Model	
 {	
    //	
	
    /**	
		This fucntiona use for check whick template will use for send mail	
    */	
	
	
    static function mailSendDetail($type,$emailData){	
    			
    	if($type == 'password_reset_link'){	
    	   $content = MailNotification::useTemplate(1);	
    	   MailNotification::sendMail($emailData,$content);	
    	}	
	
    }	
	
	
    static function sendMail($emailData,$content){ 	
    	    $content = $content->content;	
    	   	
    	    foreach ($emailData as $key=>$value){	
    	    	//echo $key.'=='.$value;	
	
				str_replace('{{'.$key.'}}',$value, $content); 	
    	    }	
    	    	
    	    return $content;	
    	    if($emailData['WITH-ATTECHMENT'] == 'no'){	
		    		return Mail::to($emailData['EMAIL'])->send($emailData, $emailData['SUBJECT'],$content,'mital.sharma@netfonia.us','');	
		    }else{	
		    	$attachment = '';	
		    	return Mail::to($emailData['EMAIL'])->send($emailData, $emailData['SUBJECT'],$content,'mital.sharma@netfonia.us',$attachments);	
		    }	
    }	
	
    static function useTemplate($id){	
    		
    	return \DB::table('email_managment')->where('id',$id)->where('status',1)->first();	
    }	

}
