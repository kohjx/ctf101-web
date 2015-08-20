<!doctype html>
<html>
    <head>
        <title>IceCTF | Authorize</title>
        <link rel="stylesheet" href="css/materialize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="row black">
        </div>
        <div class="row">
            <div class="container">
                <div class="row" style="margin-bottom: 3rem;">
                    <div class="col s12 m4 offset-m4 center panel" style="padding: 0; background: #353535">
                        <form method="post" action="login.php">
                            <div class="row">
                                <h4 style="color: white; font-weight: 300; margin: 0; text-align: left; margin-left: 3.5rem; margin-top: 0.5rem;">Login</h4>
                                <div class="input-field col s12" style="padding-right: 2rem;">
                                    <i class="mdi-social-person prefix white-text"></i>
                                    <input id="username" name="username" type="text" class="validate" style="color: white;">
                                    <label for="username">Username</label>
                                </div>
                                <div class="input-field col s12" style="padding-right: 2rem;">
                                    <i class="mdi-action-lock prefix white-text"></i>
                                    <input id="password" name="password" type="password" class="validate" style="color: white;">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <button id="signIn" style="width: 100%;" class="btn waves-effect waves-light white black-text" type="submit">Login
                                <i class="mdi-content-send right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m4 offset-m4 center panel" style="padding: 0; background: #353535">
                        <form method="post" action="register.php">
                            <div class="row">
                                <h4 style="color: white; font-weight: 300; margin: 0; text-align: left; margin-left: 3.5rem; margin-top: 0.5rem;">Register</h4>
                                <div class="input-field col s12" style="padding-right: 2rem;">
                                    <i class="mdi-social-person prefix white-text"></i>
                                    <input id="register" name="register" type="text" class="validate" style="color: white;">
                                    <label for="register">Username</label>
                                </div>
                            </div>
                            <button id="signIn" style="width: 100%;" class="btn waves-effect waves-light white black-text" type="submit">Register
                                <i class="mdi-content-send right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col s12 m4 offset-m4">
                    <a href="login.phps">login.php</a><br/>
                    <a href="register.phps">register.php</a>
                </div>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="js/materialize.min.js"></script>
    </body>
</html>
