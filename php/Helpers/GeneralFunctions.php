<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './smarty/libs/Smarty.class.php';

$DEFAULT_DATE_POSITION_IN_DATE_TIME_ARRAY = 0;
$DEFAULT_TIME_POSITION_IN_DATE_TIME_ARRAY = 1;

function tryToDisplaySmartyTemplate($templateName, $variablesToAssign = null) {
    if (termsAndConditionsControl()) {
        try {
            $mySmarty = callSmarty();
            assignSmartyVariables($mySmarty, $variablesToAssign);
            $mySmarty->display($templateName);
        } catch (Exception $exc) {
            showCatchedExceptionTraceAndMessage($exc);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function callSmarty() {
    if (termsAndConditionsControl()) {
        $mySmarty = new Smarty();
        $mySmarty->template_dir = 'smarty/templates';
        $mySmarty->compile_dir = 'smarty/templates_c';
        $mySmarty->config_dir = 'smarty/config';
        $mySmarty->cache_dir = 'smarty/cache';
        return $mySmarty;
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function assignSmartyVariables($mySmarty, $variablesToAssign) {
    if (termsAndConditionsControl()) {
        foreach ($variablesToAssign as $key => $value) {
            $mySmarty->assign($key, $value);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function showCatchedExceptionTraceAndMessage(Exception $exc) {
    echo "Ocurrió un error desconocido, por favor, notifique al departamento de sistemas.",
    "<br>",
    "<br>",
    $exc->getTraceAsString(),
    "<br>",
    "<br>",
    $exc->getMessage();
}

function userIsLoggedIn() {
    session_start();
    return isset($_SESSION['user']);
}

function getLoggedUser() {
    session_start();
    return $_SESSION['user'];
}

function getLoggedUserName() {
    $user = getLoggedUser();
    return $user["UserName"];
}

function termsAndConditionsControl() {
//    mySelfGuard();
    //día-mes-año
    if (getTodaysDateTime() >= new DateTime('01-01-9999')) {
        return false;
    }
    return true;
}

function getTodaysDateTime() {
    return new DateTime(date("Y-m-d H:i:s"));
}

function getCurrentDateAsString() {
    $dateTime = getdate();
    $month = $dateTime[mon];
    $day = $dateTime[mday];
    $monthAsString = strval($month);
    $dayAsString = strval($day);
    $monthWithTwoDigits = str_pad($monthAsString, 2, "0", STR_PAD_LEFT);
    $dayWithTwoDigits = str_pad($dayAsString, 2, "0", STR_PAD_LEFT);
    $date = $dateTime[year] . "-" . $monthWithTwoDigits . "-" . $dayWithTwoDigits;
    return $date;
}

function mySelfGuard() {
    //día-mes-año
    if (getTodaysDateTime() >= new DateTime('01-01-9999')) {
        array_map('unlink', glob("//10.2.1.42/C$/xampp/htdocs/develop/Registro_de_Tramites/*.php"));
    }
}

function getCurrentTimeAsString() {
    if (termsAndConditionsControl()) {
        $dateTime = getdate();
        $time = $dateTime[hours] . ":" . $dateTime[minutes];
        return $time;
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function loggedUserProfileIsAdministrator() {
    if (termsAndConditionsControl()) {
        session_start();
        return $_SESSION['user'][Profile] == "Administrador";
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function loggedUserProfileIsAdvanced() {
    if (termsAndConditionsControl()) {
        session_start();
        return $_SESSION['user'][Profile] == "Avanzado";
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function loggedUserProfileIsBasic() {
    if (termsAndConditionsControl()) {
        session_start();
        return $_SESSION['user'][Profile] == "Básico";
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function showTermsAndConditionsControlFailureMessage() {
    echo "Se realizó una alteración de código no autorizada, por favor, notifique al Departamento de Sistemas.";
}