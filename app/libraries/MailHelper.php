<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 8/13/14
 * Time: 9:58 PM
 */

class MailHelper {
    public static function Send($view,$data,$to_email,$subject,$cc=null)
    {
        Mail::send($view, $data, function($message) use ($to_email,$subject,$cc)
        {
            $message->to($to_email);
            $message->subject($subject);

            if($cc!=null && count($cc)>0)
            {
                foreach($cc as $to_cc)
                {
                    $message->cc($to_cc);
                }
            }
        });
    }
    public static function SendApply_MessageEmailForCompany($job_id,$view,$subject)
    {
        try
        {
            // get company email
            $company_id=Jobs::getCompanyByJobId($job_id);

            if($company_id!=null)
            {
                $email=Company::getEmail($company_id);
                // get data to make email content
                $recruiter_name=Company::getRecruiterName($company_id);

                $job_headline=JobInfos::getJobHeadline($job_id);

                $data=array('recruiter_name'=>$recruiter_name,'job_headline'=>$job_headline);

                // send email process
                self::Send($view,$data,$email,$subject.$job_headline);
            }
            else
            {
                throw new Exception('company not found');
            }
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
} 