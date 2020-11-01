<?php include 'header.php';?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Les événements publiées :</span>
                                    <span class="float-right pull-right">
                                        <a href="add_event.php" class="btn btn-light">Ajouter un événement</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="all">

                                    <?php if(isset($_GET['q'])) : ?>
                                    <?php if(Request::getData()['q'] == 'ok') : ?>
                                        <div class="alert alert-success">L'événement à été ajouté</div>
                                    <?php else : ?>
                                        <div class="alert alert-danger">Erreur d'ajout d'événement, essayer plus tard</div>
                                    <?php endif; endif; ?>
                                    <?php if(isset($_GET['m'])) : ?>
                                        <?php if(Request::getData()['m'] == 'ok') : ?>
                                            <div class="alert alert-success">L'événement à été supprimé avec succès</div>
                                        <?php else : ?>
                                            <div class="alert alert-danger">Erreur de suppression d'événement, essayer plus tard</div>
                                        <?php endif; endif; ?>
                                    <table class="table">
                                        <tbody>
                                        <?php
                                            $manager = new DatabaseManager(1, 'database/admins', 'event');
                                            $events = $manager->getData();
                                            foreach ($events as $event) :
                                        ?>
                                        <tr>
                                            <td><b><a href="event.php?id=<?= $event->attributes()->id ?>"><?= $event->title ?></a> (<?= $event->price!=0? $event->price.' Dh' : 'gratuit' ?>)</b>
                                                <?= Helpers::shortened($event->description, 70) ?>.
                                                <br />
                                                <?= $event->location ?>
                                                <b>le <?= (new DateTime($event->date))->format('d/m/Y H:i') ?></b></td>
                                            <td>
                                                <a href="../controllers/admins/delete_event.php?id=<?= $event->attributes()->id ?>"
                                                    class="text-danger" onclick="return confirm('Etes-vous sûr de suppimer l\'événement')">
                                                    <i class="material-icons">close</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>