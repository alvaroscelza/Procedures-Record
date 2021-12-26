<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$procedurePersonId = $_POST["procedurePersonId"];
$date = $_POST["date"];
$description = $_POST["description"];

if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && !loggedUserProfileIsBasic()) {
        createAndInsertNewProcedureIntoDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function createAndInsertNewProcedureIntoDataBaseIfAllDataIsOk() {
    if (termsAndConditionsControl()) {
        global $procedurePersonId;
        if (allDataIsSet()) {
            registerProcedureCreationInAuditLog();
            $asociativeArrayWithProcedureData = setAsociativeArrayWithProcedureData();
            insertProcedureIntoDataBase($asociativeArrayWithProcedureData);
            header("location: NewProcedure.php?creationAndInsertionOk=true&procedurePersonId=$procedurePersonId");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function allDataIsSet() {
    return procedurePersonIdIsSet() && dateIsSet() && descriptionIsSet();
}

function procedurePersonIdIsSet() {
    global $procedurePersonId;
    return $procedurePersonId != "";
}

function dateIsSet() {
    global $date;
    return $date != "";
}

function descriptionIsSet() {
    global $description;
    return $description != "";
}

function registerProcedureCreationInAuditLog() {
    global $description;
    $action = "Alta de Trámite: " . $description;
    insertRecordIntoAuditLog($action);
}

function setAsociativeArrayWithProcedureData() {
    if (termsAndConditionsControl()) {
        global $date, $description, $procedurePersonId;
        return array(
            'procedurePersonId' => $procedurePersonId,
            'date' => $date,
            'description' => $description
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
