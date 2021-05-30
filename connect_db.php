<?php
    class Database {

      private static $host = "localhost";
      private static $dbname = "banque";
      private static $user = "root";
      private static $password = "";
      private static $connection = null;

      public static function connect () {
        try {
          self::$connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";", self::$user, self::$password);
        } catch(PDOException $e)  {
          die($e->getMessage());
        }
        return self::$connection;
      }

      public static function disconnect() {
        self::$connection = null;
        return self::$connection;
      }

    }
?>