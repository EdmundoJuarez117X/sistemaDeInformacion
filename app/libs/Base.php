<?php

class Base
{

    private $host = HOST;
    private $dbname = DBNAME;
    private $user = USER;
    private $password = PASSWORD;
    private $driver = DRIVER;

    protected $cnx;
    protected $stmt;
    protected $error;
    protected $dbh;
    protected $options;


    public function __construct()
    {
        $this->dbh = $this->driver . ':host=' . $this->host . ';dbname=' . $this->dbname;
        $this->options = [
            PDO::ATTR_ERRMODE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->cnx = new PDO($this->dbh , $this->user, $this->password, $this->options);
            $this->cnx->exec('set names utf8');
            echo 'conectado';
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($query)
    {
        
    }

    public function bind($params, $value, $type=null)
    {
        
    }

    public function execute()
    {
        
    }

    public function register()
    {
        
    }

    public function registers()
    {
        
    }

    public function countRows()
    {
        
    }
}