<?php

require_once '../controller.php';

$manager = new DatabaseManager(1, 'database/admins', 'event');
$event = $manager->findById(Request::getData()['id']);

$mgr = new DatabaseManager(2, 'database/admins', 'event_user');
$payment = $mgr->findByAttributes(['event_id'=>$event->attributes()->id, 'user_id'=>$_SESSION[APP_ID]]);

$user = Helpers::getCurrentUser(new DatabaseManager(3, 'database/guests', 'user'), APP_ID);

$conference = (new DatabaseManager(4, 'database/admins', 'conference'))->findById(1);

$content = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<?xml-stylesheet type=\"text/xsl\" href=\"invoice.xsl\" ?>
<invoices>
    <invoice>
        <number>".$payment->attributes()->id."</number>
        <conference_name>".$conference->title."</conference_name>
        <conference_location>".$conference->location."</conference_location>
        <conference_date>".(new DateTime($conference->date))->format("d/m/Y à H:i")."</conference_date>
        <payment_method>".$payment->attributes()->payment_method."</payment_method>
        <event_title>".$event->title."</event_title>
        <amount>".$event->price."</amount>
        <username>".$user->username."</username>
        <date>le ".(new DateTime($payment->attributes()->date))->format("d/m/Y à H:i")."</date>
    </invoice>
</invoices>";

file_put_contents($main_folder."prints/invoices/".$payment->attributes()->id.".xml", $content);
(new Router($main_folder.'prints/invoices/'.$payment->attributes()->id.'.xml'))->go();