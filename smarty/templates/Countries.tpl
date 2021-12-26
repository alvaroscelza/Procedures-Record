<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Países{/block}
{block name=body}

    <h2>Países</h2>
    <p>
        <a href="NewCountry.php">Crear</a>
    </p>

    <table class="table"> 
        <tr> 
            <th>Nombre</th> 
            <th></th>
        </tr> 
        {foreach from=$countries item=country}
            <tr>
                <td>{$country.Name}</td>
                <td>
                    <a name="{$country.Name}" class="removalLink" href="RemoveCountry.php?CountryId={$country.Id}">Borrar</a> |
                    <a href="ModifyCountry.php?CountryId={$country.Id}">Modificar</a>
                </td>
            </tr> 
        {/foreach}
    </table>
{/block}
{block name=javascprits}{/block}