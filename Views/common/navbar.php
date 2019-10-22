<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Задачник</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['login'])){ ?>
                <li>
                    <a href="/logout">Выйти</a>
                </li>
            <?php }else{ ?>
                <li class="nav-item dropdown">
                    <?php if (isset($_SESSION['auth_error'])) {
                        ?>
                        <span class="alert alert-danger"><?= $_SESSION['auth_error'] ?></span>
                        <?php
                        unset($_SESSION['auth_error']);
                    }
                    ?>
                    <a href="#" class="" data-toggle="dropdown">Авторизация</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdown">
                        <div class="col-md-12">
                            <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                <div class="form-group">
                                    <label class="sr-only" for="username">Имя пользователя</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="passwordInput">Пароль</label>
                                    <input type="password" name="password" class="form-control" id="passwordInput" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Войти</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
