<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\Area;

class AreaController extends _ControllerBase
{

    public function all()
    {
        try {
            $areas = Area::find(
                [
                    'order' =>  'name'
                ]
            );

            $data = [];

            foreach ($areas as $area) {
                $data[] = $area;
            }
            
            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function search($keyword)
    {
        try {
            $areas = Area::find(
                [
                    'conditions'    => 'name LIKE \'%' . $keyword . '%\'',
                    'order'         =>  'name'
                ]
            );

            $data = [];

            foreach ($areas as $area) {
                $data[] = $area;
            }

            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function get($id) 
    {
        try {
            $area = Area::findFirst(
                [
                    'conditions'    =>  'id = ' . $id
                ]
            );   

            $response = new Response();
            if ($area === false) {
                $response->setJsonContent(
                    [
                        'status' => 'NOT-FOUND'
                    ]
                );
            } else {
                $response->setJsonContent(
                    [
                        'status' => 'FOUND',
                        'data'   => $area
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

        $area = new Area();
        foreach ($json as $attrib => $value) {
            $area->writeAttribute($attrib, $value);
        }
        
        try {
            
            $response = new Response();
            
            if ($area->save()) { // Save returns last created id
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    [
                        'status' => 'OK',
                        'data'   => $area,
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

            $area = Area::findFirst("id = " . $id);
            foreach ($json as $attrib => $value) {
                $area->writeAttribute($attrib, $value);
            }

            $response = new Response();

            if ($area->update()) {
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
            $area = Area::findFirst("id = " . $id);

            $response = new Response();

            if ($area->delete()) {
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

