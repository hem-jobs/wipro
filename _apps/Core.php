<?php

//Write your custome class/methods here
namespace Apps;

class Core extends Model
{


	/** @return exit  */
	public function __construct()
	{
		parent::__construct();
	}
	public function CreateUser($email, $name, $ref_id, $password)
	{
		$sql = "INSERT INTO `user` (`email`,`name`, `ref_id`, `password`) VALUES ('$email', '$name', '$ref_id', '$password')";
		$created = mysqli_query($this->dbCon, $sql);
		if ($created) {
			$created = mysqli_insert_id($this->dbCon);
		}
		return $created;
	}
	public function UserLogin($email, $password)
	{
		$sql = "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'";
		$login = mysqli_query($this->dbCon, $sql);
		$login = mysqli_fetch_object($login);
		return $login->id;
	}
	public function GetUserInfo($id)
	{
		$sql = "SELECT * FROM `user` WHERE `id` = '$id'";
		$user = mysqli_query($this->dbCon, $sql);
		$User = mysqli_fetch_object($user);
		return $User;
	}

	public function SendMail($email,$name){
		$mj = new \Mailjet\Client('2e3b98f80ab0a9cfeab5799c9f5ae7fb','dfa98525a944080610383d6895aa4bd7',true,['version' => 'v3.1']);
        $body = [
          'Messages' => [
            [
              'From' => [
                'Email' => "info@wiproinvestment.com",
                'Name' => "Wipro Investment"
              ],
              'To' => [
                [
                  'Email' => "$email",
                  'Name' => "$name",
                ]
              ],
              'Subject' => "Greetings from Wipro Investment.",
              'TextPart' => "We are Happy to have you for today and ",
              'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
              'CustomID' => "AppGettingStartedTest"
            ]
          ]
        ];
        $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);

	}
}
