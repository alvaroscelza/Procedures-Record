<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Trámites{/block}
{block name=body}

    <h2>Trámites</h2>
    {if ($userProfile!="Básico")}
        <p>
            <a href="NewProcedure.php?procedurePersonId={$personId}">Crear</a>
        </p>
    {/if}

    <table class="table"> 
        <tr> 
            <th class="col-md-2">Fecha</th> 
            <th class="col-md-8">Descripción</th>
            {if ($userProfile!="Básico")}
                <th class="col-md-2"></th>
            {/if}
        </tr> 
        {foreach from=$proceduresForSelectedPerson item=procedure}
            <tr>
                <td>{$procedure.Date}</td> 
                <td>{$procedure.Description}</td>
                {if ($userProfile!="Básico")}
                    <td>
                        <a name="{$procedure.Date} {$procedure.Description}" class="removalLink" href="RemoveProcedure.php?procedureId={$procedure.Id}&procedurePersonId={$personId}">Borrar</a> |
                        <a href="ModifyProcedure.php?procedureId={$procedure.Id}&procedurePersonId={$personId}">Modificar</a>
                    </td>
                {/if}    
            </tr> 
        {/foreach}
    </table>
{/block}
{block name=javascprits}

{/block}