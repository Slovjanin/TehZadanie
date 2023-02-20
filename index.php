<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Техническое заданиеи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="custom.css" />
</head>

<body>

    <!-- Навигация -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">ТЗ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="javascript:void(0);" id="home">Домашняя страница</a>
                <a class="nav-item nav-link" href="javascript:void(0);" id="update_account">Учетная запись</a>               
                <a class="nav-item nav-link" href="javascript:void(0);" id="logout">Выход</a>
                <a class="nav-item nav-link" href="javascript:void(0);" id="login">Вход</a>
                <a class="nav-item nav-link" href="javascript:void(0);" id="sign_up">Регистрация</a>
            </div> 
        </div>  
        <div id="content1"></div>
    </nav>
    <main role="main" class="container starter-template">

        <div class="row">
            <div class="col">

                <!-- Здесь будут подсказки / быстрые сообщения -->
                <div id="response"></div>

                <!-- Здесь появится основной контент -->
                <div id="content"></div>                
            </div>
        </div>

    </main>

    <!-- jQuery & Bootstrap 4 JavaScript -->
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
   


    <script>
    jQuery($ => {

        // Показ формы регистрации
        $(document).on("click", "#sign_up", () => {
            var pas1 = $("#password").val();
            var pas2 = $("#сpassword").val();
             if(pas1!=pas2){
                error=3;
                $("#password").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                $("#сpassword").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
             if(error==3)  {
                 err_text="Пароли не совпадают";
                 $("#messenger").html(err_text);    
                 $("#messenger").fadeIn("slow");
             }               
            }
            let html = `
                <h2>Регистрация</h2>
                <form id="sign_up_form">
                    <div class="form-group">
                        <label for="firstname">Логин</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" pattern="^[A-Za-zА-Яа-яЁё0-9\s]{6,}" required />
                    </div>
    
                    <div class="form-group">
                        <label for="lastname">Имя</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" pattern="^[A-Za-zА-Яа-яЁё\s]{2,}" required />
                    </div>
    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required />
                    </div>
    
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" id="password" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}" required />
                    </div>

                    <div class="form-group">
                        <label for="cpassword">Пароль</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" required />
                    </div>
    
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            `;

            clearResponse();
            $("#content").html(html);
        });

        // Выполнение кода при отправке формы
$(document).on("submit", "#sign_up_form", function () {

    // Получаем данные формы
    const sign_up_form = $(this);
    const form_data = JSON.stringify(sign_up_form.serializeObject());

    // Отправка данных формы в API
    $.ajax({
        url: "api/create_user.php",
        type: "POST",
        contentType: "application/json",
        data: form_data,
        success: result => {

            // В случае удачного завершения запроса к серверу,
            // сообщим пользователю, что он успешно зарегистрировался и очистим поля ввода
            $("#response").html("<div class='alert alert-success'>Регистрация завершена успешно. Пожалуйста, войдите</div>");
            sign_up_form.find("input").val("");
        },
        error: (xhr, resp, text) => {

            // При ошибке сообщить пользователю, что регистрация не удалась
            $("#response").html("<div class='alert alert-danger'>Невозможно зарегистрироваться. Такой логин или email уже есть в базе</div>");
        }
    });

    return false;
});

        // Показа формы входа
$(document).on("click", "#login", () => {
    showLoginPage();

});

// При отправке формы входа
$(document).on("submit", "#login_form", function () {

    // Получаем данные формы
    const login_form = $(this);
    const form_data = JSON.stringify(login_form.serializeObject());

    // Отправка данных формы в API
    $.ajax({
        url: "api/login.php",
        type: "POST",
        contentType: "application/json",
        data: form_data,
        success: result => {

            // Сохраним JWT в куки
            setCookie("jwt", result.jwt, 1);

            // Показ домашней страницы и сообщение об успешном входе
            showHomePage();
            showUpdateAccountForm1();
            $("#response").html("<div class='alert alert-success'>Успешный вход в систему.</div>");

        },
        error: (xhr, resp, text) => {

            // При ошибке сообщим пользователю, что вход в систему не выполнен и очистим поля ввода
            $("#response").html("<div class='alert alert-danger'>Ошибка входа. Email или пароль указан неверно.</div>");
            login_form.find("input").val("");
        }
    });

    return false;
});

// Показать домашнюю страницу
$(document).on("click", "#home", () => {
    showHomePage();
    clearResponse();
    showUpdateAccountForm1();
});

$(document).on("click", "#update_account", () => {
    showUpdateAccountForm();
    showUpdateAccountForm1();
});

// срабатывание при отправке формы «обновить аккаунт»
$(document).on("submit", "#update_account_form", function () {

    // Дескриптор для update_account_form
    const update_account_form = $(this);

    // Валидация JWT для проверки доступа
    const jwt = getCookie("jwt");

    // Получаем данные формы
    let update_account_form_obj = update_account_form.serializeObject()

    // Добавим JWT
    update_account_form_obj.jwt = jwt;

    // Преобразуем значения формы в JSON с помощью функции stringify()
    const form_data = JSON.stringify(update_account_form_obj);

    // Отправка данных формы в API
    $.ajax({
        url: "api/update_user.php",
        type: "POST",
        contentType: "application/json",
        data: form_data,
        success: result => {

            // Сказать, что учетная запись пользователя была обновлена
            $("#response").html("<div class='alert alert-success'>Учетная запись обновлена</div>");

            // Сохраняем новый JWT в cookie
            setCookie("jwt", result.jwt, 1);
        },

        // Показать сообщение об ошибке пользователю
        error: (xhr, resp, text) => {

            if (xhr.responseJSON.message == "Невозможно обновить пользователя") {
                $("#response").html("<div class='alert alert-danger'>Невозможно обновить пользователя</div>");
            }

            else if (xhr.responseJSON.message == "Доступ закрыт") {
                showLoginPage();
                $("#response").html("<div class='alert alert-success'>Доступ закрыт. Пожалуйста войдите</div>");
            }
        }
    });

    return false;
});

// Выйти из системы
$(document).on("click", "#logout", () => {
    showLoginPage();
    $("#response").html("<div class='alert alert-info'>Вы вышли из системы.</div>");
});

        // Удаление всех быстрых сообщений
        function clearResponse() {
            $("#response").html("");
        }

        // Функция показывает HTML-форму для входа в систему.
function showLoginPage() {

    // Удаление jwt
    setCookie("jwt", "", 1);

    // Форма входа
    let html = `
        <h2>Вход</h2>
        <form id="login_form">
            <div class="form-group">
                <label for="firstname">Логин</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Введите логин">
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
            </div>

            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    `;

    $("#content").html(html);
    $("#content1").html("");
    clearResponse();
    showLoggedOutMenu();
}

// Функция setCookie() поможет нам сохранить JWT в файле cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Эта функция сделает меню похожим на опции для пользователя, вышедшего из системы.
function showLoggedOutMenu() {

    // Показать кнопку входа и регистрации в меню навигации
    $("#login, #sign_up").show();
    $("#logout").hide();
}

// Функция для показа домашней страницы
function showHomePage() {

    // Валидация JWT для проверки доступа
    const jwt = getCookie("jwt");

    $.post("api/validate_token.php", JSON.stringify({ jwt: jwt })).done(result => {

        // если прошел валидацию, показать домашнюю страницу
        let html = `
            <div class="card">
                <div class="card-header">Добро пожаловать!</div>
                <div class="card-body">
                    <h5 class="card-title">Вы вошли в систему</h5>
                    <p class="card-text">Вы не сможете получить доступ к домашней странице и страницам учетной записи, если вы не вошли в систему</p>
                </div>
            </div>
        `;

        $("#content").html(html);
        showLoggedInMenu();
    })

        // Показать страницу входа при ошибке
        .fail(function (result) {
            showLoginPage();
            $("#response").html("<div class='alert alert-danger'>Пожалуйста войдите, чтобы получить доступ к домашней станице</div>");
        });
}

// Функция поможет нам прочитать JWT, который мы сохранили ранее.
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// Если пользователь авторизован
function showLoggedInMenu() {

    // Скроем кнопки входа и регистрации с панели навигации и покажем кнопку выхода
    $("#login, #sign_up").hide();
    $("#logout").show();
}

function showUpdateAccountForm() {

    // Валидация JWT для проверки доступа
    const jwt = getCookie("jwt");

    $.post("api/validate_token.php", JSON.stringify({ jwt: jwt })).done(result => {

        // Если валидация прошла успешно, покажем данные пользователя в форме
        let html = `
            <h2>Учётная запись</h2>
            <form id="update_account_form">
                <div class="form-group">
                    <label for="firstname">Логин</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" pattern="[A-Za-zА-Яа-яЁё0-9\s]{6,}" required value="${result.data.firstname}" />
                </div>

                <div class="form-group">
                    <label for="lastname">Имя</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" pattern="^[A-Za-zА-Яа-яЁё\s]{2,}" required value="${result.data.lastname}" />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required value="${result.data.email}" />
                </div>               
                
            </form>
        `;

        clearResponse();
        $("#content").html(html);
    })

        // В случае ошибки / сбоя сообщите пользователю, что ему необходимо войти в систему, 
        // чтобы увидеть страницу учетной записи
        .fail(result => {
            showLoginPage();
            $("#response").html("<div class='alert alert-danger'>Пожалуйста, войдите, чтобы получить доступ к странице учетной записи</div>");
        });
}


function showUpdateAccountForm1() {

    // Валидация JWT для проверки доступа
    const jwt = getCookie("jwt");

    $.post("api/validate_token.php", JSON.stringify({ jwt: jwt })).done(result => {

        // Если валидация прошла успешно, покажем данные пользователя в форме
        let html = `            
            <form id="update_account_form">                               
                <p style="color:white">Hello, <input required value="${result.data.lastname}" style="background-color:#343a40!important; color:white; border:0"></p>
            </form>
        `;

        clearResponse();
        $("#content1").html(html);
    })
}





        // Функция для преобразования значений формы в формат JSON
$.fn.serializeObject = function () {
    let o = {};
    let a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || "");
        } else {
            o[this.name] = this.value || "";
        }
    });
    return o;
};
    });
</script>

</body>

</html>
