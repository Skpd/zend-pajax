<?php

class Zend_Controller_Action_Helper_PajaxContext extends Zend_Controller_Action_Helper_ContextSwitch
{

    protected $_contextKey = 'pajaxable';

    public function __construct()
    {
        parent::__construct();
        $this->addContext(
            'pjax',
            array(
                'callbacks' => array(
                    'init' => 'initPaxajContext',
                    'post' => 'postPajaxContext'
                )
            )
        );
    }

    public function initPaxajContext()
    {
        $layout = Zend_Controller_Action_HelperBroker::getStaticHelper('layout');
        $layout->disableLayout();

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setNoRender(true);
    }

    public function postPajaxContext()
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $view         = $viewRenderer->view;

        $this->getResponse()->setBody($view->render($viewRenderer->getViewScript()));
    }

    public function initContext()
    {
        $this->_currentContext = null;

        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getHeader('X-PJAX')) {
            parent::initContext('pjax');
        }
    }
}
