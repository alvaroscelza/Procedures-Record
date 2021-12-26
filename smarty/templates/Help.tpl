<!DOCTYPE html>
<!--
Copyright 2015 Ayudante de Ingeniero en Sistemas Alvaro Rodriguez Scelza
A menos que se indique lo contrario. Ver terminos y condiciones en la siguiente URL:
https://www.binpress.com/license/view/l/a598eab68adc6e88537eeedea685b59c
-->

{extends file="_Layout.tpl"}
{block name=title}Ayuda{/block}
{block name=body}
    <h2>Ayuda</h2>

    <div>
        <select id="selectTutorialOrAbout" class="selectpicker">
            <option value="tutorials">Tutoriales</option>
            <option value="About">Acerca De</option>
        </select> 
    </div>
    
    <br>

    <div id="helpTextAreaTutorial" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tutoriales</h3>
        </div>
        <div class="panel-body">
            <p>
                <strong>Personas:</strong> <br>
                En la Ventana Personas se puede crear nuevas personas, modificar o eliminar existentes y <br>
                acceder a sus trámites. Cada persona tiene: <br>
                -Nombres y apellidos. <br>
                -Un número de expediente compuesto por número y año. <br>
                -Una nacionalidad y un lugar de nacimiento, elegidos de una lista desplegable de países. <br>
                -Una fecha de nacimiento y fecha de resolución Ministerial, ambas elegibles de un calendario visual. <br>
                -Un número de jaque. <br>
                -un número de rollo. <br>
                <br>
                Al acceder a los trámites de la persona, se puede crear nuevos trámites para esa persona, modificar <br>
                o eliminar existentes. cada trámite tiene una fecha y una descripción. <br>
                <br>
                Todos los usuarios pueden visualizar personas y sus trámites pero sólo usuarios Avanzados o Administradores <br>
                pueden crear, modificar y eliminar cualquiera de ellos. <br>
            </p>
            <br>
            <p>
                <strong>Países:</strong> <br>
                En la Ventana Países se puede crear nuevos países, modificar o eliminar existentes, <br>
                cada país tiene un nombre que debe ser único (de lo contrario el sistema <br>
                no lo aceptará). <br>
                <br>
                Sólo usuarios Administradores pueden acceder a esta opción. <br>
            </p>
            <br>
            <p>
                <strong>Usuarios:</strong> <br>
                En la Ventana Usuarios se puede crear nuevos usuarios, modificar o eliminar existentes, <br>
                cada usuario tiene un nombre de usuario que debe ser único (de lo contrario el sistema <br>
                no lo aceptará), y un perfil de usuario, elegido de una lista desplegable, las opciones para <br>
                estos son: <br>
                -Básico: Sólo puede realizar consultas sobre Personas y sus Trámites, pero no <br>
                puede modificar, crear o eliminar nada. <br>
                -Avanzado: Crea, modifica y elimina Personas y Trámites. <br>
                -Administrador: Tiene acceso a todas las funcionalidades del Sistema. <br>
                <br>
                Sólo usuarios Administradores pueden acceder a esta opción. <br>
            </p>
        </div>
    </div>

    <div id="helpTextAreaAbout" class="panel panel-default" hidden>
        <div class="panel-heading">
            <h3 class="panel-title">Acerca De</h3>
        </div>
        <div class="panel-body">
            <p class="text-center">
                Versión 1.2 Beta    
            </p>
            <p class="text-center">
                Estudiante de Tercer Año de Ingeniería en Sistemas, Universidad ORT <br>
                Ayudante de Ingeniero <strong>Alvaro Andrés Rodríguez Scelza</strong> <br>
                Agente de Dirección Nacional de Migración <br>
                Departamento de Informática
            </p>
            
            <br>
            
            <p>
                Track de Versionado <br>
                <br>
                Versión 1.2 Beta: <br>
                -Se añade Pie de página. <br>
                -Se corrige que al modificar el nombre de un País, se modifique dicho nombre <br>
                en todas las Personas que lo tienen como Foreign Key. <br>
                -Se corrige que aparezca el nav bar al modificar un País. <br>
                -Se corrige que aparezca el nav bar al modificar o crear un Usuario. <br>
                -Se crea un nuevo mensaje de error para controlar errores imprevistos. <br>
                -Se agregan algunas mejores en seguridad. <br>
                <br>
                Versión 1.1 Beta: <br>
                -Eliminada funcionalidad de autenticación automática. <br>
                -Implementación de Autenticación con usuario y contraseña. <br>
                -Mejora de display de Número de Expediente de persona en Página Personas. <br>
                -Instalación Bootstrap v3.3.6. <br>
                -Actualización a Smarty v3. <br>
                -Implementación de herencia en templates utilizando Smarty v3. <br>
                -Refactoring de templates de Smarty: Generalización de código común a _Layout. <br>
                -Implementación de Track de Versionado. <br>
                -Implementación de diseño en base a bootstrap v3.3.6. <br>
                -Se eliminan los archivos de diseño utilizados hasta ahora. <br>
                -Se eliminan MainPage.php junto a su .tpl. Ahora la página principal es la tabla de personas. <br>
                <br>
                Versión 1.0 Beta: <br>
                -Core de funcionalidad solicitada para Registro de Trámites terminada. <br>
                -Se comienzan pruebas del sistema. <br>
            </p>
        </div>
    </div>
{/block}
{block name=javascprits}
    <script type="text/javascript" src="scripts/Help.js"></script>
{/block}
