<?php

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("libraries/password_compatibility_library.php");
}

require_once("./settings/settings_db.php");
require_once("classes/Login.php");
require_once ("./functions/functions.php");
$login = new Login();


if ($login->isUserLoggedIn() == true) {

    include("src/views/logged_in.php");

} else {

    include("src/views/logged_in.php");
}
