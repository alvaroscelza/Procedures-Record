<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Modificar Persona{/block}
{block name=body}
    <h2>Modificar</h2>

    <form class="form-horizontal" method="POST" action="ModifyPersonValidations.php">
        <fieldset>
            <legend>Persona</legend>

            <input name="id" hidden value="{$person.Id}">

            <div class="form-group">
                <label class="control-label col-md-2">Número de Expediente</label>
                <div class="col-md-4">
                    <input class="form-control" name="recordNumber_Number" type="number" placeholder="Número" max="9999" value="{$person.RecordNumber_Number}">
                    <input class="form-control" name="recordNumber_Year" type="number" placeholder="Año" max="9999" value="{$person.RecordNumber_Year}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Apellidos</label>
                <div class="col-md-4">
                    <input class="form-control" name="surnames" maxlength="40" value="{$person.Surnames}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Nombres</label>
                <div class="col-md-4">
                    <input class="form-control" name="names" maxlength="30" value="{$person.Names}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Nacionalidad</label>
                <select class="selectpicker col-md-4" name="nationality">
                    {foreach from=$countries item=country}
                        {if $country.Name == $person.Nationality}
                            <option value="{$country.Name}" selected>{$country.Name}</option>
                        {else}
                            <option value="{$country.Name}">{$country.Name}</option>
                        {/if}
                    {/foreach}
                </select> 
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Lugar de Nacimiento</label>
                <select class="selectpicker col-md-4" name="birthPlace">
                    {foreach from=$countries item=country}
                        {if $country.Name == $person.BirthPlace}
                            <option value="{$country.Name}" selected>{$country.Name}</option>
                        {else}
                            <option value="{$country.Name}">{$country.Name}</option>
                        {/if}
                    {/foreach}
                </select> 
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Fecha de Nacimiento</label>
                <div class="col-md-4">
                    <input class="form-control" name="birthDate" type="date" value="{$person.BirthDate}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Resolución Ministerial</label>
                <div class="col-md-4">
                    <input class="form-control" name="ministerialResolution" type="date" value="{$person.MinisterialResolution}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Número de Jaque</label>
                <div class="col-md-4">
                    <input class="form-control" name="checkNumber" type="number" maxlength="9999" value="{$person.CheckNumber}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Número de Rollo</label>
                <div class="col-md-4">
                    <input class="form-control" name="rollNumber" maxlength="40" value="{$person.RollNumber}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Guardar" class="btn btn-default"/>
                </div>
            </div>
        </fieldset>
    </form>

    <a href="People.php">Volver a la Lista</a>

    {if $modificationOk eq true}
        <script>alert("la persona fue modificada correctamente!");</script>                
    {/if}
{/block}
{block name=javascprits}

{/block}