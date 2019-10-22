<?php


class Task
{
    /**
     * Initialize Db Instance.
     */
	private $connection;

    /**
     * Constructor.
     *
     * @param  DBConnection  $db
     *
     * @return void
     */
    public function __construct(DBConnection $db)
    {
        $this->connection = $db;
    }

    /**
     * get tasks.
     *
     * @return array
     */
	public function getTasks()
    {
		$sth = $this->connection->connection->prepare("SELECT * FROM `tasks`");
		$sth->execute();

        $tasks = $sth->fetchAll(PDO::FETCH_ASSOC);

	    return $tasks;
	}

    /**
     * get task by id.
     *
     * @param int $id
     * @return array
     */
    public function getTaskById($id)
    {
        $sth = $this->connection->connection->prepare("SELECT * FROM `tasks` WHERE id =".$id);
        $sth->execute();

        $check = null;
        if ($sth->rowCount() > 0)
            $check = $sth->fetch(PDO::FETCH_ASSOC);

        return $check;
    }

    /**
     * Update Task.
     *
     * @param int $id
     * @return mixed
     */
    public function updateTask($id)
    {
        $sql = "UPDATE tasks SET 
        text = :text
        WHERE id = :id";

        $stmt = $this->connection->connection->prepare($sql);
        $stmt->bindParam(':text', htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            header('location: /tasks');
        }
    }

    /**
     * Update Task Status.
     *
     * @param int $id
     * @return boolean
     */
    public function makeTaskCompleted($id)
    {
        $sql = "UPDATE tasks SET 
        completed = 1
        WHERE id = :id";

        $stmt = $this->connection->connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->execute();
    }

    /**
     * Create Task.
     *
     * @return mixed
     */
    public function createTask()
    {
        $stmt = $this->connection->connection->prepare("INSERT INTO tasks (username,email,text) VALUES (:username, :email, :text)");
        $stmt->bindParam(':username', htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'));
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':text', htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8'));
        if ($stmt->execute()) {
            header('location: /tasks');
        }
        return false;
    }

}
