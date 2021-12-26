<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Modificar Trámite{/block}
{block name=body}
    <h2>Modificar</h2>

    <form class="form-horizontal" method="POST" action="ModifyProcedureValidations.php">
        <fieldset>
            <legend>Trámite</legend>

            <input name="id" hidden value="{$procedure.Id}">
            <input name="procedurePersonId" value="{$procedurePersonId}" hidden>

            <div class="form-group">
                <label class="control-label col-md-2">Fecha</label>
                <div class="col-md-4">
                    <input class="form-control" name="date" type="date" value="{$procedure.Date}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Descripción</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="description">{$procedure.Description}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Guardar" class="btn btn-default"/>
                </div>
            </div>
        </fieldset>
    </form>

    <a href="Procedures.php?personId={$procedurePersonId}">Volver a la Lista</a>

    {if $modificationOk eq true}
        <script>alert("El trámite fue modificado correctamente!");</script>                
    {/if}
{/block}
{block name=javascprits}

{/block}