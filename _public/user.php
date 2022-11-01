<?php

$Route->add('/crypto/register/{id}', function ($id) {

    $Template = new Apps\Template;
    $Template->assign("title", "Wipro Register");
    $Template->assign("ref_id", $id);
    $Template->render("pages.register");
}, 'GET');
$Route->add('/crypto/register', function () {

    $Template = new Apps\Template;
    $Template->assign("title", "Wipro Register");
    $Template->render("pages.register");
}, 'GET');




//Post

$Route->add('/crypto/user/create-account', function(){
$Template = new Apps\Template;
$Core = new Apps\Core;
$Data = $Core->data;
$email = $Data->email;
$name = $Data->name;
$ref_id = $Data->ref_id;
$password = $Data->password;

$created = $Core->CreateUser($email,$name,$ref_id,$password);
if($created){
    $Template->authorize($created);
    $Template->setError('Account created successfully', 'success', "/crypto/dashboard");
    $Template->redirect("/crypto/dashboard");
}
$Template->setError('Account creation failed', 'warning', "/crypto/register");
$Template->redirect("/crypto/register");

}, 'POST');



$Route->add('/crypto/user/login', function(){
$Template = new Apps\Template;
$Core = new Apps\Core;
$Data = $Core->data;
$email = $Data->email;
$password = $Data->password;

$login = $Core->UserLogin($email,$password);
if($login){
    $Template->authorize($login);
    $Template->setError('Login Successful', 'success', "/crypto/dashboard");
    $Template->redirect("/crypto/dashboard");
}
$Template->setError('Account created successfully', 'success', "/crypto/login");
$Template->redirect("/crypto/login");

}, 'POST');

