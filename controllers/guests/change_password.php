<?php

require_once '../controller.php';

if(isset($_POST['action_change_password'])){
    // changer le mot de pass
    $data = Request::getData('POST');
    $token = $data['token'];
    $email = $data['email'];
    $password1 = $data['password'];
    $password2 = $data['password2'];

    if($password1 == $password2){
        $manager = new DatabaseManager(1, 'database/guests', 'user');
        $user = $manager->find(['email' => $email]);
        $user->password = $password2;
        if($manager->save()){
            $manager2 = new DatabaseManager(2, 'database/guests', 'recover');
            $recover = $manager2->find(['email' => $email, 'token' => $token]);
            $recover->expires = '2001-01-01 00:00:00';
            $manager2->save();
        }
        Router::redirect('login');
    } Router::redirect('change_password', 'q=notsame');
}