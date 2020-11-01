<?php

require_once '../controller.php';

if(! isset($_GET['id'])) Router::redirect('admin/events');

$data = Request::getData();
$id = $data['id'];

$manager = new DatabaseManager(1, 'database/admins', 'event');
$deleted = $manager->deleteById($id);

if($deleted){
    if($manager->save()) Router::redirect('admin/events', 'm=ok');
}Router::redirect('admin/events', 'm=ko');

Router::redirect('admin/events');