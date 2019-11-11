<?php


namespace Nanolo\Dba;


class Connection extends \PDO
{
    public function __construct()
    {

        $config = include CONFIG;
        $dsn = $config['db']['driver'] . ':host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'] . ';charset=' . $config['db']['charset'] . ';';
        parent::__construct($dsn, $config['db']['user'], $config['db']['password']);


        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $this->setAttribute(\PDO::ATTR_STATEMENT_CLASS, [Statement::class]);

    }
    
}