<?php


namespace Core;

use App\Models\Database;
use App\Controller\Users;
use Core\Exception\Error404;

class Application
{
    /** @var Context */
    private $_context;

    protected function init()
    {
        $this->_context = Context::i();
        $request = new Request();
        $dispacher = new Dispacher();
        $db = new Db();

        $this->_context->setRequest($request);
        $this->_context->setDispacher($dispacher);
        $this->_context->setDb($db);
    }

    public function run()
    {
        try {
            $this->init();
            $this->_context->getDispacher()->dispacher();
            $dispather = $this->_context->getDispacher();

            $controllerFileName = 'App\Controller\\' . $dispather->getControllerName();
            if (!class_exists($controllerFileName)) {
                throw new Error404('Класс ' . $controllerFileName . 'не найден');
            }
            /** @var Controller $controllerObj */
            $controllerObj = new $controllerFileName();
            //$controllerObj->preAction();
            $actionFuncName = $dispather->getActionName();

            if (!method_exists($controllerObj, $actionFuncName)) {
                throw new Error404('Метод ' . $actionFuncName . ' не найден');
            }

            $tpl = '../App/Templates/' . $dispather->getControllerName() . '/' . $dispather->getActionToken() . '.phtml';

            $view123 = new View();
            $controllerObj->view = $view123;
            $controllerObj->$actionFuncName();
            if($controllerObj->needRender()){
                $html = $view123->render($tpl);
                echo $html;
            }

        }catch (Error404 $e){
            header('HTTP/1.0 404 Not Found');
            trigger_error($e->getMessage());
        }
    }

}