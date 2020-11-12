<?php include "header.php";

$user = Helpers::getCurrentUser(
        new DatabaseManager(1, $main_folder.'database/guests', 'user'), APP_ID
);

?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Mon Profil
                      <a href="controllers/transformers/badge.php?id=<?= $user->attributes()->id ?>" target="_blank" class="btn btn-primary text-light float-right pull-right">Imprimer mon badge</a>
                      <a href="controllers/transformers/attestation.php?id=<?= $user->attributes()->id ?>" target="_blank" class="btn btn-primary text-light float-right pull-right">Attestation de participation</a>
                  </h4>
                  <p class="card-category">voici les informations de votre profil</p>
                </div>
                <div class="card-body">
                    <h3>Modifier les informations de votre profil</h3>
                    <br/>
                  <form action="controllers/guests/edit_profile.php" method="post">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" value="<?= $user->email ?>" disabled>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom Complet</label>
                          <input type="text" class="form-control" name="username" value="<?= $user->username ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Téléphone</label>
                          <input type="text" class="form-control" name="phone" value="<?= $user->phone ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Hotel</label>
                          <input type="text" name="hotel" class="form-control" value="<?= $user->hotel ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Aireport</label>
                          <input type="text" name="airport" class="form-control" value="<?= $user->airport ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Université</label>
                          <input type="text" name="university" class="form-control" value="<?= $user->university ?>">
                        </div>
                      </div>
                    </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="bmd-label-floating">Pays</label>
                                  <select name="country" id="country" class="form-control">
                                      <?php
                                      $mgr = new DatabaseManager(2, 'database/guests', 'countries');
                                      $countries = $mgr->getData();
                                      foreach ($countries as $country):
                                          if((string) $country == (string) $user->country):
                                              ?>
                                              <option value="<?= (string) $country ?>" selected><?= (string) $country ?></option>
                                          <?php else : ?>
                                              <option value="<?= (string) $country ?>"><?= (string) $country ?></option>
                                          <?php endif;endforeach; ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Date de départ</label>
                          <input type="datetime-local" class="form-control" name="date_depart" value="<?= $user->date_depart ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Date d'arrivée</label>
                          <input type="datetime-local" class="form-control" name="date_arrive" value="<?= $user->date_arrive ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <?php if(isset($_GET['q'])) : ?>

                        <?php if($_GET['q'] == 'ok') : ?>
                            <div class="alert alert-success">Votre profil à été modifié avec succès!</div>
                        <?php else : ?>
                            <div class="alert alert-danger">Ne peut pas modifier votre profil, essayer à nouveau ou contactez l'administration.</div>
                        <?php endif;endif; ?>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="action_edit_profile">Mettre à jour le profil</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#">
                    <img class="img" src="<?= $user->avatar ?>"/>
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray"><?= $user->attributes()->gender == 'male' ? 'Monsieur' : 'Madame' ?></h6>
                  <h4 class="card-title"><?= $user->username ?></h4>
                  <p class="card-description">
                    <?= $user->university ?>
                  </p>
                    <?php if((int) $user->attributes()->has_article) : ?>
                  <a href="javascript:;" class="btn btn-primary btn-round">Avec Article</a>
                    <br />
                    <?php if((int) $user->attributes()->state == 0) : ?>
                        <span class="text-dark">Votre article et en cours de traitement!</span>
                    <?php elseif((int) $user->attributes()->state == 2) : ?>
                        <span class="text-danger">Votre article est réfusé</span>
                    <?php else: ?>
                        <span class="text-success">Félicitations, votre article à été accepté</span>
                    <?php endif;endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include "footer.php"; ?>