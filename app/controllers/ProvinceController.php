<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\Province;

class ProvinceController extends _ControllerBase
{

    public function all()
    {
        try {
            $provinces = Province::find(
                [
                    'order' =>  'province_name'
                ]
            );

            $data = [];

            foreach ($provinces as $province) {
                $data[] = $province;
            }
            
            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function search($keyword)
    {
        try {
            $provinces = Province::find(
                [
                    'conditions'    => 'province_name LIKE \'%' . $keyword . '%\'',
                    'order'         =>  'province_name'
                ]
            );

            $data = [];

            foreach ($provinces as $province) {
                $data[] = $province;
            }

            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function get($id) 
    {
        try {
            $province = Province::findFirst(
                [
                    'conditions'    =>  'id = ' . $id
                ]
            );   

            $response = new Response();
            if ($province === false) {
                $response->setJsonContent(
                    [
                        'status' => 'NOT-FOUND'
                    ]
                );
            } else {
                $response->setJsonContent(
                    [
                        'status' => 'FOUND',
                        'data'   => $province
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

        $province = new Province();
        foreach ($json as $attrib => $value) {
            $province->writeAttribute($attrib, $value);
        }
        
        try {
            
            $response = new Response();
            
            if ($province->save()) { // Save returns last created id
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    [
                        'status' => 'OK',
                        'data'   => $province,
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

            $province = Province::findFirst("id = " . $id);
            foreach ($json as $attrib => $value) {
                $province->writeAttribute($attrib, $value);
            }

            $response = new Response();

            if ($province->update()) {
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
            $province = Province::findFirst("id = " . $id);

            $response = new Response();

            if ($province->delete()) {
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

