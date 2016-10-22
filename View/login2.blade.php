<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Logic Rays | Administrator Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        {{ Html::style("assets/bootstrap/css/bootstrap.min.css", array("rel"=>"stylesheet")) }}
        <!-- Font Awesome -->
        {{ Html::style("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css", array("rel"=>"stylesheet")) }}
        <!-- Ionicons -->
        {{ Html::style("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css", array("rel"=>"stylesheet")) }}
        <!-- Theme style -->
        {{ Html::style("assets/dist/css/AdminLTE.min.css", array("rel"=>"stylesheet")) }}
        <!-- iCheck -->
        {{ Html::style("assets/plugins/iCheck/square/blue.css", array("rel"=>"stylesheet")) }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="{{ config('constants.ASSETS') }}dist/img/favicon.ico"/>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ URL::to('administrator') }}">
                    <img src="{{ config('constants.ASSETS') }}dist/img/logo.png" alt="LogicRays" />
                </a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                {{ Form::open(array('url' => config('constants.ADMIN_TEXT').'login/loginadmin ','class' => 'login-form' , 'method' => 'POST')) }} 
                
                    @if(Session::has('login_message'))
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>{{ Session::pull('login_message') }}</span>
                    </div>
                    @endif 
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        <span>{{ Session::pull('success_message') }}</span>
                    </div>
                    @endif
                
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                {{ Form::close() }}

                <a href="#">I forgot my password</a><br>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        {{ Html::script("assets/plugins/jQuery/jQuery-2.1.4.min.js") }}
        <!-- Bootstrap 3.3.5 -->
        {{ Html::script("assets/bootstrap/js/bootstrap.min.js") }}
        <!-- iCheck -->
        {{ Html::script("assets/plugins/iCheck/icheck.min.js") }}
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
