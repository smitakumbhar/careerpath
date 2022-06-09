<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

require("sendpulse/src/ApiInterface.php");
require("sendpulse/src/ApiClient.php");
require("sendpulse/src/Storage/TokenStorageInterface.php");
require("sendpulse/src/Storage/FileStorage.php");
require("sendpulse/src/Storage/SessionStorage.php");
require("sendpulse/src/Storage/MemcachedStorage.php");
require("sendpulse/src/Storage/MemcacheStorage.php");

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

// API credentials from https://login.sendpulse.com/settings/#api
define('API_USER_ID', 'c20cd956276c2bcbe1fef93957938d57');  //c20cd956276c2bcbe1fef93957938d57
define('API_SECRET', '24b6f838fbc700533411466729604dd2');// 24b6f838fbc700533411466729604dd2
//define('PATH_TO_ATTACH_FILE', __FILE__);


/**
 * 
 */
class CI_Send_pulse 
{
	
	// send mail to contact person as resumes zip in attachment
	// send mail as joborderbook pdf in attachmanet
	public function sendEmail($email, $body,$subject,$filepath,$attachment_name)
	{
		
		$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
		/*
		 * Example: Send mail using SMTP
		 */
		$email_data = array(
		    'html' => '<p>'.$body.'</p>',
		    'text' => $body,
		    'subject' => $subject,
		    'from' => array(
		        'name' => 'Career Path',
		        'email' => 'noreply@alphaonlinefood.com',
		    ),
		    'to' => array(
		        array(
		            'name' => 'Subscriber Name',
		            'email' => $email,
		        ),
		    ),
		'attachments' => array(
        $attachment_name => file_get_contents($filepath),
    ),

		    
		);
		return $SPApiClient->smtpSendMail($email_data);
	}



	// mail for candidate without attachment
	public function sendEmail_candidate($email, $body,$subject)
	{
		$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
		/*
		 * Example: Send mail using SMTP
		 */
		$email_data = array(
		    'html' => '<p>'.$body.'</p>',
		    'text' => $body,
		    'subject' => $subject,
		    'from' => array(
		        'name' => 'Career Path',
		        'email' => 'noreply@alphaonlinefood.com',
		    ),
		    'to' => array(
		        array(
		            'name' => 'Subscriber Name',
		            'email' => $email,
		        ),
		    ),
    );
		return $SPApiClient->smtpSendMail($email_data);
	}

	public function sendEmail_forgot($email, $body)
	{
		$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
		/*
		 * Example: Send mail using SMTP
		 */
		$email_data = array(
		    'html' => '<p>'.$body.'</p>',
		    'text' => $body,
		    'subject' => 'OTP for Forgot Password : Easy Assetz',
		    'from' => array(
		        'name' => 'Easy Assetz',
		        'email' => 'noreply@alphaonlinefood.com',
		    ),
		    'to' => array(
		        array(
		            'name' => 'Subscriber Name',
		            'email' => $email,
		        ),
		    ),
		    
		);
		return $SPApiClient->smtpSendMail($email_data);
	}
}

?>