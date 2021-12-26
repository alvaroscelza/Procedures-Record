<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once '../../Config.php';
require_once(ROOT_DIR.GENERAL_FUNCTIONS_DIR);
require_once(ROOT_DIR.DB_CONNECTOR_DIR);

if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && loggedUserProfileIsAdministrator()) {
        $smartyVariables = getSmartyVariablesToAssign();
        tryToDisplaySmartyTemplate('AuditLog.tpl', $smartyVariables);
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function getSmartyVariablesToAssign() {
    if (termsAndConditionsControl()) {
        $userProfile = $_SESSION['user'][Profile];
        $aduditLogRecords = obtainAllTableDataFromDataBase("AuditLog_Records");
        return array(
            'userProfile' => $userProfile,
            'aduditLogRecords' => $aduditLogRecords
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
