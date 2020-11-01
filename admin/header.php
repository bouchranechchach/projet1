<?php require_once 'config.php';

if(! Request::isAdminConnected()) Router::redirect('admin/login');

$ntfs = (new DatabaseManager(1, 'database/admins', 'notification'))->findWhere(['state'=>'0']);
$new_notifs = $ntfs ? count($ntfs) : 0;

if(isset($_GET['seen'])){
    $manager = new DatabaseManager(2, 'database/admins', 'notification');
    $notifs = $manager->getData();
    foreach ($notifs as $notif){
        $notif->attributes()->state = '1';
    }
    $manager->save();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?= APP_NAME ?> - Administration
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
        <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
                <?= APP_NAME ?>
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link bg-info" href="index.php">
                        <i class="material-icons">dashboard</i>
                        <p>Conférence</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="participants.php">
                        <i class="material-icons">face</i>
                        <p>Les participants</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="events.php">
                        <i class="material-icons">event</i>
                        <p>Les événements</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="mailer.php">
                        <i class="material-icons">mail</i>
                        <p>Mailer</p>
                    </a>
                </li>

                <li class="nav-item active-pro ">
                    <a class="nav-link" href="../controllers/admins/logout.php">
                        <i class="material-icons">logout</i>
                        <p>Déconnexion</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;"><?= APP_NAME ?> - panneau d'administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">notifications</i>
                            <?= $new_notifs ? "<span class='notification'>$new_notifs</span>" : '' ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                                $manager = new DatabaseManager(3, 'database/admins', 'notification');
                                $i = 0;
                                $notifications = DatabaseManager::rsort($manager->getData());
                                foreach ($notifications as $notification):
                                    $is_seen = ! (int) $notification->attributes()->state ? 'bg-info' : '';
                                    if($i >= 10) break;
                            ?>
                                <a class="dropdown-item <?= $is_seen ?>" href="?seen">
                                    <?= $notification->content ?>
                                    <br />
                                    <?= (new DateTime($notification->date))->format('d/m/Y à H:i') ?>
                                </a>
                            <?php $i++;endforeach; ?>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->