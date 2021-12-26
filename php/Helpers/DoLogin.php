<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';

$userName = $_POST["user"];
$pass = $_POST["pass"];
$user = null;

if (login()) {
    header("location: ./People.php");
} else {
    header("location: ./Index.php?userAndOrPasswordError=true");
}

function login() {
    global $userName, $pass, $user;
    
    if (termsAndConditionsControl()) {
        $md5EncriptedPassword = md5($pass);
        $user = obtainUserFromDataBaseUsingHisUserNameAndPassword($userName, $md5EncriptedPassword);
        if (!userIsNull()) {
            session_start();
            $_SESSION["user"] = $user;
            return TRUE;
        }
        return FALSE;
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function userIsNull() {
    global $user;
    return $user == NULL;
}