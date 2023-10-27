<?php
require_once(ROOT_PATH .'/datebase.php');   // datebase.phpに接続情報（データベースのホスト名、mySqlのユーザ名、パスワード、データベース名）を記述

class Db{
    protected $dbh;

    public function __construct($dbh = null){
        if(!$dbh){// 接続情報が存在しない場合
            try{
                $this->dbh = new PDO('mysql:dbname='.DB_NAME.
                                     ';host='.DB_HOST,DB_USER,DB_PASSWD);
            // 接続成功
            } catch (PDOException $e){
                echo "接続失敗：".$e->getMessage()."\n";
                exit();
            }
        } else {
            $this->dbh = $dbh;
        }
    }

    public function get_db_handler(){
        return $this->dbh;
    }
}