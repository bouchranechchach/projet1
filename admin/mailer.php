<?php include 'header.php';

$subject = $message = "";
if(isset($_POST['keyword'])){
    $data = Request::getData('POST');
    $keyword = $data['keyword'];
    $list = $data['list'];

    $subject = "Confirmation de l'acceptation d'article";
    $message = Helpers::messageUserByEmailTemplate('[nom]', '[gender]');
}

?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Plateforme d'envoie des email</span>
                                </div>
                            </div>
                        </div>
                        <form action="../controllers/admins/send_mail.php" method="post">
                        <div class="card-body">
                            <?php if(isset($_POST['keyword'])) : ?>
                                <input type="hidden" name="keyword" value="<?= $keyword ?>">
                                <input type="hidden" name="list" value="<?= $list ?>">
                            <?php endif ?>
                            <div class="flex text-center mt-2 mb-3">
                                <i class="material-icons text-primary" style="font-size: 70px">mail</i>
                            </div>
                            <?php if(isset($_GET['mail'])) : ?>
                                <?php if($_GET['state'] == 'ok') : ?>
                                    <div class="alert alert-success">Votre message à été envoyé avec suucès</div>
                                <?php else : ?>
                                    <div class="alert alert-danger">Erreur d'envoie de message, essayer plus tard</div>
                            <?php endif;endif ?>
                            <?php if(! isset($_POST['keyword'])) : ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>"
                                       class="form-control" name="email" required id="email" placeholder="Email de participant">
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="subject">Sujet</label>
                                <input type="text" value="<?= $subject ?>" class="form-control" name="subject" required id="subject" placeholder="Sujet de mail">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="8" placeholder="Ecrire le corp de message ..."><?= $message ?></textarea>
                            </div>
                            <div class="form-group">
                                <p>
                                    <b>Les variables utils : </b>
                                    <code title="Monsieur ou Madame">[calling]</code>
                                    <code title="Nom de participant">[user_name]</code>
                                    <code title="Adresse email de participant">[user_email]</code>
                                    <code title="Numéro de téléphone de participant">[user_phone]</code>
                                    <code title="Le pays de participant">[user_country]</code>
                                    <code title="Titre de conférence">[conference_title]</code>
                                    <code title="Date de conférence">[conference_date]</code>
                                    <code title="Adresse de conférence">[conference_location]</code>
                                </p>
                            </div>
                            <?php if(isset($_POST['keyword'])) : ?>
                            <div class="form-group">
                                <p><i class="material-icons">warning</i>
                                    Vous avez séléctionner une liste des destinataires personnalisée</p>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="card-footer">
                            <button type="reset" class="btn btn-default">Récupérer</button>
                            <button type="submit" class="btn btn-primary pull-right float-right" name="action_send_mail">Envoyer</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>