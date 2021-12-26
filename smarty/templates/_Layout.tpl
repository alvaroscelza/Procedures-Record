<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

<head>
    <title>{block name=title}{/block} - Registro de Trámites</title>
    <meta charset="utf-8">
    <meta name="description" content="AARS - Registro de Trámites">
    <meta name="keywords" content="aars, alvaro, rodriguez, scelza, registro, tramites, direccion, nacional, migracion">
    <meta name="author" content="AARS - Alvaro Rodriguez Scelza">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Documentos de Diseño .css -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap_select/bootstrap-select.min.css" type="text/css">
    {block name=stylesheets}{/block}
</head>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="People.php">Registro de Trámites</a>
        </div>

        {if (isset($userProfile))}
            <ul class="nav navbar-nav">
                <li><a href="People.php">Personas</a></li>
            </ul>
            {if ($userProfile=="Administrador")}
                <ul class="nav navbar-nav">
                    <li><a href="Countries.php">Países</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="Users.php">Usuarios</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="AuditLog.php">Log de Auditoría</a></li>
                </ul>
            {/if}
            <ul class="nav navbar-nav">
                <li><a href="Help.php">Ayuda</a></li>
            </ul>
        {/if}

    </div>
</nav>

<div class="container">
    {block name=body}{/block}
    <hr/>
    <footer>
        <p>&copy; <script>document.write(new Date().getFullYear());</script> - Registro de Trámites</p>
    </footer>
</div>

<!-- JavaScript -->
<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/bootstrap_select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="scripts/remove-diacritics.js"></script>
<script type="text/javascript" src="scripts/General.js"></script>
{block name=javascprits}{/block}