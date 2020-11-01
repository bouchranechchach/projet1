<?php require_once 'config.php';

if(Request::isConnected()) Router::redirect('index');
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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="material-icons">login</i>
                        <p>Authentification</p>
                    </a>
                </li>
                <li class="nav-item active">
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
                    <a class="navbar-brand" href="javascript:;">Joindre le conférence avec nous!</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Participation</h4>
                                <p class="card-category"> Joindre nous dès maintenant</p>
                            </div>
                            <div class="card-body">

                                <?php if(isset($_GET['q'])): ?>
                                    <div class="alert alert-danger mt-2">
                                        Vérifier vous information et réssayer
                                    </div>
                                <?php endif; ?>

                                <form action="controllers/guests/register.php" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label for="avatar">Photo</label>
                                        <input type="file" id="avatar" class="form-control" name="avatar" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Votre nom complét</label>
                                        <input type="text" id="name" class="form-control" name="name" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" class="form-control" name="password" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label>
                                        <input type="text" id="phone" class="form-control" name="phone" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="university">Université</label>
                                        <input type="text" id="university" class="form-control" name="university" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="hotel">Hotel</label>
                                        <input type="text" id="hotel" class="form-control" name="hotel" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Pays</label>
                                        <select class="form-control" name="country" id="country" required>
                                            <?php
                                                $mgr = new DatabaseManager(2, 'database/guests', 'countries');
                                                $countries = $mgr->getData();
                                                foreach ($countries as $country):
                                            ?>
                                            <option value="<?= (string) $country ?>"><?= (string) $country ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="airport">Airport</label>
                                        <input type="text" id="airport" class="form-control" name="airport" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_depart">Date de départ</label>
                                        <input type="datetime-local" id="date_depart" class="form-control" name="date_depart" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_arrive">Date d'arrivée</label>
                                        <input type="datetime-local" id="date_arrive" class="form-control" name="date_arrive" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="has_article" class="" name="has_article" required/>
                                        <label for="has_article">Avez-vous un article à publier ?</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="mr-4">Vous êtez ?</label>
                                        <label for="male">Homme</label> <input type="radio" id="male" class="mr-3" value="male" name="gender" required checked/>
                                        <label for="female">Femme</label> <input type="radio" id="female" value="female" name="gender" required/>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right float-right" name="action_register">Connecter</button>
                                    </div>
                                </form>
                                <div class="d-block">
                                    Vous avez déja un compte? <a href="login.php">connectez-vous</a>
                                </div>
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