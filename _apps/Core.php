<?php

//Write your custome class/methods here
namespace Apps;

use \Apps\EmailTemplate;

class Core extends Model
{


	/** @return exit  */
	public function __construct()
	{
		parent::__construct();
	}
	public function CreateUser($email, $name, $ref_id, $password, $hash, $username)
	{
		$sql = "INSERT INTO `user` (`email`,`name`, `ref_id`, `password`, `hash`, `username`) VALUES ('$email', '$name', '$ref_id', '$password', '$hash', '$username')";
		$created = mysqli_query($this->dbCon, $sql);
		if ($created) {
			$created = mysqli_insert_id($this->dbCon);
			return $created;
		}
		return $created;
	}
	public function CreateUser2($email, $name, $password, $hash, $username)
	{
		$sql = "INSERT INTO `user` (`email`,`name`, `password`, `hash`, `username`) VALUES ('$email', '$name', '$password', '$hash', '$username')";
		$created = mysqli_query($this->dbCon, $sql);
		if ($created) {
			$created = mysqli_insert_id($this->dbCon);
			return $created;
		}
		return $created;
	}
	public function ConvertIdUsername($username)
	{
		$sql = "SELECT * FROM `user` WHERE `username`= '$username'";
		$sql = mysqli_query($this->dbCon, $sql);
		$user = mysqli_fetch_object($sql);
		return $user->id;
	}
	public function UserLogin($email, $password)
	{
		$sql = "SELECT * FROM `user` WHERE `email`='$email' OR `username`='$email' AND `password`='$password'";
		$login = mysqli_query($this->dbCon, $sql);
		if (!$login->num_rows) {
			return false;
		}
		$login = mysqli_fetch_object($login);
		return $login;
	}
	public function GetUserInfo($id)
	{
		$sql = "SELECT * FROM `user` WHERE `id` = '$id'";
		$user = mysqli_query($this->dbCon, $sql);
		$User = mysqli_fetch_object($user);

		return $User;
	}
	public function GetInvInfo($id)
	{
		$sql = "SELECT * FROM `investments` WHERE `id` = '$id'";
		$user = mysqli_query($this->dbCon, $sql);
		$User = mysqli_fetch_object($user);

		return $User;
	}
	public function GetDepInfo($id)
	{
		$sql = "SELECT * FROM `deposits` WHERE `id` = '$id'";
		$user = mysqli_query($this->dbCon, $sql);
		$User = mysqli_fetch_object($user);

		return $User;
	}
	public function GetWithInfo($id)
	{
		$sql = "SELECT * FROM `withdrawals` WHERE `id` = '$id'";
		$user = mysqli_query($this->dbCon, $sql);
		$User = mysqli_fetch_object($user);

		return $User;
	}
	public function UpdateBalance($id, $amount)
	{
		$sql = "UPDATE `user` SET `balance` = '$amount' WHERE `id` = '$id'";
		return mysqli_query($this->dbCon, $sql);
	}

