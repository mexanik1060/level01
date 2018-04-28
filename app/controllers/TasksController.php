<?php
namespace App\controllers;

use App\models\QueryBuilder;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use PDO;

class TasksController
{
    private $view;
    private $queryFactory;
    private $pdo;

    public function __construct(Engine $view, QueryFactory $queryFactory, PDO $pdo)
    {
        $this->view = $view;
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
    }

    public function index()
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(["*"])
            ->from('tasks');

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $myTasks = $sth->fetchAll(PDO::FETCH_ASSOC);

        echo $this->view->render('tasks/index', ['tasks' => $myTasks]);
    }


    public function show($id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(["*"])
            ->from('tasks')
            ->where('id=:id')
            ->bindValues(['id'  =>  $id]);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $myTask = $sth->fetch(PDO::FETCH_ASSOC);

        echo $this->view->render('tasks/show', ['task' => $myTask]);
    }

    public function create()
    {
        echo $this->view->render('tasks/create');
    }

    public function store()
    {
        $insert = $this->queryFactory->newInsert();

        $insert
            ->into('tasks')                   // INTO this table
            ->cols($_POST);

        $sth = $this->pdo->prepare($insert->getStatement());

        $sth->execute($insert->getBindValues());


        header("Location: /tasks");
    }

    public function edit($id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(["*"])
            ->from('tasks')
            ->where('id=:id')
            ->bindValues(['id'  =>  $id]);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $myTask = $sth->fetch(PDO::FETCH_ASSOC);

        echo $this->view->render('tasks/edit', ['task' => $myTask]);
    }

    public function update($id)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table('tasks')                  // update this table
            ->cols($_POST)          // raw value as "(ts) VALUES (NOW())"
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($update->getStatement());

        $sth->execute($update->getBindValues());

        header("Location: /tasks");
    }

    public function delete($id)
    {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from('tasks')
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($delete->getStatement());

        $sth->execute($delete->getBindValues());

        header("Location: /tasks");
    }

}
