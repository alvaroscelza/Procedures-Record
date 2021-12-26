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
        tryToDisplaySmartyTemplate('ModifyProcedure.tpl', $smartyVariables);
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function getSmartyVariablesToAssign() {
    if (termsAndConditionsControl()) {
        $userProfile = $_SESSION['user'][Profile];
        $procedureForModificationId = $_GET['procedureId'];
        $procedureData = obtainProcedureFromDataBase($procedureForModificationId);
        $procedurePersonId = $_GET['procedurePersonId'];
        $modificationOk = $_GET['modificationOk'];
        return array(
            'userProfile' => $userProfile,
            'procedure' => $procedureData,
            'procedurePersonId' => $procedurePersonId,
            'modificationOk' => $modificationOk
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
