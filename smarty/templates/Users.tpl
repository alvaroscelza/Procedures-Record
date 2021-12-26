<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Usuarios{/block}
{block name=body}

    <h2>Usuarios</h2>
    <p>
        <a href="NewUser.php">Crear</a>
    </p>

    <table class="table">
        <tr> 
            <th>Nombre</th>
            <th>Perfil</th>
            <th></th>
        </tr> 
        {foreach from=$users item=user}
            <tr>
                <td>{$user.UserName}</td> 
                <td>{$user.Profile}</td>
                <td>
                    <a name="{$user.UserName}" class="removalLink" href="RemoveUser.php?userId={$user.Id}">Borrar</a> |
                    <a href="ModifyUser.php?userId={$user.Id}">Modificar</a>
                </td>
            </tr> 
        {/foreach}
    </table>
{/block}
{block name=javascprits}

{/block}