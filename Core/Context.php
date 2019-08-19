<?php


namespace Core;


class Context
{
    private static $_instance;
    /** @var Request */
    private $_request;
    /** @var Dispacher */
    private $_dispacher;
    /** @var Db */
    private $_db;

    private $testContext;

    /**
     * @return mixed
     */
    public function getTestContext()
    {
        return $this->testContext;
    }

    /**
     * @param mixed $testContext
     */
    public function setTestContext($testContext)
    {
        $this->testContext = $testContext;
    }

    private function __construct()
    {

    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function i()
    {
        if(!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        return self::$_instance;
    }

    /**
     * @param mixed $instance
     */
    public static function setInstance($instance): void
    {
        self::$_instance = $instance;
    }


    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->_request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->_request = $request;
    }

    /**
     * @return Dispacher
     */
    public function getDispacher(): Dispacher
    {
        return $this->_dispacher;
    }

    /**
     * @param Dispacher $dispacher
     */
    public function setDispacher(Dispacher $dispacher): void
    {
        $this->_dispacher = $dispacher;
    }

    /**
     * @return Db
     */
    public function getDb(): Db
    {
        return $this->_db;
    }

    /**
     * @param Db $db
     */
    public function setDb(Db $db): void
    {
        $this->_db = $db;
    }



}