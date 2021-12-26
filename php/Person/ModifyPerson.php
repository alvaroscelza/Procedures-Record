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
        $smartyVariables = getSmartyVariablesToAssign();
        tryToDisplaySmartyTemplate('ModifyPerson.tpl', $smartyVariables);
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function getSmartyVariablesToAssign() {
    if (termsAndConditionsControl()) {
        $userProfile = $_SESSION["user"]["Profile"];
        $PersonForModificationId = $_GET['PersonId'];
        $personData = obtainPersonFromDataBase($PersonForModificationId);
        $countries = obtainAllTableDataFromDataBase("Countries");
        $modificationOk = $_GET['modificationOk'];
        return array(
            'userProfile' => $userProfile,
            'countries' => $countries,
            'person' => $personData,
            'modificationOk' => $modificationOk
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
