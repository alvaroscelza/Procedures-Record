<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Personas{/block}
{block name=body}

    <h2>Personas</h2>
    {if ($userProfile!="Básico")}
        <p>
            <a href="NewPerson.php">Crear</a>
        </p>
    {/if}

    <div>
        <select id="selectSearcher" class="selectpicker">
            <option value="namesAndSurnames">Nombres y Apellidos</option>
            <option value="recordNumber">Número de Expediente</option>
            <option value="recordDate">Año de Expediente</option>
            <option value="birthDate">Fecha de Nacimiento</option>
            <option value="nationality">Nacionalidad</option>
        </select> 
        <input id="inputSearcher" maxlength="70" size="80" placeholder="Buscar">
    </div>

    <br>

    <table class="table">
        <tr>
            <th class="col-md-1">Nombres</th> 
            <th class="col-md-1">Apellidos</th>
            <th class="col-md-1">Número de Expediente</th>
            <th class="col-md-1">Año de Expediente</th>
            <th class="col-md-1">Nacionalidad</th>
            <th class="col-md-1">Lugar de Nacimiento</th>
            <th class="col-md-1">Fecha de Nacimiento</th>
            <th class="col-md-1">Resolución Ministerial</th>
            <th class="col-md-1">Número de jaque</th>
            <th class="col-md-1">Número de Rollo</th>
            <th class="col-md-2"></th>
        </tr>
        <tbody id="tableBody">
            {foreach from=$people item=person}
                <tr>
                    <td>{$person.Names}</td> 
                    <td>{$person.Surnames}</td>
                    <td>{$person.RecordNumber_Number}</td>
                    <td>{$person.RecordNumber_Year}</td>
                    <td>{$person.Nationality}</td>
                    <td>{$person.BirthPlace}</td>
                    <td>{$person.BirthDate}</td>
                    <td>{$person.MinisterialResolution}</td>
                    <td>{$person.CheckNumber}</td>
                    <td>{$person.RollNumber}</td>
                    <td>
                        <a href="Procedures.php?personId={$person.Id}">Trámites</a>
                        {if ($userProfile!="Básico")}
                            |
                            <a id="{$person.Id}" name="{$person.Names} {$person.Surnames}" class="peopleRemovalLink" href="RemovePerson.php?PersonId={$person.Id}">Borrar</a> |
                            <a href="ModifyPerson.php?PersonId={$person.Id}">Modificar</a>
                        {/if}
                    </td>
                </tr> 
            {/foreach}
        </tbody>
    </table>

{/block}
{block name=javascprits}
    <script type="text/javascript" src="scripts/People.js"></script>
{/block}
