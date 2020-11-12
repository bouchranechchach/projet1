<?php include 'header.php';

$manager = new DatabaseManager(1, 'database/guests', 'user');
$participants = $manager->getData()->count();
$with_article = count($manager->getData()->xpath("user[@has_article='1']"));
$without_article = count($manager->getData()->xpath("user[@has_article='0']"));

?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">event_seat</i>
                  </div>
                  <p class="card-category">Participants</p>
                  <h3 class="card-title"><?= $with_article ?>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                      Ayant un article
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">face</i>
                  </div>
                  <p class="card-category">Participants</p>
                  <h3 class="card-title"><?= $without_article ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Sans article
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <p class="card-category">Total des participants</p>
                  <h3 class="card-title"><?= $participants ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Sans et avec article
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <img src="admin/assets/img/guest_conf.jpg" class="w-100 img-fluid img-raised img-thumbnail">
          </div>
        </div>
      </div>

<?php include 'footer.php'?>