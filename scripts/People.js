/* 
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

var CONFIRMATION_FOR_PERSON_REMOVAL = true;
var DENEGATION_FOR_PERSON_REMOVAL = false;
var selectSearchOption;
var inputSearcherValue;
var jqueryObjectWithTheRows;
var preparedInputValue;
var personToBeRemovedId;
var personToBeRemovedName;
var personsProcedures;
var currentRow;

$("#inputSearcher").keyup(filterRows);
$(".peopleRemovalLink").click(removePersonAndHisProceduresIfUserConfirms);

function filterRows() {
    obtainInputAndSelectValues();
    jqueryObjectWithTheRows = obtainJqueryObjectWithAllTableBodyRows();
    if (inputIsEmpty()) {
        jqueryObjectWithTheRows.show();
    }
    else {
        filterBasedOnInputAndSelectValues();
    }
}

function obtainInputAndSelectValues() {
    selectSearchOption = $("#selectSearcher").val();
    inputSearcherValue = $("#inputSearcher").val();
}

function inputIsEmpty() {
    return inputSearcherValue === "";
}

function filterBasedOnInputAndSelectValues() {
    preparedInputValue = prepareInputValueForSearching(inputSearcherValue);
    jqueryObjectWithTheRows.hide();
    var filteredRows = filterJqueryObjectWithTheRowsUsingJqueryForeach_filter();
    filteredRows.show();
}

function filterJqueryObjectWithTheRowsUsingJqueryForeach_filter() {
    return jqueryObjectWithTheRows.filter(function (rowIndex, currentRowBeingFiltered) {
        currentRow = currentRowBeingFiltered;
        var hasAllWords = true;
        for (var i = 0; i < preparedInputValue.length; ++i) {
            var currentValueWord = preparedInputValue[i];
            var valueMatches = currentWordExistsInCurrentRowValueInSelectedOption(currentValueWord);
            if (!valueMatches) {
                hasAllWords = false;
            }
        }
        return hasAllWords;
    });
}

function currentWordExistsInCurrentRowValueInSelectedOption(currentValueWord) {
    var currentRowColums = $(currentRow).find("td");
    var necessaryColumns = selectColumnsBasedOnSelectedOption(currentRowColums);
    var preparedPersonValue = prepareColumnsText(necessaryColumns);
    return preparedColumnTextValueContainsCurrentValueWord(preparedPersonValue, currentValueWord);
}

function selectColumnsBasedOnSelectedOption(currentRowColums) {
    switch (selectSearchOption) {
        case ("namesAndSurnames"):
            var firstAndSecondColumns = currentRowColums.slice(0, 2);
            return firstAndSecondColumns;
        case ("recordNumber"):
            var thirdColumn = currentRowColums.slice(2, 3);
            return thirdColumn;
        case ("recordDate"):
            var fourthColumn = currentRowColums.slice(3, 4);
            return fourthColumn;
        case ("birthDate"):
            var seventhColumn = currentRowColums.slice(6, 7);
            return seventhColumn;
        case ("nationality"):
            var fifthColumn = currentRowColums.slice(4, 5);
            return fifthColumn;
    }
}

function removePersonAndHisProceduresIfUserConfirms() {
    personToBeRemovedId = $(this).prop("id");
    personToBeRemovedName = $(this).prop("name");
    var userConfirms = warnAboutPersonProceduresRemovalAndRemoveThemifUserConfirms();
    if (userConfirms) {
        removePersonsProceduresWithAjax();
        return CONFIRMATION_FOR_PERSON_REMOVAL;
    }
    return DENEGATION_FOR_PERSON_REMOVAL;
}

function warnAboutPersonProceduresRemovalAndRemoveThemifUserConfirms() {
    obtainPersonProceduresWithAjax();
    if (personHasProcedures()) {
        return confirm("Atención! La persona que va a eliminar tiene trámites a \n\
su nombre, si la elimina, sus trámites también se eliminarán! ¿Confirma?");
    }
    else {
        return confirm("Por favor, confirme la eliminación de '" + personToBeRemovedName + "'.");
    }
}

function obtainPersonProceduresWithAjax() {
    $.ajax({
        async: false,
        url: 'People_ObtainPersonProcedures_Ajax.php?personToBeRemovedId=' + personToBeRemovedId,
        dataType: 'json'
    })
            .done(loadPersonProceduresFromAjax);
}

function loadPersonProceduresFromAjax(data) {
    personsProcedures = data.personProcedures;
}

function personHasProcedures() {
    return personsProcedures.length > 0;
}

function removePersonsProceduresWithAjax() {
    $.ajax({
        url: 'People_RemovePersonsProcedures_Ajax.php?personToBeRemovedId=' + personToBeRemovedId,
        dataType: 'json'
    });
}