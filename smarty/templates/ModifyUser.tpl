<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Modificar Usuario{/block}
{block name=body}
    <h2>Modificar</h2>

    <form class="form-horizontal" method="POST" action="ModifyUserValidations.php">
        <fieldset>
            <legend>Usuario</legend>

            <input class="width-180-px" name="id" hidden value="{$user.Id}">

            <div class="form-group">
                <label class="control-label col-md-2">Nombre de Usuario</label>
                <div class="col-md-4">
                    <input class="form-control" name="userName" maxlength="25" value="{$user.UserName}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Contraseña</label>
                <div class="col-md-4">
                    <input class="form-control" name="pass" maxlength="10">
                    <span>Entre 6 y 10 dígitos.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Perfil</label>
                <select class="col-md-4 selectpicker" name="profile">
                    {foreach from=$profiles item=profile}
                        {if $profile.Name == $user.Profile}
                            <option value="{$profile.Name}" selected>{$profile.Name}</option>
                        {else}
                            <option value="{$profile.Name}">{$profile.Name}</option>
                        {/if}
                    {/foreach}
                </select> 
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Guardar" class="btn btn-default"/>
                </div>
            </div>
        </fieldset>
    </form>

    <a href="Users.php">Volver a la Lista</a>

    {if $modificationOk eq true}
        <script>alert("El Usuario fue modificado correctamente!");</script>                
    {/if}
{/block}
{block name=javascprits}

{/block}