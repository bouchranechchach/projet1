<?php

require_once '../controller.php';

if(isset($_POST['action_join_event'])){

    $data = Request::getData('POST');
    $event_id = $data['id'];
    $payment_method = $data['payment_method'];
    $user_id = $_SESSION[APP_ID];

    $manager = new DatabaseManager(1, 'database/admins', 'event_user');
    $evt_usr = $manager->getData()->addChild('event_user');
    $evt_usr->addAttribute('id', DatabaseManager::increment('event_user'));
    $evt_usr->addAttribute('event_id', $event_id);
    $evt_usr->addAttribute('user_id', $user_id);
    $evt_usr->addAttribute('payment_method', $payment_method);
    $evt_usr->addAttribute('date', (new DateTime())->format("Y-m-d H:i:s"));

    if($manager->save()) Router::redirect('event', 'id='.$event_id);
    Router::redirect('event', 'q=ko');

}
Router::redirect('events');