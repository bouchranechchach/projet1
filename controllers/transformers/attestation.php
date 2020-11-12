<?php

require_once '../controller.php';

$manager = new DatabaseManager(1, 'database/guests', 'user');
$user = $manager->findById(Request::getData()['id']);

$mgr = new DatabaseManager(2, 'database/admins', 'conference');
$conference = $mgr->findById(1);

$sex = $user->attributes()->gender == 'male' ? 'Monsieur ' : 'Madame ';
$now = (new DateTime())->format("d/m/Y");

$content = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<?xml-stylesheet type=\"text/xsl\" href=\"attestation.xsl\" ?>
<attestations>
    <attestation>
        <conference_name>".$conference->title."</conference_name>
        <conference_location>".$conference->location."</conference_location>
        <conference_date>".$conference->date."</conference_date>
        <organiser>".ORGANISER."</organiser>
        <gender>".$sex."</gender>
        <username>".$user->username."</username>
        <now>".$now."</now>
    </attestation>
</attestations>";

file_put_contents($main_folder."prints/attestations/".$user->attributes()->id.".xml", $content);
(new Router($main_folder.'prints/attestations/'.$user->attributes()->id.'.xml'))->go();