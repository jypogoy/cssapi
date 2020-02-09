<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class AreaController extends Controller
{

    public function all()
    {

        $phql = 'SELECT id, name, description, created_at '
                . 'FROM Area '
                . 'ORDER BY name';

        $areas = $this->modelsManager->executeQuery($phql);

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

        $phql = 'SELECT * '
              . 'FROM Area '
              . 'WHERE name '
              . 'LIKE :name: '
              . 'ORDER BY name'
        ;

        $areas = $this->modelsManager->executeQuery(
                $phql,
                [
                    'name' => '%' . $keyword . '%'
                ]
            )
        ;

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

        $phql = 'SELECT * '
              . 'FROM Area '
              . 'WHERE id = :id:'
        ;

        $area = $this->modelsManager->executeQuery(
                $phql,
                [
                    'id' => $id,
                ]
            )
            ->getFirst()
        ;  

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

    public function add($payload)
    {

        $area = $this->request->getJsonRawBody();
        
        $phql  = 'INSERT INTO area '
                . '(name, description) '
                . 'VALUES '
                . '(:name:, :description:)'
        ;

        $status = $this->modelsManager->executeQuery(
                $phql,
                [
                    'name'          => $area->name,
                    'description'   => $area->description,
                ]
            )
        ;

        $response = new Response();

        if ($status->success() === true) {
            $response->setStatusCode(201, 'Created');

            $area->id = $status->getModel()->id;

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

    public function update($payload)
    {

        $area = $app->request->getJsonRawBody();
        $phql  = 'UPDATE area '
               . 'SET name = :name:, description = :description: '
               . 'WHERE id = :id:';

        $status = $this->modelsManager->executeQuery(
                $phql,
                [
                    'id'   => $id,
                    'name' => $area->name,
                    'description' => $area->description
                ]
            )
        ;

        $response = new Response();

        if ($status->success() === true) {
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
        
        $phql = 'DELETE '
              . 'FROM area '
              . 'WHERE id = :id:';

        $status = $this->modelsManager->executeQuery(
                $phql,
                [
                    'id' => $id,
                ]
            )
        ;

        $response = new Response();

        if ($status->success() === true) {
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

