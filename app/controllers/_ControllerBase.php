<?php

use Phalcon\Mvc\Controller;

class _ControllerBase extends Controller
{
    protected function initialize() 
    {
        
    }

    protected function _constructExceptionMessage(\Exception $e)
    {
        $msg = get_class($e) . ': ' . $e->getMessage() . "\n" . 
                'File=' . $e->getFile() . "\n" . 
                'Line=' . $e->getLine() . "\n" . 
                $e->getTraceAsString() . "\n";

        $this->_renderErrorPage($msg);

        return $msg;
    }

    protected function _renderErrorPage($msg)
    {
        $this->response->setStatusCode(500, "Error")->sendHeaders();
        $this->view->errorMsg = $msg;
        $this->view->stacktrace = $this->config->stacktrace;
        echo $this->app['view']->render('500');
    }
}