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
        attemptToRemoveProcedureAndRedirectToProceduresPage();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function attemptToRemoveProcedureAndRedirectToProceduresPage() {
    if (termsAndConditionsControl()) {
        try {
            $procedureForRemovalId = $_GET['procedureId'];
            $procedurePersonId = $_GET['procedurePersonId'];
            $procedure = obtainProcedureFromDataBase($procedureForRemovalId);
            registerProcedureDeletionInAuditLog($procedure);
            removeProcedureFromDataBase($procedureForRemovalId);
            redirectToProceduresPage($procedurePersonId);
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function registerProcedureDeletionInAuditLog($procedure) {
    if (termsAndConditionsControl()) {
        $description = $procedure[Description];
        $action = "Baja de Trámite: " . $description;
        insertRecordIntoAuditLog($action);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function redirectToProceduresPage($procedurePersonId) {
    header("location: Procedures.php?personId=$procedurePersonId");
}
