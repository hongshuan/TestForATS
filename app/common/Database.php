<?php

namespace Common;

class Database // extends PDO
{
    protected $config;
    protected $connection = false;
    protected $logger;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        if ($this->connection) {
            return $this->connection;
        }

        $host     = $this->config->get('database.host');
        $username = $this->config->get('database.user');
        $password = $this->config->get('database.pass');
        $dbname   = $this->config->get('database.dbname');

        $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $db = new \PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $username, $password, $options);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->connection = $db;
        } catch (PDOException $e) {
            echo "Failed to connect to database server";
            exit();
        }

        return $this->connection;
    }

    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

	public function query($sql)
	{
        #if ($this->logger) {
        #    $this->logger->write($sql);
        #}

        $this->connect();

		$stmt = $this->connection->query($sql);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function exec($sql)
	{
        #if ($this->logger) {
        #    $this->logger->write($sql);
        #}

        $this->connect();
		return $this->connection->exec($sql);
	}

	public function quote($string)
	{
        $this->connect();
		return $this->connection->quote($string);
	}

    public function lastInsertId()
    {
        $this->connect();
        return $this->connection->lastInsertId();
    }
}
