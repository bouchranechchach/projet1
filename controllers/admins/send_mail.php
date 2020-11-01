<?php

require_once '../controller.php';

// remplacer les variables utilisés dans le message
function applyTransformations($message, $user){
    $calling = $user->attributes()->gender == 'male' ? 'Monsieur' : 'Madame';
    $concrete = str_replace("\n", "<br>", $message);
    $concrete = str_replace("[calling]", $calling, $concrete);
    $concrete = str_replace("[user_name]", $user->username, $concrete);
    $concrete = str_replace("[user_email]", $user->email, $concrete);
    $concrete = str_replace("[user_phone]", $user->phone, $concrete);
    $concrete = str_replace("[user_country]", $user->country, $concrete);
    $manager = new DatabaseManager(1, 'database/admins', 'conference');
    $conference = $manager->findById(1);
    $date = (new DateTime($conference->date))->format("d/m/Y à H")."h";
    $concrete = str_replace("[conference_title]", $conference->title, $concrete);
    $concrete = str_replace("[conference_date]", $date, $concrete);
    $concrete = str_replace("[conference_location]", $conference->location, $concrete);
    return $concrete;
}

if(isset($_POST['action_send_mail'])){

    require_once $main_folder . 'vendor/PHPMailer/PHPMailerAutoload.php';

    $data = Request::getData('POST');
    $subject = $data['subject'];

    // envoyer les emails par filtre des participants
    if(isset($_POST['keyword'])){
        $keyword = $data['keyword'];
        $list = str_replace("\n", "<br>", $data['list']);

        $manager = new DatabaseManager(1, 'database/guests', 'user');
        if($list == 1) $users = $manager->findWhere(['has_article'=>'1']);
        elseif ($list == 2) $users = $manager->findByAttributes(['has_article'=>'0']);
        else $users = $manager->getData();

        $manager->setData($users);
        $users = $users ? $manager->searchByKeyword($keyword) : null;

        foreach ($users as $user){
            $message = applyTransformations($data['message'], $user);
            Helpers::sendMail(new PHPMailer, [$user->email, $user->username], $subject, [$message, 0]);
        }

        Router::redirect('admin/participants', 'mail=l&state=ok');
    }else{
        // envoyer un email simple
        $email = $data['email'];
        $manager = new DatabaseManager(1, 'database/guests', 'user');
        $user = $manager->find(['email' => $email]);

        $message = applyTransformations($data['message'], $user);
        if(Helpers::sendMail(new PHPMailer, [$email, $user->username], $subject, [$message, 0]))
            Router::redirect('admin/mailer', 'mail=s&state=ok');
        else
            Router::redirect('admin/mailer', 'mail=s&state=ko');
    }
}
Router::redirect('admin/send_mail');