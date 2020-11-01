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
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#all" data-toggle="tab">
                                                <i class="material-icons">event_note</i> Tous
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#checked" data-toggle="tab">
                                                <i class="material-icons">check_box</i> Ckecked
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#unchecked" data-toggle="tab">
                                                <i class="material-icons">check_box_outline_blank</i> Not Checked
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="all">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                            $manager = new DatabaseManager(1, 'database/admins', 'event');
                                            $events = $manager->getData();
                                            foreach ($events as $event) :
                                                $is_check = (new DatabaseManager(2, 'database/admins', 'event_user'))
                                                    ->findByAttributes(['user_id'=>$_SESSION[APP_ID], 'event_id'=>$event->attributes()->id]);
                                                $checked = $is_check != null ? 'checked' : '';
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" disabled <?= $checked ?>>
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                          </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><b><a href="event.php?id=<?= $event->attributes()->id ?>"><?= $event->title ?></a> (<?= $event->price!=0? $event->price.' Dh' : 'gratuit' ?>)</b>
                                                <?= Helpers::shortened($event->description, 70) ?>.
                                                <br />
                                                <?= $event->location ?>
                                                <b>le <?= (new DateTime($event->date))->format('d/m/Y H:i') ?></b></td>
                                            <?php if(! $is_check) : ?>
                                            <td class="td-actions text-right">
                                                <a href="event.php?id=<?= $event->attributes()->id ?>" rel="tooltip" title="Joindre cet événement"
                                                        class="btn btn-danger btn-link btn-sm">
                                                    <i class="material-icons">payment</i>
                                                </a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="checked">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                        $manager = new DatabaseManager(1, 'database/admins', 'event');
                                        $events = $manager->getData();
                                        foreach ($events as $event) :
                                            $is_check = (new DatabaseManager(2, 'database/admins', 'event_user'))
                                                ->findByAttributes(['user_id'=>$_SESSION[APP_ID], 'event_id'=>$event->attributes()->id]);
                                            if($is_check != null) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" disabled checked>
                                                            <span class="form-check-sign">
                                                            <span class="check"></span>
                                                          </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b><a href="event.php?id=<?= $event->attributes()->id ?>"><?= $event->title ?></a> (<?= $event->price!=0? $event->price.' Dh' : 'gratuit' ?>)</b>
                                                    <?= Helpers::shortened($event->description, 70) ?>.
                                                    <br />
                                                    <?= $event->location ?>
                                                    <b>le <?= (new DateTime($event->date))->format('d/m/Y H:i') ?></b></td>
                                            </tr>
                                        <?php endif;endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="unchecked">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                        $manager = new DatabaseManager(1, 'database/admins', 'event');
                                        $events = $manager->getData();
                                        foreach ($events as $event) :
                                            $is_check = (new DatabaseManager(2, 'database/admins', 'event_user'))
                                                ->findByAttributes(['user_id'=>$_SESSION[APP_ID], 'event_id'=>$event->attributes()->id]);
                                            if($is_check == null) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" disabled>
                                                            <span class="form-check-sign">
                                                            <span class="check"></span>
                                                          </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><b><a href="event.php?id=<?= $event->attributes()->id ?>"><?= $event->title ?></a> (<?= $event->price!=0? $event->price.' Dh' : 'gratuit' ?>)</b>
                                                    <?= Helpers::shortened($event->description, 70) ?>.
                                                    <br />
                                                    <?= $event->location ?>
                                                    <b>le <?= (new DateTime($event->date))->format('d/m/Y H:i') ?></b></td>
                                                <td class="td-actions text-right">
                                                    <a href="event.php?id=<?= $event->attributes()->id ?>" rel="tooltip" title="Joindre cet événement"
                                                            class="btn btn-danger btn-link btn-sm">
                                                        <i class="material-icons">payment</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif;endforeach; ?>
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