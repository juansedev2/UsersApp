<?php

// This class should validate the credentials of the client to try login
class Authenticator{

    /**
     * @param bool $alert_credentials is a flag to show a message in the view about that the credentials is incorrect
    */
    private static bool $alert_credentials = false;
    /**
     * @param bool $alert_credentials is a flag to show a message in the view about is necessary try login to use the app
    */
    private static bool $alert_session = false;
    private static bool $alert_unregistred = false;
    /**
     * @param bool $message_error is a dinamic string to show the error to the user in the login form if this fails on login
    */
    private static string $message_error = "";

    public static function returnCredentialsError() : void {
        self::$alert_credentials = true;
        self::$message_error = "Contraseña incorrecta, por favor validar";
    }
    public static function returnUnregistredUserError() : void {
        self::$alert_unregistred = true;
        self::$message_error = "El Usuario no existe en el sistema";
    }

    public static function returnSessionError() : void {
        self::$alert_session = true;
        self::$message_error = "Por favor iniciar sesión";
    }

    public static function returnMessageError() : string {
        self::resetAlerts();
        return self::$message_error;
    }

    private static function resetAlerts(): void{
        self::$alert_credentials = false;
        self::$alert_session = false;
        self::$alert_unregistred = true;
    }

    public static function validateErrors(): bool{
        return (self::$alert_credentials or self::$alert_session or self::$alert_unregistred);
    }

    

}