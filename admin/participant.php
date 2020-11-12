<?php include 'header.php';

if(! isset($_GET['id'])) Router::redirect('admin/participants');
$id = Request::getData()['id'];
$manager = new DatabaseManager(1, 'database/guests', 'user');
$user = $manager->findById($id);

?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Participant : <?= $user->username ?></span>
                                    <span class="float-right pull-right font-weight-bold">
                                        <?php if((int) $user->attributes()->has_article) : ?>
                                            <span class="badge text-success" style="font-size: 28px">Avec article</span>
                                        <?php else : ?>
                                            <span class="badge text-danger" style="font-size: 26px">Sans article</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex text-center mt-3 mb-5">
                                <img src="../<?= $user->avatar ?>" class="img-thumbnail img-raised" width="180">
                            </div>
                            <div class="mt-2 mb-2">
                                <a href="../controllers/transformers/badge.php?id=<?= $user->attributes()->id ?>" target="_blank" class="btn btn-primary">Imprimer le badge</a>
                                <a href="../controllers/transformers/attestation.php?id=<?= $user->attributes()->id ?>" target="_blank" class="btn btn-primary float-right pull-right">Attestation d'inscription</a>
                            </div>
                            <table class="table-striped table-full-width table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $user->email ?></td>
                                    </tr>
                                    <tr>
                                        <th>Téléphone</th>
                                        <td><?= $user->phone ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td><?= $user->attributes()->gender == 'male' ? 'Homme' : 'Femme' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Hotel</th>
                                        <td><?= $user->hotel ?></td>
                                    </tr>
                                    <tr>
                                        <th>Aireport</th>
                                        <td><?= $user->airport ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date de départ</th>
                                        <td><?= (new DateTime($user->date_depart ))->format("d/m/Y à H:i") ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date d'arrivé</th>
                                        <td><?= (new DateTime($user->date_arrive ))->format("d/m/Y à H:i") ?></td>
                                    </tr>
                                    <tr>
                                        <th>Université</th>
                                        <td><?= $user->university ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>