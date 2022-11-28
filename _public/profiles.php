<?php

$Route->add("/dashboard/user/profile", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Profile");
    $Template->render("dashboard.profile");
}, "GET");



$Route->add("/user/profile/photo", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $User = $Core->GetUserInfo($Template->storage('accid'));
    $name = md5($User->email . encrypt_salt);

    $handle = new \Verot\Upload\Upload($_FILES['photo']);
    // $Core->debug((int)$handle->uploaded);
    if ($handle->uploaded) {
        $ext = $handle->file_src_name_ext;
        $handle->file_new_name_body   = $name;
        $handle->image_resize         = true;
        $handle->file_overwrite = true;
        $handle->image_x              = 100;
        $handle->image_ratio_y        = true;
        $handle->process('_store/');
        if ($handle->processed) {
            $name .= "." . $ext;
            $handle->clean();
            $sql = "Update `user` SET `photo` = '$name' WHERE `id` = '$User->id'";
            mysqli_query($Core->dbCon, $sql);
            $Template->setError("Uploaded successfully", "success", "/dashboard/user/profile");
            $Template->redirect("/dashboard/user/profile");
        } else {
            $Template->setError("Error" . $handle->error, "warning", "/dashboard/user/profile");
            $Template->redirect("/dashboard/user/profile");
        }
    }
    $Template->setError("Error" . $handle->error, "warning", "/dashboard/user/profile");
    $Template->redirect("/dashboard/user/profile");
}, "POST");


$Route->add("/user/update_name", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $name = $Data->name;
    $email = $Data->email;
    $sql = "UPDATE `user` SET `name` = '$name' WHERE `email` = '$email'";
    $updated = mysqli_query($Core->dbCon, $sql);
    if ($updated) {
        $Template->setError("Name Updated successfully", "success", "/dashboard/user/profile");
        $Template->redirect("/dashboard/user/profile");
    }
    $Template->setError("Name Update failed", "warning", "/dashboard/user/profile");
    $Template->redirect("/dashboard/user/profile");
}, "POST");

$Route->add("/user/update_password", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $id = $Template->storage("accid");
    $password = md5($Data->password . encrypt_salt);
    $sql = "UPDATE `user` SET `password` = '$password' WHERE `id` = '$id'";
    $updated = mysqli_query($Core->dbCon, $sql);
    if ($updated) {
        $Template->setError("Password Updated successfully", "success", "/dashboard/user/profile");
        $Template->redirect("/dashboard/user/profile");
    }
    $Template->setError("Password Update failed", "warning", "/dashboard/user/profile");
    $Template->redirect("/dashboard/user/profile");
}, "POST");
