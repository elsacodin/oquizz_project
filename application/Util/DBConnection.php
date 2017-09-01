<?php

namespace OQuiz\Util;
use \PDO;

class DBConnection
{
    private static $instance = NULL;

    public static function getInstance()
	{
        if (!isset(self::$instance)) {
            $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
            self::$instance = new PDO($dsn, DB_USER, DB_PASS);
            self::$instance->exec("set names utf8");
        }

        return self::$instance;
    }
}
