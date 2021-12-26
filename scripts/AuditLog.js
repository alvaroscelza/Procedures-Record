/* 
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

var DEFAULT_USER_COLUMN = 0;
var DEFAULT_DATE_COLUMN = 2;

var inputUserName;
var inputDate;
var jqueryObjectWithTheRows;
var preparedInputUserNameValue;
var preparedInputDateValue;
var currentRow;

$("#inputUserName").keyup(filterRowsByUserNameAndDate);
$("#inputDate").change(filterRowsByUserNameAndDate);

function filterRowsByUserNameAndDate() {
    obtainInputValues();
    jqueryObjectWithTheRows = obtainJqueryObjectWithAllTableBodyRows();
    if (inputsAreEmpty()) {
        jqueryObjectWithTheRows.show();
    }
    else {
        filterBasedOnInputs();
    }
}

function obtainInputValues() {
    inputUserName = $("#inputUserName").val();
    inputDate = $("#inputDate").val();
}

function inputsAreEmpty() {
    return inputUserName === "" && inputDate === "";
}

function filterBasedOnInputs() {
    preparedInputUserNameValue = prepareInputValueForSearchingWithoutSplitting(inputUserName);
    preparedInputDateValue = prepareInputValueForSearchingWithoutSplitting(inputDate);
    jqueryObjectWithTheRows.hide();
    var filteredRows = filterJqueryObjectWithTheRowsUsingJqueryForeach_filter();
    filteredRows.show();
}

function filterJqueryObjectWithTheRowsUsingJqueryForeach_filter() {
    return jqueryObjectWithTheRows.filter(function (rowIndex, currentRowBeignFiltered) {
        currentRow = currentRowBeignFiltered;
        var userNameMatches = true;
        var dateMatches = true;
        if (inputUserNameIsNotEmpty()) {
            userNameMatches = false;
            var valueMatches = valueExistsInCurrentRowOnColumnNumber(preparedInputUserNameValue, DEFAULT_USER_COLUMN);
            if (valueMatches)
                userNameMatches = true;
        }
        if (inputDateIsNotEmpty()) {
            dateMatches = false;
            var valueMatches = valueExistsInCurrentRowOnColumnNumber(preparedInputDateValue, DEFAULT_DATE_COLUMN);
            if (valueMatches)
                dateMatches = true;
        }
        if (userNameMatches && dateMatches)
            return true;
        return false;
    });
}

function inputUserNameIsNotEmpty(){
    return preparedInputUserNameValue !== "";
}

function valueExistsInCurrentRowOnColumnNumber(valueWord, columnNumber) {
    var currentRowColums = $(currentRow).find("td");
    var necessaryColumns = currentRowColums[columnNumber];
    var preparedColumnTextValue = prepareColumnsText(necessaryColumns);
    return preparedColumnTextValueContainsCurrentValueWord(preparedColumnTextValue, valueWord);
}

function inputDateIsNotEmpty(){
    return preparedInputDateValue !== "";
}