<!DOCTYPE html>
<html>
<?php include_once 'Views/common/head.php' ?>
<body>
<?php include_once 'Views/common/navbar.php' ?>

<?php if (!empty($_SESSION['error_messages'])) {
    echo "<span style = 'margin-left:20px;color:red' class='error_span'><ul>";
    foreach ($_SESSION['error_messages'] as $message) {
        echo "<li>".$message."</li>";
    }
    echo "</ul></span>";
}
unset($_SESSION['error_messages']);
?>
<div class="container">
    <div class="col-md-8 mx-auto">
        <h1 class="text-center">Создать задачу</h1>
        <form id = "createForm" class="form-horizontal" action="/tasks/insertTask" method="POST">
            <div class="form-group">
                <input class = "hidden" type="hidden" name="id" value="">
                <label class="control-label" for="task_username">Имя пользователя*:</label>
                <div >
                    <input name="username" type="text" class="form-control"  id="task_username" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email*:</label>
                <div>
                    <input name="email" type="email" class="form-control" id="email" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="text">Текст задачи*:</label>
                <div>
                    <textarea name="text" class="form-control" id="text" rows="5"></textarea>
                </div>
            </div>
            <div class="form-group error_div">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success update">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once 'Views/common/scripts.php' ?>
</body>
</html>
