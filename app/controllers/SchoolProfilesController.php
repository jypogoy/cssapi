<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\SchoolProfiles;

class SchoolProfilesController extends _ControllerBase
{

    public function all()
    {
        try {
            $schoolProfiles = SchoolProfiles::find(
                [
                    'order' =>  'school_id'
                ]
            );

            $data = [];

            foreach ($schoolProfiles as $schoolProfile) {
                $data[] = $schoolProfile;
            }
            
            echo json_encode($data);

        } catch (\Exception $e) {            
            $this->errorLogger->error(parent::_constructExceptionMessage($e));
        }
    }

    // public function search($keyword)
    // {
    //     try {
    //         $schoolProfiles = SchoolProfiles::find(
    //             [
    //                 'conditions'    => 'sch_name LIKE \'%' . $keyword . '%\'',
    //                 'order'         =>  'sch_name'
    //             ]
    //         );

    //         $data = [];

    //         foreach ($schoolProfiles as $schoolProfile) {
    //             $data[] = $schoolProfile;
    //         }

    //         echo json_encode($data);

    //     } catch (\Exception $e) {            
    //         $this->errorLogger->error(parent::_constructExceptionMessage($e));
    //     }
    // }

    public function get($id) 
    {
        try {
            $schoolProfile = SchoolProfiles::findFirst(
                [
                    'conditions'    =>  'id = ' . $id
                ]
            );   

            $response = new Response();
            if ($schoolProfile === false) {
                $response->setJsonContent(
                    [
                        'status' => 'NOT-FOUND'
                    ]
                );
            } else {
                $response->setJsonContent(
                    [
                        'status' => 'FOUND',
                        'data'   => $schoolProfile
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

        $schoolProfile = new SchoolProfiles();
        foreach ($json as $attrib => $value) {
            $schoolProfile->writeAttribute($attrib, $value);
        }
        
        try {
            
            $response = new Response();
            
            if ($schoolProfile->save()) { // Save returns last created id
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    [
                        'status' => 'OK',
                        'data'   => $schoolProfile,
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

            $schoolProfile = SchoolProfiles::findFirst("id = " . $id);
            foreach ($json as $attrib => $value) {
                $schoolProfile->writeAttribute($attrib, $value);
            }

            $response = new Response();

            if ($schoolProfile->update()) {
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
            $schoolProfile = SchoolProfiles::findFirst("id = " . $id);

            $response = new Response();

            if ($schoolProfile->delete()) {
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

