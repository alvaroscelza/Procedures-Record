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
        attemptToRemoveCountryAndRedirectToCountriesPage();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function attemptToRemoveCountryAndRedirectToCountriesPage() {
    if (termsAndConditionsControl()) {
        try {
            $CountryForRemovalsId = $_GET['CountryId'];
            $country = obtainCountryFromDataBase($CountryForRemovalsId);
            registerCountryDeletionInAuditLog($country);
            removeCountryFromDataBase($CountryForRemovalsId);
            redirectToCountriesPage();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function registerCountryDeletionInAuditLog($country) {
    if (termsAndConditionsControl()) {
        $name = $country[Name];
        $description = "Baja de País: " . $name;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function redirectToCountriesPage() {
    header("location: Countries.php");
}
