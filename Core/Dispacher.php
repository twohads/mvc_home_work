<?php


namespace Core;


class Dispacher
{
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_ACTION = 'index';

    private $_controllerName = '';
    private $_actionToken = '';

    protected function getRoutes()
    {
        return [
            'Login' => [
                'index' => 'User.login'
            ],
            'Registr' => [
                'index' => 'User.registr'
            ]
        ];
    }

    public function dispacher()
    {
        $request = Context::i()->getRequest();
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();

        if(!$controllerName || !$this->check($controllerName)){
            $this->_controllerName = self::DEFAULT_CONTROLLER;
        }else{
            $this->_controllerName = ucfirst(strtolower($controllerName));
        }

        if(!$actionName || !$this->check($actionName)){
            $this->_actionToken = self::DEFAULT_ACTION;
        }else{
            $this->_actionToken = strtolower($actionName);
        }

        $routes = $this->getRoutes();
        if(isset($routes[$this->_controllerName]) && isset($routes[$this->_controllerName][$this->_actionToken])){
            list($this->_controllerName, $this->_actionToken) = explode('.', $routes[$this->_controllerName][$this->_actionToken]);
        }
    }

    private function check(string $key)
    {
        return preg_match('/[a-zA-Z0-9]+/', $key);
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
        return $this->_actionToken . 'Action';
    }

    public function getActionToken()
    {
        return $this->_actionToken;
    }


}

