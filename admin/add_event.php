<?php include 'header.php';?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Ajouter un événement</span>
                                </div>
                            </div>
                        </div>
                        <form action="../controllers/admins/add_event.php" method="post">
                        <div class="card-body">

                            <div class="d-block mt-2 mb-3 text-center">
                                <i class="material-icons text-primary" style="font-size: 70px">event</i>
                            </div>

                            <div class="form-group">
                                <label for="title">Titre d'événement</label>
                                <input type="text" name="title" id="title" placeholder="Titre" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" name="date" id="date" placeholder="Date d'événement" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" min="0" max="20000" name="price" id="price" placeholder="Prix d'événement" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="location">Adresse</label>
                                <input type="text" name="location" id="location" placeholder="Adresse d'événement" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="5" name="description" id="description" placeholder="Ecrire une description sur l'événement..." required class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="action_add_event" class="btn btn-primary float-right pull-right">Ajouter</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>