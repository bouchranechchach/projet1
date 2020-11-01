<?php

require_once '../controller.php';

unset($_SESSION[APP_ID]);
session_unset();
session_destroy();
Router::redirect('login');