<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Nuevo Trámite{/block}
{block name=body}
    <h2>Crear</h2>

    <form class="form-horizontal" method="POST" action="NewProcedureValidations.php">
        <fieldset>
            <legend>Trámite</legend>

            <input name="procedurePersonId" value="{$procedurePersonId}" hidden>

            <div class="form-group">
                <label class="control-label col-md-2">Fecha</label>
                <div class="col-md-4">
                    <input class="form-control" name="date" type="date">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Descripción</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Crear" class="btn btn-default"/>
                </div>
            </div>
        </fieldset>
    </form>

    <a href="Procedures.php?personId={$procedurePersonId}">Volver a la Lista</a>
    
    {if $creationAndInsertionOk eq true}
        <script>alert("El trámite fue creado correctamente!");</script>                
    {/if}
{/block}
{block name=javascprits}

{/block}