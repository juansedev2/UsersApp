<?php

// This class should validate the credentials of the client to try login
class Authenticator{

    /**
     *$alert_credentials is a flag to show a message in the view about that the credentials is incorrect
    */
    private static bool $alert_credentials = false;
    /**
     *$alert_session is a flag to show a message in the view about is necessary try login to use the app
    */
    private static bool $alert_session = false;
    /**
     *$alert_unregistred is a flag to show a message in the view about the user doesn't exists
    */
    private static bool $alert_unregistred = false;
    /**
     *$message_error is a dinamic string to show the error to the user in the login form if this fails on login
    */
    private static string $message_error = "";

    /**
     * This function program the message about incorrect credentials error to show in the login view
    */
    public static function returnCredentialsError() : void {
        self::$alert_credentials = true;
        self::$message_error = "Contraseña incorrecta, por favor validar";
    }
    /**
     * This function program the message about unregistred user error to show in the login view
    */
    public static function returnUnregistredUserError() : void {
        self::$alert_unregistred = true;
        self::$message_error = "El Usuario no existe en el sistema";
    }
    /**
     * This function program the message session error to show in the login view
    */
    public static function returnSessionError() : void {
        self::$alert_session = true;
        self::$message_error = "Por favor iniciar sesión";
    }

    /**
     * This function call the reset the values of the alerts and return the error message to give to the view and it should only be used in views
     * @return string returns the error message to show in the view
    */
    public static function returnErrorMesssage() : string {
        self::resetAlerts();
        return self::$message_error;
    }

    /**
     * This function reset the values of the alerts
    */
    private static function resetAlerts(): void{
        self::$alert_credentials = false;
        self::$alert_session = false;
        self::$alert_unregistred = true;
    }

    /**
     * This function validate if exists any alert to show in the view
     * @return bool true if any alert is ready to show, false in otherwise
    */
    public static function validateErrors(): bool{
        return (self::$alert_credentials or self::$alert_session or self::$alert_unregistred);
    }

    

}