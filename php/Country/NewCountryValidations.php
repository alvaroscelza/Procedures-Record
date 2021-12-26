<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$name = $_POST["name"];

if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && loggedUserProfileIsAdministrator()) {
        createAndInsertNewCountryIntoDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function createAndInsertNewCountryIntoDataBaseIfAllDataIsOk() {
    if (termsAndConditionsControl()) {
        if (allDataIsSet()) {
            standarifyName();
            registerCountryCreationInAuditLog();
            $asociativeArrayWithCountryData = setAsociativeArrayWithCountryData();
            insertCountryIntoDataBase($asociativeArrayWithCountryData);
            header("location: NewCountry.php?creationAndInsertionOk=true");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function allDataIsSet() {
    return nameIsSet();
}

function nameIsSet() {
    global $name;
    return $name != "";
}

function standarifyName() {
    global $name;
    $name = ucwords(strtolower($name));
}

function registerCountryCreationInAuditLog() {
    if (termsAndConditionsControl()) {
        global $name;
        $description = "Alta de País: " . $name;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function setAsociativeArrayWithCountryData() {
    if (termsAndConditionsControl()) {
        global $name;
        return array(
            'name' => $name
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
