/* 
 * Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
 * A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
 * https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
 */

var SELECT_TUTORIAL_OPTION_DEFAULT_VALUE = "tutorials";
var TUTORIAL_MARGIN_LEFT = "margin-left-percentage-15";
var ABOUT_MARGIN_LEFT = "margin-left-percentage-23";

$("#selectTutorialOrAbout").change(showHelpTextAreaBasedOnSelectOptionAndRealignSelect);

function showHelpTextAreaBasedOnSelectOptionAndRealignSelect() {
    if (tutorialIsSelected()) {
        showTutorialAndHideAbout();
        alignSelectToTutorial();
    }
    else {
        showAboutAndHideTutorial();
        alignSelectToAbout();
    }
}

function tutorialIsSelected() {
    return $("#selectTutorialOrAbout").val() === SELECT_TUTORIAL_OPTION_DEFAULT_VALUE;
}

function showTutorialAndHideAbout() {
    $("#helpTextAreaTutorial").show();
    $("#helpTextAreaAbout").hide();
}

function alignSelectToTutorial() {
    $("#selectTutorialOrAbout").removeClass(ABOUT_MARGIN_LEFT);
    $("#selectTutorialOrAbout").addClass(TUTORIAL_MARGIN_LEFT);
}

function showAboutAndHideTutorial() {
    $("#helpTextAreaAbout").show();
    $("#helpTextAreaTutorial").hide();
}

function alignSelectToAbout() {
    $("#selectTutorialOrAbout").removeClass(TUTORIAL_MARGIN_LEFT);
    $("#selectTutorialOrAbout").addClass(ABOUT_MARGIN_LEFT);
}