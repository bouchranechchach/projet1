<?php

require_once '../controller.php';

if(! isset($_GET['id']) || ! isset($_GET['state'])) Router::redirect('admin/participants');

$data = Request::getData();
$id = $data['id'];
$state = $data['state'];

$manager = new DatabaseManager(1, 'database/guests', 'user');
$user = $manager->findById($id);
$user->attributes()->state = $state;

if($manager->save()){
    if($state == 1) Router::redirect('admin/participants', 'q=ok1');
    else Router::redirect('admin/participants', 'q=ok2');
}

Router::redirect('admin/participants');