<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Nuevo País{/block}
{block name=body}
    <h2>Crear</h2>

    <form class="form-horizontal" method="POST" action="NewCountryValidations.php">
        <fieldset>
            <legend>País</legend>

            <div class="form-group">
                <label class="control-label col-md-2">Nombre</label>
                <div class="col-md-4">
                    <input class="form-control" name="name" maxlength="25">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Crear" class="btn btn-default"/>
                </div>
            </div>
        </fieldset>
    </form>
    
    <a href="Countries.php">Volver a la Lista</a>

    {if $creationAndInsertionOk eq true}
        <script>alert("El País fue creado correctamente!");</script>                
    {/if}
{/block}
{block name=javascprits}

{/block}