	public function AddTransaction($id, $amount, $type, $status)
	{
		$sql = "INSERT INTO `transactions` ( `amount`, `type`, `user`,`status`) VALUES ('$amount', '$type', '$id', '$status')";
		mysqli_query($this->dbCon, $sql);
		return mysqli_insert_id($this->dbCon);
	}
	public function	UpdateTransaction($id, $status)
	{
		$sql = "UPDATE `transactions` SET `status` = '$status' WHERE `id` = '$id'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function DeleteTransaction($id)
	{
		$sql = "DELETE FROM `transactions` WHERE `id` ='$id'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function DeleteInvestment($id)
	{
		$sql = "DELETE FROM `investments` WHERE `id` ='$id'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function DeleteWithdrawal($id)
	{
		$sql = "DELETE FROM `withdrawals` WHERE `id` ='$id'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function CheckFirstInv($id)
	{
		$sql = "SELECT * FROM `investments` WHERE `user` ='$id'";
		$sql = mysqli_query($this->dbCon, $sql);
		if ($sql->num_rows) {
			return false;
		} else {
			return true;
		}
	}
	public function CreateDeposit($id, $amount, $method, $trans_id, $hash)
	{
		$sql = "INSERT INTO `deposits`( `user_id`, `amount`, `coin`, `trans_id`, `hash`) VALUES ('$id','$amount','$method', '$trans_id', '$hash')";
		return mysqli_query($this->dbCon, $sql);
	}
	public function DeclineDeposit($id)
	{
		$sql = "DELETE FROM `deposits` WHERE `id` = '$id'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function CreateWithdrawal($id, $coin, $address, $amount, $status, $trans_id)
	{
		$sql = "INSERT INTO `withdrawals`(`user`, `coin`, `address`, `amount`, `status`, `trans_id`) VALUES ('$id','$coin','$address','$amount', '$status', '$trans_id')";
		return mysqli_query($this->dbCon, $sql);
	}
	public function GetUnapprovedWithdrawals()
	{
		$sql = "SELECT * FROM `withdrawals` WHERE `status` = 'pending'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function GetApprovedWithdrawals()
	{
		$sql = "SELECT * FROM `withdrawals` WHERE `status` = 'done'";
		return mysqli_query($this->dbCon, $sql);
	}

	public function ApproveWithdrawal($id, $status)
	{
		$sql = "SELECT * FROM `withdrawals` WHERE `id` = '$id'";
		$query = mysqli_query($this->dbCon, $sql);
		$with = mysqli_fetch_object($query);
		$this->UpdateTransaction($with->trans_id, $status);

		$sql2 = "UPDATE `withdrawals` SET `status` = '$status' WHERE `id` = '$id'";
		return mysqli_query($this->dbCon, $sql2);
	}
	public function ApproveDeposit($id, $status)
	{
		$sql = "SELECT * FROM `deposits` WHERE `id` = '$id'";
		$query = mysqli_query($this->dbCon, $sql);
		$dep = mysqli_fetch_object($query);
		$this->UpdateTransaction($dep->trans_id, $status);
		$user = $this->GetUserInfo($dep->user_id);
		$balance = $user->balance + $dep->amount;
		$this->UpdateBalance($dep->user_id, $balance);
		$sql2 = "UPDATE `deposits` SET `status` = '$status' WHERE `id` = '$id'";
		return mysqli_query($this->dbCon, $sql2);
	}
	public function GetUnapprovedDeposits()
	{
		$sql = "SELECT * FROM `deposits` WHERE `status` = 'pending'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function GetApprovedDeposits()
	{
		$sql = "SELECT * FROM `deposits` WHERE `status` = 'done'";
		return mysqli_query($this->dbCon, $sql);
	}
	public function CreateInvestment($id, $amount, $package, $roi, $days, $status, $trans_id)
	{
		$sql = "INSERT INTO `investments` (`user`, `amount`, `package`, `roi`, `days`, `status`, `trans_id`) VALUES	 ('$id', '$amount', '$package', '$roi', '$days', '$status', '$trans_id');";
		return mysqli_query($this->dbCon, $sql);
	}




	/**
	 * @param mixed $email
	 * @param mixed $fullname
	 * @param mixed $subject
	 * @param mixed $body
	 * @param string $type
	 * @return void
	 */
	public function sendMail($email, $fullname, $subject,$caption, $body, $template = 'mails.template')
	{
		$Mailer = new Emailer();
		$EmailTemplate = new EmailTemplate($template);
		$EmailTemplate->subject = $subject;
		$EmailTemplate->caption = $caption;
		$EmailTemplate->fullname = $fullname;
		$EmailTemplate->mailbody = $body;
		$Mailer->SetTemplate($EmailTemplate);
		$Mailer->toEmail = $email;
		$Mailer->toName = "{$fullname}";
		$Mailer->subject = "{$subject}";
		$Mailer->fromEmail = "info@wiproinvestment.com";
		$Mailer->fromName = "Wipro Support";
		return $Mailer->send();
	}
	// Email Sending Codes//


	// public function SendMail($email, $name, $subject, $mailbody)
	// {
	// 	$mj = new \Mailjet\Client('2e3b98f80ab0a9cfeab5799c9f5ae7fb', 'dfa98525a944080610383d6895aa4bd7', true, ['version' => 'v3.1']);
	// 	$body = [
	// 		'Messages' => [
	// 			[
	// 				'From' => [
	// 					'Email' => "info@wiproinvestment.com",
	// 					'Name' => "Wipro Investment"
	// 				],
	// 				'To' => [
	// 					[
	// 						'Email' => "$email",
	// 						'Name' => "$name",
	// 					]
	// 				],
	// 				'Subject' => "$subject",
	// 				'HTMLPart' => "$mailbody",
	// 				'CustomID' => "Wipro Investment"
	// 			]
	// 		]
	// 	];
	// 	$response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
	// }

}
