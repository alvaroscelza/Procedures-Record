<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';
require_once './DBConnector.php';


$id = $_POST["id"];
$recordNumber_Number = $_POST["recordNumber_Number"];
$recordNumber_Year = $_POST["recordNumber_Year"];
$surnames = $_POST["surnames"];
$names = $_POST["names"];
$nationality = $_POST["nationality"];
$birthPlace = $_POST["birthPlace"];
$birthDate = $_POST["birthDate"];
$ministerialResolution = $_POST["ministerialResolution"];
$checkNumber = $_POST["checkNumber"];
$rollNumber = $_POST["rollNumber"];

if (termsAndConditionsControl()) {
    if (userIsLoggedIn() && !loggedUserProfileIsBasic()) {
        ModifyPersonInDataBaseIfAllDataIsOk();
    } else {
        header("location: ./Index.php");
    }
} else {
    showTermsAndConditionsControlFailureMessage();
}

function ModifyPersonInDataBaseIfAllDataIsOk() {
    if (termsAndConditionsControl()) {
        if (allDataIsSet()) {
            standarifyNamesAndSurnames();
            registerPersonModificationInAuditLog();
            $asociativeArrayWithPersonData = setAsociativeArrayWithPersonData();
            modifyPersonInDataBase($asociativeArrayWithPersonData);
            header("location: ModifyPerson.php?modificationOk=true");
        } else {
            echo 'Información incorrecta o campos vacíos.';
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function allDataIsSet() {
    return idIsSet() && recordNumber_NumberIsSet() && recordNumber_YearIsSet() && surnamesIsSet() && namesIsSet() && nationalityIsSet() && birthPlaceIsSet() && birthDateIsSet() && ministerialResolutionIsSet() && checkNumberIsSet() && rollNumberIsSet();
}

function idIsSet() {
    global $id;
    return $id != "";
}

function recordNumber_NumberIsSet() {
    global $recordNumber_Number;
    return $recordNumber_Number != "";
}

function recordNumber_YearIsSet() {
    global $recordNumber_Year;
    return $recordNumber_Year != "";
}

function surnamesIsSet() {
    global $surnames;
    return $surnames != "";
}

function namesIsSet() {
    global $names;
    return $names != "";
}

function nationalityIsSet() {
    global $nationality;
    return $nationality != "";
}

function birthPlaceIsSet() {
    global $birthPlace;
    return $birthPlace != "";
}

function birthDateIsSet() {
    global $birthDate;
    return $birthDate != "";
}

function ministerialResolutionIsSet() {
    global $ministerialResolution;
    return $ministerialResolution != "";
}

function checkNumberIsSet() {
    global $checkNumber;
    return $checkNumber != "";
}

function rollNumberIsSet() {
    global $rollNumber;
    return $rollNumber != "";
}

function standarifyNamesAndSurnames(){
    global $surnames, $names;
    $surnames = ucwords(strtolower($surnames));
    $names = ucwords(strtolower($names));
}

function registerPersonModificationInAuditLog() {
    if (termsAndConditionsControl()) {
        global $names, $surnames;
        $description = "Modificación de Persona: " . $names . " " . $surnames;
        insertRecordIntoAuditLog($description);
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function setAsociativeArrayWithPersonData() {
    global $id, $recordNumber_Number, $recordNumber_Year, $surnames, $names,
    $nationality, $birthPlace, $birthDate, $ministerialResolution,
    $checkNumber, $rollNumber;
    return array(
        'Id' => $id,
        'RecordNumber_Number' => $recordNumber_Number,
        'RecordNumber_Year' => $recordNumber_Year,
        'Surnames' => $surnames,
        'Names' => $names,
        'Nationality' => $nationality,
        'BirthPlace' => $birthPlace,
        'BirthDate' => $birthDate,
        'MinisterialResolution' => $ministerialResolution,
        'CheckNumber' => $checkNumber,
        'RollNumber' => $rollNumber
    );
}
