<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && loggedUserProfileIsAdministrator()) {
        attemptToRemoveUserAndRedirectToUsersPage();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function attemptToRemoveUserAndRedirectToUsersPage() {
    if (termsAndConditionsControl()) {
        try {
            $userForRemovalId = $_GET['userId'];
            $user = obtainUserFromDataBase($userForRemovalId);
            registerUserDeletionInAuditLog($user);
            removeUserFromDataBase($userForRemovalId);
            redirectToUsersPage();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function registerUserDeletionInAuditLog($user) {
    if (termsAndConditionsControl()) {
        $userName = $user[UserName];
        $description = "Baja de Usuario: " . $userName;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function redirectToUsersPage() {
    header("location: Users.php");
}
