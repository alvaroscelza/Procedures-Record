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
        $smartyVariables = getSmartyVariablesToAssign();
        tryToDisplaySmartyTemplate('ModifyUser.tpl', $smartyVariables);
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function getSmartyVariablesToAssign() {
    if (termsAndConditionsControl()) {
        $userProfile = $_SESSION['user'][Profile];
        $profiles = obtainAllTableDataFromDataBase("Profiles");
        $UserForModificationId = $_GET['userId'];
        $userData = obtainUserFromDataBase($UserForModificationId);
        $modificationOk = $_GET['modificationOk'];
        return array(
            'userProfile' => $userProfile,
            'profiles' => $profiles,
            'user' => $userData,
            'modificationOk' => $modificationOk
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}