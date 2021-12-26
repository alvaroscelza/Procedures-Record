<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Login{/block}
{block name=body}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Entrar</h2>
            <form method="POST" action="DoLogin.php">
                <div class="form-group">
                    <label>Usuario</label>
                    <input class="form-control" name="user" placeholder="Usuario" type="text" maxlength=25 size=25>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input class="form-control" name="pass" placeholder="Contraseña" type="password" maxlength=30 size=30>
                </div>
                <button type="submit" class="btn btn-default">Entrar</button>
            </form>
            {if $userAndOrPasswordError}
                <span>Usuario o Contraseña inválido.</span>
            {/if}
        </div>
    </div>
{/block}
{block name=javascprits}
    <script type="text/javascript" src="scripts/AuditLog.js"></script>
{/block}