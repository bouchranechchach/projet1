<?php

require_once '../controller.php';

unset($_SESSION[APP_ADMIN_ID]);
session_unset();
session_destroy();
Router::redirect('admin/login');