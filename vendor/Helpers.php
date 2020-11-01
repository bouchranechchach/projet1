<?php


class Helpers {

    /**
     * Retourner l'utilisateur connecté
     * @param $manager
     * @param $app_id
     * @return SimpleXMLElement
     */
    public static function getCurrentUser($manager, $app_id){
        return $manager->findById($_SESSION[$app_id]);
    }

    /**
     * Générer un mot de passe de 9 charactères
     * @return string
     */
    public static function generatePassword(){
        $pass = [];
        for($i=0;$i<42;$i++) $pass[] = chr(rand(ord('A'), ord('Z')));
        for($i=0;$i<42;$i++) $pass[] = chr(rand(ord('0'), ord('9')));
        for($i=0;$i<44;$i++) $pass[] = chr(rand(ord('a'), ord('z')));
        shuffle($pass);
        return implode('', $pass);
    }

    /**
     * Le corp de mail réinitialiser le mot de passe
     * @param string $calling
     * @param $username
     * @return string
     */
    public static function getRecoverEmailTemplate($username, $body, $calling = 'Monsieur'){
        return "$calling $username,<br><br>
            Vous avez réinitialisé votre mot de passe, pour le changer cliquer sur le lien suivant :<br><br>
            $body<br>
            Ce lien est valable dans <b>24h</b>.
            <br><br>
            Merci.<br><br>
            <b>© 2020, tous droits réservé pour ".APP_NAME."</b>
        ";
    }

    /**
     * Le corp de mail personnalisé
     * @return string
     */
    public static function messageUserByEmailTemplate(){
        return "
[calling] [user_name]

On accuse réception de votre article pour la participation à la conférence : [conference_title].
C’est avec un immense plaisir qu'on vous informe que votre article à été accepté pour être discuter le jour de la conférence.
Vous devriez vous présenter dans le lieu de la conférence le [conference_date] afin de présenter et discuter votre article.

Je vous prie de bien vouloir agréer Monsieur, Madame l’assurance de mes sincères salutations";
    }

    /**
     * Mailer Service
     * @param $mail
     * @param $to array(string email, string fullname)
     * @param $subject string txt
     * @param $msg array(string message, int type[html=>0, text=>1])
     * @param $attach array(string filename, string file_title)
     * example sendMail(array($email, $name), "subject", array($messg, 0))
     * @return boolean
     */
    public static function sendMail($mail, $to, $subject, $msg, $attach=""){
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->SMTPAuth = true;
        $mail->Username = "config.devcrawlers@gmail.com";
        $mail->Password = "devconf@7222000";

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('config.devcrawlers@gmail.com', 'ConfApp Admin');
        $mail->addAddress($to[0], $to[1]);
        $mail->Subject = $subject;
        if($msg[2]==0){
            $mail->isHTML(true);
            $mail->Body = $msg[0];
        }else{
            $mail->Body = $msg[0];
        }
        $mail->AltBody = $msg;

        if($attach!="") $mail->addAttachment($attach[0], $attach[1]);

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Envoyer une notification à l'administrateur
     * @param $content
     * @param $date
     * @return boolean
     */
    public static function notifyAdmin($content, $date){
        $manager = new DatabaseManager(1, 'database/admins', 'notification');
        $notif = $manager->getData()->addChild('notification');
        $notif->addAttribute('id', DatabaseManager::increment('notification'));
        $notif->addAttribute('state', '0');
        $notif->addChild('content', $content);
        $notif->addChild('date', $date);
        return $manager->save();
    }

    /**
     * Retourne une sous partie d'un texte donné
     * @param $str
     * @param $count
     * @return string
     */
    public static function shortened($str, $count){
        return strlen($str) <= $count ? $str : substr($str, 0, $count) . '...';
    }

}