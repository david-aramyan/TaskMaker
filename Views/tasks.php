<!DOCTYPE html>
<html>
<?php include_once 'Views/common/head.php' ?>
<body>
<?php include_once 'Views/common/navbar.php' ?>
<div class="container-fluid">
    <?php if (!empty($_SESSION['success'])) {
        ?>
        <div class="row">
            <span class='alert alert-success mt-1 mx-auto'><?= $_SESSION['success'] ?></span>
        </div>
        <?php
    }
    unset($_SESSION['success']);
    ?>
    <div class="row pt-1">
        <div class="ml-auto mr-3">
            <a href="tasks/createTask" class = "btn btn-success">Создать задачу </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table id="tasks" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Текст задачи</th>
                    <th>Выполнено</th>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <th>Действия</th>
                    <?php }?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task){ ?>
                    <tr>
                        <td><?=$task['username'];?></td>
                        <td><?=$task['email'];?></td>
                        <td><?=$task['text'];?></td>
                        <td>
                    <span class="completed-status">
                    <?php
                    if ($task['completed'] == 1) {
                        ?>
                        Да <span class="badge badge-pill badge-info">Отредактировано администратором</span>
                        <?php
                    } else {
                        ?>
                        Нет
                        <?php
                        if (isset($_SESSION['login'])) {
                            ?>
                            <input type="checkbox" id="status_<?= $task['id']?>" onchange="completeStatus(<?= $task['id']?>)" class="status">
                            <?php
                        }
                    }
                    ?>
                </span>
                        </td>
                        <?php if(isset($_SESSION['login'])){ ?>
                        <td><a href="tasks/<?=$task["id"]?>/editTask" class = "btn btn-warning">Редактировать</a>
                            <?php }?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'Views/common/scripts.php' ?>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
            });
            $('#tasks').DataTable({
                "searching": false,
                "lengthChange": false,
                "pageLength": 3,
                'columnDefs': [ {
                    'targets': [<?= !isset($_SESSION['login']) ? '2' : '2, 4'?>],
                    'orderable': false,
                }],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                }
            });


        });
        function completeStatus(id) {
            if ($('#status_' + id).is(':checked')) {
                let completed = 1;
                $.ajax({
                    type: "POST",
                    url: 'tasks/' + id + '/makeTaskCompleted',
                    data: {'completed': completed},
                    success: function () {
                        $('#status_' + id).parent().replaceWith('Да <span class="badge badge-pill badge-info">Отредактировано администратором</span>');
                    }
                });
            }
        }
    </script>
</div>
</body>
</html>
