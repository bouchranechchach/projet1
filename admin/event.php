<?php include 'header.php';

if(! isset($_GET['id'])) Router::redirect('admin/events');
$manager = new DatabaseManager(1, 'database/admins', 'event');
$event = $manager->findById(Request::getData()['id']);

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