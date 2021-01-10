<?php

require_once '../controller.php';

if(isset($_POST['action_register'])){
    // Récupérer les données de formulaire de participation
    $data = Request::getData('POST');
    $email = $data['email'];
    $username = $data['name'];
    $password = $data['password'];
    $phone = $data['phone'];
    $university = $data['university'];
    $country = $data['country'];
    $hotel = $data['hotel'];
    $has_article =$data['has_article'];
    $gender = $data['gender'];
    $airport = $data['airport'];
    $date_depart = $data['date_depart'];
    $date_arrive = $data['date_arrive'];
    $avatar = $_FILES['avatar']['name'];
    $filename = "assets/img/avatars/".$avatar;

    if(! move_uploaded_file($_FILES['avatar']['tmp_name'], $main_folder . $filename))
        Router::redirect('register', 'q=ko');

    // Créer l'element XML
    $manager = new DatabaseManager(1, 'database/guests', 'user');
    $user = $manager->getData()->addChild('user');
    $user->addAttribute('id', DatabaseManager::increment('user'));
    $user->addAttribute('has_article', $has_article);
    $user->addAttribute('gender', $gender);
    $user->addAttribute('state', '0');
    $user->addChild('username', $username);
    $user->addChild('email', $email);
    $user->addChild('password', $password);
    $user->addChild('avatar', $filename);
    $user->addChild('phone', $phone);
    $user->addChild('hotel', $hotel);
    $user->addChild('airport', $airport);
    $user->addChild('university', $university);
    $user->addChild('country', $country);
    $user->addChild('date_depart', $date_depart);
    $user->addChild('date_arrive', $date_arrive);

    // Enregistrer le nouveau participant
    if($manager->save()) Router::redirect('login');
    Router::redirect('register', 'q=ko');
}
Router::redirect('register');