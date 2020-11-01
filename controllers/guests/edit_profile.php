<?php

require_once '../controller.php';

if(isset($_POST['action_edit_profile'])){
    $manager = new DatabaseManager(1, 'database/guests', 'user');
    $user = $manager->findById($_SESSION[APP_ID]);

    if($user){
        $new = Request::getData('POST');
        $user->username = $new['username'];
        $user->phone = $new['phone'];
        $user->hotel = $new['hotel'];
        $user->university = $new['university'];
        $user->country = $new['country'];
        $user->airport = $new['airport'];
        $user->date_depart = $new['date_depart'];
        $user->date_arrive = $new['date_arrive'];
        if($manager->save()){
            $message = "L'utilisateur ".$user->username . " à changé les informations de son profil.";
            Helpers::notifyAdmin($message, (new DateTime())->format("Y-m-d H:i:s"));
            Router::redirect('profile', 'q=ok');
        }
        else Router::redirect('profile', 'q=ko');
    } Router::redirect('profile', 'q=ko');
}
Router::redirect('index');