<?php

require_once '../controller.php';

$manager = new DatabaseManager(1, 'database/guests', 'user');
$user = $manager->findById(Request::getData()['id']);

$mgr = new DatabaseManager(2, 'database/admins', 'conference');
$confname = $mgr->findById(1)->title;

$content = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<?xml-stylesheet type=\"text/xsl\" href=\"badge.xsl\" ?>
<badges>
    <badge>
        <conference>$confname</conference>
        <username>".$user->username."</username>
        <email>".$user->email."</email>
        <phone>".$user->phone."</phone>
        <university>".$user->university."</university>
        <avatar>".$user->avatar."</avatar>
    </badge>
</badges>";

file_put_contents($main_folder."prints/badges/".$user->attributes()->id.".xml", $content);
(new Router($main_folder.'prints/badges/'.$user->attributes()->id.'.xml'))->go();