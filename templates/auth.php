<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>EpiCMS - sign in</title>

    <link href="/epicms/web/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="/epicms/web/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="?" method="post">
        <h2 class="form-signin-heading">EpiCMS - sign in</h2>
        <input type="text" class="input-block-level" placeholder="Email address" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div>

    <script src="/epicms/web/js/jquery-1.8.3.min.js"></script>
    <script src="/epicms/web/js/bootstrap.min.js"></script>
  </body>
</html>
