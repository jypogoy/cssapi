<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class RobotsController extends Controller
{

    public function all()
    {

        $app = $this->app;
        
        $phql = 'SELECT id, name '
                . 'FROM Robots '
                . 'ORDER BY name';

        $robots = $app
            ->modelsManager
            ->executeQuery($phql);

        $data = [];

        foreach ($robots as $robot) {
            $data[] = [
                'id'   => $robot->id,
                'name' => $robot->name,
            ];
        }

        echo json_encode($data);
    }

    public function search($keyword)
    {

        $app = $this->app;

        $phql = 'SELECT * '
              . 'FROM Robots '
              . 'WHERE name '
              . 'LIKE :name: '
              . 'ORDER BY name'
        ;

        $robots = $app
            ->modelsManager
            ->executeQuery(
                $phql,
                [
                    'name' => '%' . $keyword . '%'
                ]
            )
        ;

        $data = [];

        foreach ($robots as $robot) {
            $data[] = [
                'id'   => $robot->id,
                'name' => $robot->name,
            ];
        }

        echo json_encode($data);
    }

    public function get($id) 
    {

        $app = $this->app;

        $phql = 'SELECT * '
              . 'FROM Robots '
              . 'WHERE id = :id:'
        ;

        $robot = $app
            ->modelsManager
            ->executeQuery(
                $phql,
                [
                    'id' => $id,
                ]
            )
            ->getFirst()
        ;

        $response = new Response();
        if ($robot === false) {
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
                        'id'   => $robot->id,
                        'name' => $robot->name
                    ]
                ]
            );
        }

        return $response;
    }

    public function add($payload)
    {

        $app = $this->app;

        $robot = $app->request->getJsonRawBody();
        $phql  = 'INSERT INTO Robots '
                . '(name, type, year) '
                . 'VALUES '
                . '(:name:, :type:, :year:)'
        ;

        $status = $app
            ->modelsManager
            ->executeQuery(
                $phql,
                [
                    'name' => $robot->name,
                    'type' => $robot->type,
                    'year' => $robot->year,
                ]
            )
        ;

        $response = new Response();

        if ($status->success() === true) {
            $response->setStatusCode(201, 'Created');

            $robot->id = $status->getModel()->id;

            $response->setJsonContent(
                [
                    'status' => 'OK',
                    'data'   => $robot,
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

        $app = $this->app;

        $robot = $app->request->getJsonRawBody();
        $phql  = 'UPDATE Robots '
               . 'SET name = :name:, type = :type:, year = :year: '
               . 'WHERE id = :id:';

        $status = $app
            ->modelsManager
            ->executeQuery(
                $phql,
                [
                    'id'   => $id,
                    'name' => $robot->name,
                    'type' => $robot->type,
                    'year' => $robot->year,
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
        
        $app = $this->app;

        $phql = 'DELETE '
              . 'FROM Robots '
              . 'WHERE id = :id:';

        $status = $app
            ->modelsManager
            ->executeQuery(
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

