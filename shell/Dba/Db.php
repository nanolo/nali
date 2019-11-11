<?php


namespace Nanolo\Dba;


class Db
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new Connection();
    }

    public function query($sql, $data = [], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

}