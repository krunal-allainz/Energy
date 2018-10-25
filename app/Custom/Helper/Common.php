<?php
namespace euro_hms\Custom\Helper;

use euro_hms\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class Common {

    static function toExcel($lableArray, $dataArray, $otherParams,$output = 'xlsx',$download='yes',$columnFormat=''){
        $excelCreateObj = \Excel::create(str_slug($otherParams['sheetTitle']), function($excel) use($lableArray, $dataArray, $otherParams,$columnFormat) {
            $excel->setTitle($otherParams['sheetTitle']);
            $excel->sheet($otherParams['sheetName'], function($sheet) use($lableArray, $dataArray, $otherParams,$columnFormat) {
                $sheet->row(1, $lableArray);
                $sheet->row(1, function($row){
                    $row->setBackground("#1f844c");
                    $row->setFontColor('#ffffff');
                    $row->setFontWeight('bold');
                    $row->setFontFamily('Arial');
                    $row->setFontSize(10);
                });
                 if($columnFormat!=''){
                $sheet->setColumnFormat($columnFormat); 
                 }
                $row_no = 2;
                foreach ($dataArray as $key=>$data) {
                     // echo "<pre>";print_r($data);echo "</pre>";exit;
                    $sheet->row($row_no, $data);
                    $row_no++;
                }
                
                if($otherParams['boldLastRow']){
                    $sheet->row(($row_no-1), function($row){
                        $row->setFontWeight('bold');
                    });
                }
            });
        });
         $excelCreateObj->export($output);   
       
    }

    static function sendMail($email_details, $email_recipients, $email_subject, $email_view, $email_from = null,$attachment=null)
       {        
           $contact_details = $email_details;        
           $recipient = $email_recipients;
           if ($email_from != null && !empty($email_from)) {
              Mail::to($recipient)->send(new SendMail($contact_details, $email_subject,  $email_view, $email_from,$attachment));
           }
           else{
               Mail::to($recipient)->send(new SendMail($contact_details, $email_subject,  $email_view,'',$attachment));
           }
           return response()->json([
               'status' => 'suceess',
               'message' => 'Thank you for your message. We will aim to get back to you within the next 24 hours.'
           ]);
       }

      static function getCurrentSiteUrl(){
          if(\App::environment('local')){
            return config('app.site_url');
          }else{
             return config('app.url');
          }
      }

    static function getImagefromUrl($url)
    {
       
        $msg = '';
        $status = 200;
        $data = array();

        $image = file_get_contents($url);
        $imageData = base64_encode($image);
        $header =  get_headers($url,1);
        $imagePath = 'data:'.$header['Content-Type'].';base64,'.$imageData;


        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $isImage = explode("/", $header['Content-Type']);

             if($isImage[0] == 'image'){
                /* It contains 'image/' as the content type */
                  $status = 200;
                  $msg = "Record Sucessfully created";
            }else{
               /* no match with 'image/' */
                $msg = "url is not a valid URL";
                $status = 201;
            }
        }

        $data = 
         [ 'imagePath' => $imagePath,
          'msg' => $msg,
          'status' =>  $status
        ];



        return  $data;
    }
}