<?php

require_once '../controller.php';

if(isset($_POST['action_recover'])){
    // récupérer le mot de passe par email

    $data = Request::getData('POST');
    $email = $data['email'];

    $manager = new DatabaseManager(1, 'database/guests', 'user');
    $user = $manager->find(['email' => $email]);

    if($user){
        // envoyer le nouveau mot de passe par email
        $token = Helpers::generatePassword();
        $url = APP_URL."/change_password.php?token=$token&email=$email&q=ok";

        $calling = ((string) $user->attributes()->gender) == 'male' ? 'Monsieur' : 'Madame';

        $subject = "Reinitialisation de mot de passe - ".APP_NAME;
        $message = Helpers::getRecoverEmailTemplate($user->username, $url, $calling);

        $manager2 = (new DatabaseManager(2, 'database/guests', 'recover'));
        $recover = $manager2->getData()->addChild('recover');
        $recover->addChild('email', $email);
        $recover->addChild('token', $token);
        $recover->addChild('expires', (new DateTime())->add(new DateInterval('P1D'))->format("Y-m-d H:i:s"));
        if($manager2->save()) {
            require_once $main_folder . 'vendor/PHPMailer/PHPMailerAutoload.php';
            if (Helpers::sendMail(new PHPMailer, [$email, $user->username], $subject, [$message, 0]))
                Router::redirect('recover_password', 'q=ok');
            else Router::redirect('recover_password', 'q=down');
        }
        Router::redirect('recover_password', 'q=fail');
    } Router::redirect('recover_password', 'q=ko');
}Router::redirect('login');