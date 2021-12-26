<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Log de Auditoría{/block}
{block name=body}
    <h2>Log de Auditoría</h2>

    <label>Filtrar por Usuario</label>
    <input id="inputUserName" maxlength="25">

    <label>Filtrar por Fecha</label>
    <input id="inputDate" type="date">
    
    <br><br>

    <table class="table"> 
        <tr> 
            <th>Usuario</th> 
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr> 
        <tbody id="tableBody">
            {foreach from=$aduditLogRecords item=record}
                <tr>
                    <td>{$record.UserName}</td> 
                    <td>{$record.Description}</td>
                    <td>{$record.Date}</td>
                    <td>{$record.Hour}</td>
                </tr> 
            {/foreach}
        </tbody>
    </table>
{/block}
{block name=javascprits}
    <script type="text/javascript" src="scripts/AuditLog.js"></script>
{/block}