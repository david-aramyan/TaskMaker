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
    <div class="mx-auto">
        <h1 class="text-center">Редактирование задачи</h1>
        <form id="form" class="form-horizontal"  method="POST" action="/tasks/<?= $data["id"]?>/updateTask">
            <div class="form-group">
                <label class="control-label" >Текст задачи*:</label>
                <div>
                    <textarea name="text" id="text" class="form-control" rows="5"><?= $data["text"]?></textarea>
                </div>
            </div>
            <div class="form-group status_div">
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
