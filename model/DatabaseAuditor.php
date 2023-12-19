<?php
class Database
{
    private static $dbName = 'db_pankey';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $conexion = null;

    public function __construct()
    {
        exit('No se permite instanciar esta clase. Solo se usan sus métodos estáticamente.');
    }
    /**
     * Metodo estatico que crea una conexion a la base de datos.
     * @return type
     */
    public static function connect()
    {
        // Una sola conexion para toda la aplicacion (singleton):
        if (self::$conexion == null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbUserPassword
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conexion;
    }
    /**
     * Metodo estatico para desconexion de la bdd.
     */
    public static function disconnect()
    {
        self::$conexion = null;
    }
}
