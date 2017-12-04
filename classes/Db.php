<?php
/**
 * Created by PhpStorm.
 * User: mihai.budurescu
 * Date: 11/12/2017
 * Time: 12:04 PM
 */
class Db
{
    private $connection;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $content = file("C:\wamp64\www\proiect2\config_file.txt");
        foreach ($content as $line) {
            if (preg_match('/^dbname/', $line)) {
                $dbname = trim(substr($line, 1 + strpos($line,"=")));
            }
            if (preg_match('/^username/', $line)) {
                $username = trim(substr($line, 1 + strpos($line,"=")));
            }
            if (preg_match('/^password/', $line)) {
                $password = trim(substr($line, 1 + strpos($line,"=")));
            }
        }
        $this->connection = new PDO("mysql:host=localhost;dbname=$dbname", "$username", "$password");
    }

    /**
     * function to make changes in database, depending of the sql operation kind
     * @param $query
     * @return array|int
     */
    function query($query)
    {
        if (preg_match('/^select/i', $query))
        {
            if (!empty($this)) {
                return $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        elseif (preg_match('/^(?i)(update)/',$query) || preg_match('/^(?i)(insert)/',$query)
            || preg_match('/^(?i)(delete)/',$query))
        {
            return $this->connection->exec($query);
        }
    }

    /**
     * public method to obtain the result of predefined function lastInsertId() for the PDO private property
     * @return string
     */
    function getLastInsertID()
    {
        return $this->connection->lastInsertId();
    }
}

