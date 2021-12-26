<?php

/*
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

require_once './GeneralFunctions.php';

/**
 * PRE: DataBase "ProceduresRecord" exists, in chosed servidor localhost, with user "root"
 */
function get_conexion() {
    try {
        return new PDO(
                'mysql:host=localhost;dbname=ProceduresRecord', 'root'
        );
    } catch (Exception $e) {
        showCatchedExceptionTraceAndMessage($e);
    }
}

/*
 * PRE: Must Exist a dataTable with name: $tableName in DB
 */

function obtainAllTableDataFromDataBase($tableName) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM $tableName");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithPersonData must contain all person data except Id, in any order but with the following
 * names:
 * [RecordNumber_Number, RecordNumber_Year, Surnames, Names, BirthDate, MinisterialResolution, 
 * CheckNumber, RollNumber, Nationality, BirthPlace]
 */

function insertPersonIntoDataBase($asociativeArrayWithPersonData) {
    try {
        $query = get_conexion()->prepare("INSERT INTO People ("
                . "RecordNumber_Number, RecordNumber_Year, Surnames, Names, BirthDate, "
                . "MinisterialResolution, CheckNumber, RollNumber, Nationality, BirthPlace)"
                . " VALUES (:num, :year, :surn, :names, :birthDate, :min, :check, :roll, :nation, :birthPlace)");
        $query->bindParam('num', $asociativeArrayWithPersonData["RecordNumber_Number"], PDO::PARAM_INT);
        $query->bindParam('year', $asociativeArrayWithPersonData["RecordNumber_Year"], PDO::PARAM_INT);
        $query->bindParam('surn', $asociativeArrayWithPersonData["Surnames"], PDO::PARAM_STR);
        $query->bindParam('names', $asociativeArrayWithPersonData["Names"], PDO::PARAM_STR);
        $query->bindParam('birthDate', $asociativeArrayWithPersonData["BirthDate"], PDO::PARAM_STR);
        $query->bindParam('min', $asociativeArrayWithPersonData["MinisterialResolution"], PDO::PARAM_STR);
        $query->bindParam('check', $asociativeArrayWithPersonData["CheckNumber"], PDO::PARAM_INT);
        $query->bindParam('roll', $asociativeArrayWithPersonData["RollNumber"], PDO::PARAM_STR);
        $query->bindParam('nation', $asociativeArrayWithPersonData["Nationality"], PDO::PARAM_STR);
        $query->bindParam('birthPlace', $asociativeArrayWithPersonData["BirthPlace"], PDO::PARAM_STR);
        $query->execute();
    } catch (Exception $e) {
        showCatchedExceptionTraceAndMessage($e);
    }
}

