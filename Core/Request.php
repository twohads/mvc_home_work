<?php


namespace Core;


class Request
{
    private $_controllerName = '';
    private $_actionName;

    public function __construct()
    {
        $partsUri = explode("/", $_SERVER['REQUEST_URI']);
        $this->_controllerName = $partsUri[1] ?? '';
        $this->_actionName = $partsUri[2] ?? '';
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->_controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->_actionName;
    }
    
}