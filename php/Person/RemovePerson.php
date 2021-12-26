<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && !loggedUserProfileIsBasic()) {
        attemptToRemovePersonAndRedirectToPeoplePage();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function attemptToRemovePersonAndRedirectToPeoplePage() {
    if (termsAndConditionsControl()) {
        try {
            $PersonForRemovalsId = $_GET['PersonId'];
            $person = obtainPersonFromDataBase($PersonForRemovalsId);
            registerPersonDeletionInAuditLog($person);
            removePersonFromDataBase($PersonForRemovalsId);
            redirectToPeoplePage($PersonForRemovalsId);
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function registerPersonDeletionInAuditLog($person) {
    if (termsAndConditionsControl()) {
        $names = $person[Names];
        $surnames = $person[Surnames];
        $description = "Baja de Persona: " . $names . " " . $surnames;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function redirectToPeoplePage() {
    header("location: People.php");
}
