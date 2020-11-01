<?php

require_once '../controller.php';

if(isset($_POST['action_add_event'])){

    $data = Request::getData('POST');
    $title = $data['title'];
    $price = $data['price'];
    $description = $data['description'];
    $date = $data['date'];
    $location = $data['location'];

    $manager = new DatabaseManager(1, 'database/admins', 'event');
    $event = $manager->getData()->addChild('event');
    $event->addAttribute('id', DatabaseManager::increment('event'));
    $event->addChild('title', $title);
    $event->addChild('description', $description);
    $event->addChild('price', $price);
    $event->addChild('date', $date);
    $event->addChild('location', $location);

    if($manager->save()) Router::redirect('admin/events', 'q=ok');
    Router::redirect('admin/events', 'q=ko');

}
Router::redirect('admin/events');