<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$userName = $_POST["userName"];
$pass = $_POST["pass"];
$profile = $_POST["profile"];
$allDataIsCorrect = true;


if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && loggedUserProfileIsAdministrator()) {
        createAndInsertNewUserIntoDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function createAndInsertNewUserIntoDataBaseIfAllDataIsOk() {
    global $allDataIsCorrect;
    if (termsAndConditionsControl()) {
        cheackAllData();
        if ($allDataIsCorrect) {
            registerUserCreationInAuditLog();
            encryptPassword();
            $asociativeArrayWithUserData = setAsociativeArrayWithUserData();
            insertUserIntoDataBase($asociativeArrayWithUserData);
            header("location: NewUser.php?creationAndInsertionOk=true");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function cheackAllData() {
    userNameIsSet();
    passwordIsSet();
    passwordIsSixToTenCharacters();
    profileIsSet();
}

function userNameIsSet() {
    global $userName, $allDataIsCorrect;
    if ($userName == "") {
        $allDataIsCorrect = false;
    }
}

function passwordIsSet() {
    global $pass, $allDataIsCorrect;
    if ($pass == "") {
        $allDataIsCorrect = false;
    }
}

function passwordIsSixToTenCharacters() {
    global $pass, $allDataIsCorrect;
    $passSize = strlen($pass);
    if ($passSize < 6 || $passSize > 10) {
        $allDataIsCorrect = false;
    }
}

function profileIsSet() {
    global $profile, $allDataIsCorrect;
    if ($profile == "") {
        $allDataIsCorrect = false;
    }
}

function registerUserCreationInAuditLog() {
    if (termsAndConditionsControl()) {
        global $userName;
        $description = "Alta de Usuario: " . $userName;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function encryptPassword() {
    global $pass;
    $pass = md5($pass);
}

function setAsociativeArrayWithUserData() {
    if (termsAndConditionsControl()) {
        global $userName, $profile, $pass;

        return array(
            'userName' => $userName,
            'password' => $pass,
            'profile' => $profile
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
