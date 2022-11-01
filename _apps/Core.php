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
		$sql = "INSERT INTO `user` (email,name, ref_id, password) VALUES ('$email', '$name', '$ref_id', '$password')";
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
}
