<?php

// This class should validate the credentials of the client to try login
class Authenticator{

    /**
     * @param bool $alert_credentials is a flag to show a message in the view about that the credentials is incorrect
    */
    public static bool $alert_credentials = false;
    /**
     * @param bool $alert_credentials is a flag to show a message in the view about is necessary try login to use the app
    */
    public static bool $alert_session = true;

    // TODO: IMPLEMENTAR DEMÁS VALIDACIONES DE REQUERIR CREDENCIALES, MENSAJE EN VISTA Y EN GENERAL TERMINAR CON EL AUTHENTICATOR E INICIOS DEL SESSION CONTROLLER

}