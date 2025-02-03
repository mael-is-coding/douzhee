<?php

final class ConnexionSingleton {

    private static ?PDO $connectionInstance = null;

    public static function getInstance(): ?PDO {
        if (self::$connectionInstance === null) {
            try {
                self::$connectionInstance = new PDO("mysql:host=localhost;dbname=bddouzheetest", "root", "");
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
        }
        return self::$connectionInstance;
    }
}