<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Anasayfa</a></li>
                <li class="active">Giriş Yap/Kayıt Ol</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <form id="LoginForm" action="login-register" method="POST" onSubmit="return false">
                    <div class="login-form">
                        <h4 class="login-title">Giriş Yap</h4>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Email Adres*</label>
                                <input class="mb-0 validate[required, custom[email]]" type="email" name="Email"
                                       placeholder="Email Adres" value="">
                            </div>
                            <div class="col-12 mb-20">
                                <label id="labelPassword">Şifre*</label>
                                <input class="mb-0 validate[required,minSize[8]]" type="password" name="Password"
                                       placeholder="Şifre">
                            </div>
                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="#"> Şifreni mi unuttun?</a>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="csrf_token"
                                       value="<?php echo $_SESSION['csrf_token'] = uniqid(); ?>">
                                <button id="LoginButton" type="submit" class="register-button mt-0">Giriş Yap</button>
                            </div>
                            <div id="LoginResult" class="col-md-12 mt-3 mb-3">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form id="RegisterForm" action="index.php?func=login-register" method="post">
                    <div class="login-form">
                        <h4 class="login-title">Kayıt Ol</h4>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-20">
                                <label>Ad*</label>
                                <input class="mb-0 validate[required, custom[onlyLetterSp]]" type="text"
                                       name="FirstName" placeholder="Ad">
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Soyad*</label>
                                <input class="mb-0 validate[required, custom[onlyLetterSp]]" type="text" name="LastName"
                                       placeholder="Soyad">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email Adres*</label>
                                <input class="mb-0 validate[required, custom[email]]" type="text" name="Email"
                                       placeholder="Email Adres">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Şifre*</label>
                                <input id="Password" class="mb-0 validate[required, minSize[8]]" type="Password"
                                       name="Password" placeholder="Şifre">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Şifre Tekrar*</label>
                                <input id="password2" class="mb-0 validate[required, minSize[8], equals[Password]]"
                                       type="Password" name="Password2" placeholder="Şifre Tekrar">
                            </div>
                            <div class="col-12">
                                <button class="register-button mt-0" type="submit" name="Register">Kayıt Ol</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->

<script>
    $(document).ready(function () {
        $("#LoginForm").validationEngine('attach', {
            rules: {
                SelectName: {valueNotEquals: "0"}
            },
            onValidationComplete: function (form, status) {
                if (status == true) {
                    Login();
                } else {

                }
            }
        })

        $("#RegisterForm").validationEngine('attach');
    });

    function Register() {

    }

    function Login() {
        $("#LoginResult").html("Yükleniyor..");
        $("#LoginButton").removeAttr('onclick');
        console.log("Birinci istek");
        $.post({
            url: "ajax/login.php",
            data: $("#LoginForm").serialize() + '&extra=' + $("input[name='Email']").val(),
            cache: false,
            dataType: 'json',
            success: function (ajaxAnswer) {
                console.log(ajaxAnswer);
                if (ajaxAnswer['status'] == 'error') {
                    $("#LoginResult").html(ajaxAnswer['message']).addClass("alert alert-danger");
                } else if (ajaxAnswer['status'] == 'success') {

                    $("#LoginResult").removeClass("alert alert-danger").addClass("alert alert-success").html(ajaxAnswer['message']);
                    window.location.href = 'index.php';
                }

                // $("#labelPassword").html("Password");
                $("#LoginButton").attr('onclick', 'Login()');
            },
            error: function (hata) {
                console.log("test");
                $("#LoginButton").attr('onclick', 'Login()');
                $("#LoginResult").html("Sistem hatası. Yönetici ile iletişime geçiniz.");
            }
        });
        console.log("İkinci istek");
        console.log("Üç istek");
        console.log("dört istek");
        console.log("beş istek");
    }

</script>
