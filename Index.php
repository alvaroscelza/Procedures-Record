<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './Config.php';
require_once(ROOT_DIR.GENERAL_FUNCTIONS_DIR);

Main();

function Main() {
    if (termsAndConditionsControl()) {
        try {
            clearAllSessionInfo();
            $smartyVariables = getSmartyVariablesToAssign();
            tryToDisplaySmartyTemplate('Index.tpl', $smartyVariables);
        } catch (Exception $exc) {
            showCatchedExceptionTraceAndMessage($exc);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function clearAllSessionInfo() {
    if (termsAndConditionsControl()) {
        session_start();
        session_unset();
        session_destroy();
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function getSmartyVariablesToAssign() {
    if (termsAndConditionsControl()) {
        $userAndOrPasswordError = $_GET['userAndOrPasswordError'];
        return array(
            'userAndOrPasswordError' => $userAndOrPasswordError
        );
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}
