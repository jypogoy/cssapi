<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\Indicator;

class IndicatorController extends _ControllerBase
{

    public function all()
    {
        try {
            $indicator = Indicator::find(
                [
                    'order' =>  'id'
                ]
            );

            $data = [];

            foreach ($indicator as $indicator) {
                $data[] = $indicator;
            }
            
            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));    
        }
    }

    public function search($keyword)
    {
        try {
            $indicator = Indicator::find(
                [
                    'conditions'    =>  'indicator LIKE \'%' . $keyword . '%\'',
                    'order'         =>  'id'
                ]
            );

            $data = [];

            foreach ($indicator as $indicator) {
                $data[] = $indicator;
            }

            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function get($id) 
    {
        try {
            $indicator = Indicator::findFirst(
                [
                    'conditions'    =>  'id = ' . $id
                ]
            );   

            $response = new Response();
            if ($indicator === false) {
                $response->setJsonContent(
                    [
                        'status' => 'NOT-FOUND'
                    ]
                );
            } else {
                $response->setJsonContent(
                    [
                        'status' => 'FOUND',
                        'data'   => $indicator
                    ]
                );
            }

            return $response;

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function add()
    {

        $json = $this->request->getJsonRawBody();

        $indicator = new Indicator();
        foreach ($json as $attrib => $value) {
            $indicator->writeAttribute($attrib, $value);
        }

        try {
            
            $response = new Response();
            
            if ($indicator->save()) { // Save returns last created id
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    [
                        'status' => 'OK',
                        'data'   => $indicator,
                    ]
                );
            } else {
                $response->setStatusCode(409, 'Conflict');

                $errors = [];
                foreach ($status->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(
                    [
                        'status'   => 'ERROR',
                        'messages' => $errors,
                    ]
                );
            }

            return $response;

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function update($id)
    {
        try {
            $json = $this->request->getJsonRawBody();

            $indicator = Indicator::findFirst("id = " . $id);
            foreach ($json as $attrib => $value) {
                $indicator->writeAttribute($attrib, $value);
            }

            $response = new Response();

            if ($indicator->update()) {
                $response->setJsonContent(
                    [
                        'status' => 'OK'
                    ]
                );
            } else {
                $response->setStatusCode(409, 'Conflict');

                $errors = [];
                foreach ($status->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(
                    [
                        'status'   => 'ERROR',
                        'messages' => $errors,
                    ]
                );
            }

            return $response;

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function delete($id)
    {
        try {
            $indicator = Indicator::findFirst("id = " . $id);

            $response = new Response();

            if ($indicator->delete()) {
                $response->setJsonContent(
                    [
                        'status' => 'OK'
                    ]
                );
            } else {
                $response->setStatusCode(409, 'Conflict');

                $errors = [];
                foreach ($status->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(
                    [
                        'status'   => 'ERROR',
                        'messages' => $errors,
                    ]
                );
            }

            return $response;   
        
        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

}