function removePersonFromDataBase($personId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("DELETE FROM People WHERE Id = :personId");
            $query->bindParam('personId', $personId, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainPersonFromDataBase($personId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM People WHERE Id = :personId");
            $query->bindParam('personId', $personId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithPersonData must contain all person data in any order but with the following names:
 * [Id, RecordNumber_Number, RecordNumber_Year, Surnames, Names, BirthDate, MinisterialResolution, 
 * CheckNumber, RollNumber, Nationality, BirthPlace]
 */

function modifyPersonInDataBase($asociativeArrayWithPersonData) {
    try {
        $query = get_conexion()->prepare("UPDATE People SET "
                . "RecordNumber_Number = :num, "
                . "RecordNumber_Year = :year, "
                . "Surnames = :surn, "
                . "Names = :names, "
                . "BirthDate = :birthDate, "
                . "MinisterialResolution = :min, "
                . "CheckNumber = :check, "
                . "RollNumber = :roll, "
                . "Nationality = :nation, "
                . "BirthPlace = :birthPlace "
                . "WHERE Id = :personId");
        $query->bindParam('num', $asociativeArrayWithPersonData["RecordNumber_Number"], PDO::PARAM_INT);
        $query->bindParam('year', $asociativeArrayWithPersonData["RecordNumber_Year"], PDO::PARAM_INT);
        $query->bindParam('surn', $asociativeArrayWithPersonData["Surnames"], PDO::PARAM_STR);
        $query->bindParam('names', $asociativeArrayWithPersonData["Names"], PDO::PARAM_STR);
        $query->bindParam('birthDate', $asociativeArrayWithPersonData["BirthDate"], PDO::PARAM_STR);
        $query->bindParam('min', $asociativeArrayWithPersonData["MinisterialResolution"], PDO::PARAM_STR);
        $query->bindParam('check', $asociativeArrayWithPersonData["CheckNumber"], PDO::PARAM_INT);
        $query->bindParam('roll', $asociativeArrayWithPersonData["RollNumber"], PDO::PARAM_STR);
        $query->bindParam('nation', $asociativeArrayWithPersonData["Nationality"], PDO::PARAM_STR);
        $query->bindParam('birthPlace', $asociativeArrayWithPersonData["BirthPlace"], PDO::PARAM_STR);
        $query->bindParam('personId', $asociativeArrayWithPersonData["Id"], PDO::PARAM_INT);
        $query->execute();
    } catch (Exception $e) {
        showCatchedExceptionTraceAndMessage($e);
    }
}

function obtainAllProceduresFromPerson($personId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Procedures WHERE Id_Person = :id");
            $query->bindParam('id', $personId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function removeProcedureFromDataBase($procedureId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("DELETE FROM Procedures WHERE Id = :procedureId");
            $query->bindParam('procedureId', $procedureId, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithProcedureData must contain all procedure data except Id, in any order but with the following
 * names:
 * [date, description, procedurePersonId]
 */

function insertProcedureIntoDataBase($asociativeArrayWithProcedureData) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("INSERT INTO Procedures (Date, Description, Id_Person) VALUES (:date, :descr, :pers)");
            $query->bindParam('date', $asociativeArrayWithProcedureData["date"], PDO::PARAM_STR);
            $query->bindParam('descr', $asociativeArrayWithProcedureData["description"], PDO::PARAM_STR);
            $query->bindParam('pers', $asociativeArrayWithProcedureData["procedurePersonId"], PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainProcedureFromDataBase($procedureId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Procedures WHERE Id = :procedureId");
            $query->bindParam('procedureId', $procedureId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithPersonData must contain all procedure data in any order but with the following names:
 * [id, date, description]
 */

function modifyProcedureInDataBase($asociativeArrayWithProcedureData) {
    try {
        $query = get_conexion()->prepare("UPDATE Procedures SET "
                . "Date = :date, "
                . "Description = :desc "
                . "WHERE Id = :id");
        $query->bindParam('date', $asociativeArrayWithProcedureData["date"], PDO::PARAM_STR);
        $query->bindParam('desc', $asociativeArrayWithProcedureData["description"], PDO::PARAM_STR);
        $query->bindParam('id', $asociativeArrayWithProcedureData["id"], PDO::PARAM_INT);
        $query->execute();
    } catch (Exception $e) {
        showCatchedExceptionTraceAndMessage($e);
    }
}

function removeAllProceduresFromPerson($personId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("DELETE FROM Procedures WHERE Id_Person = :id");
            $query->bindParam('id', $personId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithCountryData must contain all country data except Id, in any order but with the following
 * names:
 * [name]
 */

function insertCountryIntoDataBase($asociativeArrayWithCountryData) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("INSERT INTO Countries (Name) VALUES (:name)");
            $query->bindParam('name', $asociativeArrayWithCountryData["name"], PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function removeCountryFromDataBase($countryId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("DELETE FROM Countries WHERE Id = :countryId");
            $query->bindParam('countryId', $countryId, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainCountryFromDataBase($countryId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Countries WHERE Id = :countryId");
            $query->bindParam('countryId', $countryId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithCountryData must contain all country data in any order but with the following
 * names:
 * [id, name]
 */

function modifyCountryInDataBase($asociativeArrayWithCountryData) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("UPDATE Countries SET Name = :name WHERE Id = :id");
            $query->bindParam('name', $asociativeArrayWithCountryData["name"], PDO::PARAM_STR);
            $query->bindParam('id', $asociativeArrayWithCountryData["id"], PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithUserData must contain all user data except Id, in any order but with the following
 * names:
 * [userName, profile, password]
 */

function insertUserIntoDataBase($asociativeArrayWithUserData) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("INSERT INTO Users (UserName, Password, Profile) VALUES (:userName, :pass, :profile)");
            $query->bindParam('userName', $asociativeArrayWithUserData["userName"], PDO::PARAM_STR);
            $query->bindParam('pass', $asociativeArrayWithUserData["password"], PDO::PARAM_STR);
            $query->bindParam('profile', $asociativeArrayWithUserData["profile"], PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function removeUserFromDataBase($userId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("DELETE FROM Users WHERE Id = :userId");
            $query->bindParam('userId', $userId, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainUserFromDataBase($userId) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Users WHERE Id = :userId");
            $query->bindParam('userId', $userId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainUserFromDataBaseUsingHisUserName($userName) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Users WHERE UserName = :userName");
            $query->bindParam('userName', $userName, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

/*
 * PRE: $asociativeArrayWithUserData must contain all user data in any order but with the following
 * names:
 * [id, userName, profile, password]
 */

function modifyUserInDataBase($asociativeArrayWithUserData) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("UPDATE Users SET UserName = :userName, Password = :pass, Profile = :profile WHERE Id = :id");
            $query->bindParam('userName', $asociativeArrayWithUserData["userName"], PDO::PARAM_STR);
            $query->bindParam('pass', $asociativeArrayWithUserData["password"], PDO::PARAM_STR);
            $query->bindParam('profile', $asociativeArrayWithUserData["profile"], PDO::PARAM_STR);
            $query->bindParam('id', $asociativeArrayWithUserData["id"], PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function obtainUserFromDataBaseUsingHisUserNameAndPassword($userName, $password) {
    if (termsAndConditionsControl()) {
        try {
            $query = get_conexion()->prepare("SELECT * FROM Users WHERE UserName = :userName AND Password = :pass");
            $query->bindParam('userName', $userName, PDO::PARAM_INT);
            $query->bindParam('pass', $password, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            showCatchedExceptionTraceAndMessage($e);
        }
    } else {
        showTermsAndConditionsControlFailureMessage();
    }
}

function insertRecordIntoAuditLog($description) {
    try {
        $userName = getLoggedUserName();
        $todaysDate = getCurrentDateAsString();
        $currentTime = getCurrentTimeAsString();
        $query = get_conexion()->
                prepare("INSERT INTO AuditLog_Records "
                . "(UserName, Description, Date, Hour) "
                . "VALUES (:userName, :descr, :date, :hour)");
        $query->bindParam('userName', $userName, PDO::PARAM_STR);
        $query->bindParam('descr', $description, PDO::PARAM_STR);
        $query->bindParam('date', $todaysDate, PDO::PARAM_STR);
        $query->bindParam('hour', $currentTime, PDO::PARAM_STR);
        $query->execute();
    } catch (Exception $e) {
        showCatchedExceptionTraceAndMessage($e);
    }
}
