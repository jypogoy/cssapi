<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Models\Area;

class AreaController extends Controller
{

    public function all()
    {

        $areas = Area::find(
            [
                'order' =>  'name'
            ]
        );

        $data = [];

        foreach ($areas as $area) {
            $data[] = [
                'id'   => $area->id,
                'name' => $area->name,
                'description'   => $area->description,
                'created_at'    => $area->created_at
            ];
        }

        echo json_encode($data);
    }

    public function search($keyword)
    {

        $areas = Area::find(
            [
                'conditions'    => 'name LIKE \'%' . $keyword . '%\'',
                'order'         =>  'name'
            ]
        );

        $data = [];

        foreach ($areas as $area) {
            $data[] = [
                'id'            => $area->id,
                'name'          => $area->name,
                'description'   => $area->description,
                'created_at'    => $area->created_at
            ];
        }

        echo json_encode($data);
    }

    public function get($id) 
    {

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
                    'data'   => [
                        'id'            => $area->id,
                        'name'          => $area->name,
                        'description'   => $area->description,
                        'created_at'    => $area->created_at
                    ]
                ]
            );
        }

        return $response;
    }

    public function add()
    {

        $json = $this->request->getJsonRawBody();

        $area = new Area();
        $area->name = $json->name;
        $area->description = $json->description;

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
    }

    public function update($id)
    {

        $json = $this->request->getJsonRawBody();

        $area = Area::findFirst("id = " . $id);
        $area->name = $json->name;
        $area->description = $json->description;

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
    }

    public function delete($id)
    {
        
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
    }

}

