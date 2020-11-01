<?php

require_once '../controller.php';

/**
 * Participation d'un nouveau condidat
 */

// verifier si le formulaire est soumis
if(isset($_POST['action_login'])){

    // récupérer les information de formulaire login
    $data = Request::getData('POST');
    $email = $data['email'];
    $password = $data['password'];
    $manager = new DatabaseManager(1, 'database/admins', 'auth');
    $user = $manager->find([
        'email' => $email,
        'password' => $password
    ]);

    if ($user != null){
        $_SESSION[APP_ADMIN_ID] = (int) ((array) $user->attributes()->id)[0];
        Router::redirect('admin/index');
    }
    else Router::redirect('admin/login', 'q=ko');

}