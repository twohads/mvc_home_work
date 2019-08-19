<?php


namespace Core;


class Db
{
    /** @var PDO */
    private $pdo;


    private $log = [];

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }


    private function getConection()
    {
        if (!$this->pdo) {
            $this->pdo = new \PDO('mysql:host=localhost;dbname=formvs', 'root', '');
        }
        return $this->pdo;
    }

    public function fetchAll(string $query, $method, array $params = [])
    {
        $timeQuery = microtime(1);

        $pdo = $this->getConection();
        $prepared = $pdo->prepare($query);
        $result = $prepared->execute($params);

        if (!$result) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(1) - $timeQuery, $method, $affectedRows];

        return $data;
    }

    public function fetchOne(string $query, $method, array $params = [])
    {
        $timeQuery = microtime(1);
        $pdo = $this->getConection();
        $prepared = $pdo->prepare($query);
        $result = $prepared->execute($params);
        if (!$result) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }
        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(1) - $timeQuery, $method, $affectedRows];

        if (!$data) {
            return false;
        }
        return reset($data);

    }

    public function exec(string $query, $method, array $params = [])
    {
        $timeQuery = microtime(1);
        $pdo = $this->getConection();
        $prepared = $pdo->prepare($query);
        $result = $prepared->execute($params);
        if (!$result) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return -1;
        }
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(1) - $timeQuery, $method, $affectedRows];

    }

    public function lastUnsertId()
    {
        return $this->getConection()->lastInsertId();
    }

    public function getLogHTML()
    {
        if (!$this->log) {
            return "";
        }

        $res = '';
        foreach ($this->log as $elem) {
            $res = $elem[1] . ': ' . $elem[0] . '(' . $elem[3] .')' . '[' . $elem[3] .']' . '\n' ;
        }
        return '<pre>' . $res . '</pre>';
    }
}