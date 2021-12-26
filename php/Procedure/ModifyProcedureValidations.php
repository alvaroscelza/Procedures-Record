<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$id = $_POST["id"];
$procedurePersonId = $_POST["procedurePersonId"];
$date = $_POST["date"];
$description = $_POST["description"];

if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && !loggedUserProfileIsBasic()) {
        ModifyProcedureInDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function ModifyProcedureInDataBaseIfAllDataIsOk() {
    if (termsAndConditionsControl()) {
        global $procedurePersonId;
        if (allDataIsSet()) {
            registerProcedureModificationInAuditLog();
            $asociativeArrayWithProcedureData = setAsociativeArrayWithProcedureData();
            modifyProcedureInDataBase($asociativeArrayWithProcedureData);
            header("location: ModifyProcedure.php?modificationOk=true&procedurePersonId=$procedurePersonId");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function allDataIsSet() {
    return idIsSet() && dateIsSet() && descriptionIsSet();
}

function idIsSet() {
    global $id;
    return $id != "";
}

function dateIsSet() {
    global $date;
    return $date != "";
}

function descriptionIsSet() {
    global $description;
    return $description != "";
}

function registerProcedureModificationInAuditLog() {
    if (termsAndConditionsControl()) {
        global $description;
        $action = "Modificación de Trámite: " . $description;
        insertRecordIntoAuditLog($action);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function setAsociativeArrayWithProcedureData() {
    if (termsAndConditionsControl()) {
        global $id, $date, $description;
        return array(
            'id' => $id,
            'date' => $date,
            'description' => $description
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
