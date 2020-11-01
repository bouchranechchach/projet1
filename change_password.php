<?php require_once 'config.php';

if(Request::isConnected()) Router::redirect('index');

// vérifier si l'utilisateur a déje utiliser le lien de récupération
$manager = new DatabaseManager(2, $main_folder.'database/guests', 'recover');
$recover = $manager->find(
    [
        'email' => Request::getData()['email'],
        'token' => Request::getData()['token']
    ]
);

if($recover){
    $now = (new DateTime())->getTimestamp();
    $expires = (new DateTime($recover->expires))->getTimestamp();
    if($expires < $now) Router::redirect('login');
}else Router::redirect('login');

?>
<!doctype html>
<html lang="en">

<head>
    <title><?= APP_NAME ?></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet"/>
</head>

<body>
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
        <div class="logo">
            <a href="." class="simple-text logo-normal">
                <?= APP_NAME ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link" href="login.php">
                        <i class="material-icons">login</i>
                        <p>Authentification</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">
                        <i class="material-icons">fact_check</i>
                        <p>Participer</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;">Récupération de mot de passe - changement</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="admin/">
                                <i class="material-icons">analytics</i>
                                Administration
                            </a>
                        </li>
                        <!-- your navbar here -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Changement de mot de passe</h4>
                                <p class="card-category"> Donner un nouveau mot de passe</p>
                            </div>
                            <div class="card-body">
                                <form action="controllers/guests/change_password.php" method="post">
                                    <input type="hidden" name="email" class="d-none" value="<?= Request::getData()['email'] ?>">
                                    <input type="hidden" name="token" class="d-none" value="<?= Request::getData()['token'] ?>">
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" class="form-control" name="password" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Re-tapez le mot de passe</label>
                                        <input type="password" id="password2" class="form-control" name="password2" required/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right float-right" name="action_change_password">Sauvegarder</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="login.php">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="register.php">
                                Participer
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , Créer en <i class="material-icons">favorite</i> par
                    <?= COPYRIGHT ?>.
                </div>
            </div>
        </footer>
    </div>
</div>
</body>

</html>