<?php
namespace App\controllers;

use App\components\Database;
use League\Plates\Engine;


class TasksController
{
    private $view;
    private $database;

    public function __construct(Engine $view, Database $database)
    {
        $this->view = $view;
        $this->database = $database;
    }

    public function index()
    {
        $myTasks = $this->database->all('tasks');

        echo $this->view->render('tasks/index', ['tasks' => $myTasks]);
    }

    public function show($id)
    {
        $myTask = $this->database->getOne('tasks', $id);

        echo $this->view->render('tasks/show', ['task' => $myTask]);
    }

    public function create()
    {
        echo $this->view->render('tasks/create');
    }

    public function store()
    {
        $this->database->store('tasks', $_POST);

        header("Location: /tasks");
    }

    public function edit($id)
    {
        $myTask = $this->database->getOne('tasks', $id);

        echo $this->view->render('tasks/edit', ['task' => $myTask]);
    }

    public function update($id)
    {
        $this->database->update('tasks', $id, $_POST);

        header("Location: /tasks");
    }

    public function delete($id)
    {
        $this->database->delete("tasks", $id);

        header("Location: /tasks");
    }

}
