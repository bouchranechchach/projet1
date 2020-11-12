<?php include 'header.php';

if(! isset($_GET['id'])) Router::redirect('events');
$id = Request::getData()['id'];
$manager = new DatabaseManager(1, 'database/admins', 'event');
$event = $manager->findById($id);

$is_check = (new DatabaseManager(2, 'database/admins', 'event_user'))
    ->findByAttributes(['user_id'=>$_SESSION[APP_ID], 'event_id'=>$id]);

?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Evénement : <?= $event->title ?></span>
                                    <span class="float-right pull-right font-weight-bold">
                                        <b style="font-size: 36px"><?= $event->price ?> Dh</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex text-center mt-3 mb-5">
                                <i class="material-icons text-primary" style="font-size: 70px">event</i>
                            </div>
                            <p>
                                <?= $event->description ?>
                            </p>
                            <?php if(! $is_check) : ?>
                                <div class="d-block">
                                    <form action="controllers/guests/event_join.php" method="post">
                                        <div class="form-group">
                                            <label for="payment_method">Mode de paiement</label>
                                            <select name="payment_method" class="form-control" id="payment_method">
                                                <option value="Espèces">Espèces</option>
                                                <option value="Chèques">Chèques</option>
                                                <option value="Carte bancaire">Carte bancaire</option>
                                                <option value="Autre">Autre</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="action">Voulez-vous joindre cet événement ?</label>
                                            <input type="hidden" class="d-none" value="<?= Request::getData()['id'] ?>" name="id">
                                            <button type="submit" name="action_join_event" class="btn btn-primary pull-right float-right"><i class="material-icons text-light">payment</i> Joindre l'événement</button>
                                        </div>
                                    </form>
                                </div>
                            <?php else : ?>
                                <div class="text-center justify-content-center">
                                    <div class="text-success">Vous avez joint cet événement</div>
                                    <a href="controllers/transformers/invoice.php?id=<?= $event->attributes()->id ?>" target="_blank" class="btn btn-primary">Imprimer le reçu</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <span>
                                <i class="material-icons">map</i> <?= $event->location ?>
                            </span>
                            <span class="float-right pull-right">
                                <i class="material-icons">watch_later</i>
                                <b><?= (new DateTime($event->date))->format("d/m/Y H:i") ?></b>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>