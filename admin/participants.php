<?php include 'header.php';

$keyword = "";

// si la recherche à été éfféctué
if(isset($_GET['search']))
    $keyword = strtolower(Request::getData()['search']);

$manager = new DatabaseManager(1, 'database/guests', 'user');

?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pour quelle liste ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="mailer.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="keyword" value="<?= $keyword ?>" class="d-none">
                    <div class="form-group">
                        <input type="radio" name="list" id="opt1" value="1">
                        <label for="opt1">Pour les participants avec article</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="list" id="opt2" value="2">
                        <label for="opt2">Pour les participants sans article</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="list" id="opt3" value="0">
                        <label for="opt3">Pour les deux</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper float-left">
                                    <span class="nav-tabs-title">Les participants :</span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#with" data-toggle="tab">
                                                Ayant un article
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#without" data-toggle="tab">
                                                Sans article
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-md-flex justify-content-end">
                                    <?php if(isset($_GET['search'])) : ?>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="#">
                                            Envoyer un mail
                                            <div class="ripple-container"></div>
                                        </a>
                                    <?php endif; ?>
                                    <form class="form-inline d-inline">
                                        <input value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" type="search" class="form-control text-light" name="search" placeholder="Recherche...">
                                        <button type="submit" class="btn btn-primary">Chercher</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(isset($_GET['q'])): ?>
                            <?php if(Request::getData()['q'] == 'ok1'): ?>
                                <div class="alert alert-info mt-2">Vous avez <b class="text-success">accepté</b> un article avec succès</div>
                            <?php else : ?>
                                <div class="alert alert-info mt-2">Vous avez <b class="text-danger">réfusé</b> un article avec succès</div>
                            <?php endif;endif; ?>
                            <?php if(isset($_GET['mail']) && isset($_GET['state'])): ?>
                                <div class="alert alert-success mt-2">Votre email à été envoyé au participants avec succès!</div>
                            <?php endif; ?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="with">
                                    <table class="table table-full-width table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Tél</th>
                                            <th>Gender</th>
                                            <th>Pays</th>
                                            <th>Hotel</th>
                                            <th>Université</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $users = $manager->findWhere(['has_article'=>'1']);
                                        $manager->setData($users);
                                        $users = $users ? $manager->searchByKeyword($keyword) : null;
                                        if(! $users) echo "<tr><center>Aucun participant</center></tr>";
                                        else
                                        foreach ($users as $user) :
                                            ?>
                                            <tr>
                                                <td><?= $user->username ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->phone ?></td>
                                                <td><?= $user->attributes()->gender == 'male' ? 'Homme' : 'Femme' ?></td>
                                                <td><?= $user->country ?></td>
                                                <td><?= $user->hotel ?></td>
                                                <td><?= $user->university ?></td>
                                                <td>
                                                    <a href="participant.php?id=<?= $user->attributes()->id ?>">
                                                        <i class="material-icons text-info">visibility</i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="mailer.php?email=<?= $user->email ?>">
                                                        <i class="material-icons text-warning">email</i>
                                                    </a>
                                                    <?php if((int) $user->attributes()->state == 0) : ?>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="../controllers/admins/change_user_state.php?id=<?= $user->attributes()->id ?>&state=1"
                                                       onclick="return confirm('etes-vous sûr d\'accepter l\'article de <?= $user->username ?>')">
                                                        <i class="material-icons text-success">check</i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="../controllers/admins/change_user_state.php?id=<?= $user->attributes()->id ?>&state=2"
                                                    onclick="return confirm('etes-vous sûr de réfuser l\'article de <?= $user->username ?>')">
                                                        <i class="material-icons text-danger">close</i>
                                                    </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="without">
                                    <table class="table table-full-width">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Tél</th>
                                            <th>Gender</th>
                                            <th>Pays</th>
                                            <th>Hotel</th>
                                            <th>Université</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $users = $manager->findWhere(['has_article'=>'0']);
                                        $manager->setData($users);
                                        $users = $users ? $manager->searchByKeyword($keyword) : null;
                                        if(! $users) echo "<tr><center>Aucun participant</center></tr>";
                                        else
                                            foreach ($users as $user) :
                                                ?>
                                                <tr>
                                                    <td><?= $user->username ?></td>
                                                    <td><?= $user->email ?></td>
                                                    <td><?= $user->phone ?></td>
                                                    <td><?= $user->attributes()->gender == 'male' ? 'Homme' : 'Femme' ?></td>
                                                    <td><?= $user->country ?></td>
                                                    <td><?= $user->hotel ?></td>
                                                    <td><?= $user->university ?></td>
                                                    <td>
                                                        <a href="participant.php?id=<?= $user->attributes()->id ?>">
                                                            <i class="material-icons text-info">visibility</i>
                                                        </a>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <a href="mailer.php?email=<?= $user->email ?>">
                                                            <i class="material-icons text-info">email</i>
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