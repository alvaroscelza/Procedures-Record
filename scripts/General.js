/* 
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

$(".removalLink").click(askForRemovalConfirmation);

function askForRemovalConfirmation() {
    $entityForRemoval = $(this).prop("name");
    return confirm("Por favor, confirme la eliminación de '" + $entityForRemoval + "'.");
}

function obtainJqueryObjectWithAllTableBodyRows() {
    return $("#tableBody").find("tr");
}

function prepareInputValueForSearchingWithoutSplitting(inputValue) {
    var inputValueInLowerCase = inputValue.toLowerCase();
    var inputValueInLowerCaseWithoutDiacritics = removeDiacritics(inputValueInLowerCase);
    return inputValueInLowerCaseWithoutDiacritics;
}

function prepareInputValueForSearching(inputValue) {
    var inputValueInLowerCaseWithoutDiacritics = prepareInputValueForSearchingWithoutSplitting(inputValue);
    var inputValueInLowerCaseWithoutDiacriticsSeparatedByBlankSpaces = inputValueInLowerCaseWithoutDiacritics.split(" ");
    return inputValueInLowerCaseWithoutDiacriticsSeparatedByBlankSpaces;
}

function prepareColumnsText(necessaryColumns) {
    var columnsText = $(necessaryColumns).text();
    var columnsTextInLowerCase = columnsText.toLowerCase();
    var columnsTextInLowerCaseWithoutDiacritics = removeDiacritics(columnsTextInLowerCase);
    return columnsTextInLowerCaseWithoutDiacritics;
}

function preparedColumnTextValueContainsCurrentValueWord(preparedColumnTextValue, currentValueWord) {
    return preparedColumnTextValue.indexOf(currentValueWord) > -1;
}