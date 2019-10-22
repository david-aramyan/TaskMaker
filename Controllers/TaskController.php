<?php
    require "Model/task.php";
	require "core/view.php";
    require "core/Validator.php";
    require "core/AuthMiddleware.php";

class TaskController
{

    /**
     * Initialize Task Instance.
     */
    private $task;

    /**
     * Constructor.
     *
     * @param  DBConnection  $db
     *
     * @return void
     */
    public function __construct(DBConnection $db)
    {
        $this->task = new Task($db);
    }

    /**
     * Show tasks.
     *
     * @param  string  $route
     *
     * @return void
     */
	public function showResult($route)
    {
        $tasks = $this->task->getTasks();
		if ($route == "")
			$route = "tasks";

		echo new View("Views/".$route.".php", array("tasks" => $tasks));
	}

    /**
     * edit task.
     *
     * @param  string  $route
     * @param  int  $id
     *
     * @return void
     */

    public function editTask($route, $id)
    {
        if (!AuthMiddleware::checkAuth()) {
            header('location: /');
        } else {
            $task = $this->task->getTaskById($id);

            $view = new View("Views/" . $route . ".php", array("data" => $task));

            if (null == $task)
                $view = new View("Views/404.html");

            echo $view;
        }
    }

    /**
     * update task.
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function updateTask($id)
    {
        if (!AuthMiddleware::checkAuth()) {
            header('location: /');
        } else {
            $text = Validator::validateText($_POST['text']);
            if (!$text) {
                $messages[] = 'Поле текст должно быть заполнено';
                $_SESSION['error_messages'] = $messages;
                header('location: /tasks/' . $id . '/editTask');
            } else {
                $_SESSION['success'] = "Задача успешно отредактировано.";
                $new_task = $this->task->updateTask($id);
                return $new_task;
            }
        }
    }

    /**
     * complete task status.
     *
     * @param  int  $id
     *
     * @return mixed
     */

    public function makeTaskCompleted($id)
    {
        if (!AuthMiddleware::checkAuth()) {
            header('location: /');
        } else {
            $task = $this->task->makeTaskCompleted($id);
            return $task;
        }
    }


    /**
     * create task.
     *
     * @param  string  $route
     *
     * @return void
     */
    public function createTask($route)
    {
        if ($route !== null) {
            echo new View("Views/".$route.".php");
        }
    }

    /**
     * insert task.
     *
     * @return mixed
     */
    public function insertTask()
    {
        $username = Validator::validateText($_POST['username']);
        $email = Validator::validateEmail($_POST['email']);
        $text = Validator::validateText($_POST['text']);

        $messages = [];
        if (!$username) {
            $messages[] = 'Поле имя пользователя должно быть заполнено';
        }
        if (!$text) {
            $messages[] = 'Поле текст должно быть заполнено';
        }
        if (!$email) {
            $messages[] = 'Поле email должно быть заполнено валидным email-ом';
        }

        if (!empty($messages)) {
            $_SESSION['error_messages'] = $messages;
            header('location: /tasks/createTask');
        } else {
            $_SESSION['success'] = "Задача успешно добавлена.";
            $task = $this->task->createTask();
            return $task;
        }
    }
}
