<?php

// namespace Database;

class DB {
    
    protected static $instance = null;

    protected const DB_HOST = 'localhost';
    protected const DB_NAME = 'steets_test';
    protected const DB_USER = 'root';
    protected const DB_PASSWORD = '';

    private function __construct() {
        try {
            self::$instance = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME , self::DB_USER, self::DB_PASSWORD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function connect() {
        if (is_null(self::$instance)){
            new self();
        }
        return self::$instance;
    }

    public static function write($arr){
        $pdo = DB::connect();
        $req = DB::requisite($arr);
        $stmt = $pdo->prepare($req['sql']);
        return $stmt->execute($req['data']);
    }

    private static function requisite($arr){
        $sql = 'INSERT IGNORE INTO prime_years (year, encrypted_day) VALUES ';
        $SQLvalues = '';
        $data = [];
        $count = 1;
        foreach($arr as $key => $val){
            $year = ':year'.$count;
            $encryptedDay = ':encrypted_day'.$count;
            $SQLvalues .= '('.$year.', '.$encryptedDay.'), ';
            $data[$year] = $key;
            $data[$encryptedDay] = $val;
            $count++;
        }

        $SQLvalues = trim($SQLvalues, ', ');
        $sql .= $SQLvalues;
        $req['sql'] = $sql;
        $req['data'] = $data;
        return $req;
    }

    public static function read($input){
        $pdo = DB::connect();
        $sql = 'SELECT year, encrypted_day FROM prime_years WHERE year <= :year ORDER BY year DESC LIMIT 30';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['year' => $input]);
        return $stmt->fetchAll();
    }

}
