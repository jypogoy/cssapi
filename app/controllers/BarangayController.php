<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\Barangay;

class BarangayController extends _ControllerBase
{

    public function all()
    {
        try {
            $barangay = Barangay::find(
                [
                    'order' =>  'barangay_name'
                ]
            );

            $data = [];

            foreach ($barangay as $Barangay) {
                $data[] = $Barangay;
            }
            
            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function search($keyword)
    {
        try {
            $barangay = Barangay::find(
                [
                    'conditions'    => 'barangay_name LIKE \'%' . $keyword . '%\'',
                    'order'         =>  'barangay_name'
                ]
            );

            $data = [];

            foreach ($barangay as $Barangay) {
                $data[] = $Barangay;
            }

            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    public function get($id) 
    {
        try {
            $Barangay = Barangay::findFirst(
                [
                    'conditions'    =>  'id = ' . $id
                ]
            );   

            $response = new Response();
            if ($Barangay === false) {
                $response->setJsonContent(
                    [
                        'status' => 'NOT-FOUND'
                    ]
                );
            } else {
                $response->setJsonContent(
                    [
                        'status' => 'FOUND',
                        'data'   => $Barangay
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

        $Barangay = new Barangay();
        foreach ($json as $attrib => $value) {
            $Barangay->writeAttribute($attrib, $value);
        }
        
        try {
            
            $response = new Response();
            
            if ($Barangay->save()) { // Save returns last created id
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    [
                        'status' => 'OK',
                        'data'   => $Barangay,
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

            $Barangay = Barangay::findFirst("id = " . $id);
            foreach ($json as $attrib => $value) {
                $Barangay->writeAttribute($attrib, $value);
            }

            $response = new Response();

            if ($Barangay->update()) {
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
            $Barangay = Barangay::findFirst("id = " . $id);

            $response = new Response();

            if ($Barangay->delete()) {
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

