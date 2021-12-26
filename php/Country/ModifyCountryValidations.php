<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$id = $_POST["id"];
$name = $_POST["name"];


if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && loggedUserProfileIsAdministrator()) {
        ModifyCountryInDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function ModifyCountryInDataBaseIfAllDataIsOk() {
    if (termsAndConditionsControl()) {
        if (allDataIsSet()) {
            standarifyName();
            registerCountryModificationInAuditLog();
            $asociativeArrayWithCountryData = setAsociativeArrayWithCountryData();
            modifyCountryInDataBase($asociativeArrayWithCountryData);
            header("location: ModifyCountry.php?modificationOk=true");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function allDataIsSet() {
    return idIsSet() && nameIsSet();
}

function idIsSet() {
    global $id;
    return $id != "";
}

function nameIsSet() {
    global $name;
    return $name != "";
}

function standarifyName() {
    global $name;
    $name = ucwords(strtolower($name));
}

function registerCountryModificationInAuditLog() {
    if (termsAndConditionsControl()) {
        global $name;
        $description = "Modificación de País: " . $name;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function setAsociativeArrayWithCountryData() {
    if (termsAndConditionsControl()) {
        global $id, $name;
        return array(
            'id' => $id,
            'name' => $name
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
