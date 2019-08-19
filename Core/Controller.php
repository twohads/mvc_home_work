<?php


namespace Core;


class Controller
{
    /**@var View*/
    public $view;
    /** @var bool */
    protected $render = true;

    public function preAction()
    {

    }

    /**
     * @return bool
     */
    public function needRender(): bool
    {
        return $this->render;
    }
}