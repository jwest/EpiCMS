<?php use EpiCMS\Box; ?>
<?php use EpiCMS\Boxes; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>EpiCMS</title>
    <style>
      body { padding-top: 60px; }
    </style>
    <link href="/epicms/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="/epicms/web/css/bootstrap-editable.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="/epicms/web/css/bootstrap-responsive.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">EpiCMS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Edit all</a></li>
              <li><a href="/epicms/admin/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <table class="table">
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            <?php foreach($boxes as $key => $value): ?>
                <?php $box = Box::prepare($key, $value) ?>
                <tr>
                    <td class="key"><span><?php echo $box->key(); ?></span></td>
                    <td class="value"><span><?php echo $box->value(); ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="/epicms/web/js/jquery-1.8.3.min.js"></script>
    <script src="/epicms/web/js/bootstrap.min.js"></script>
    <script src="/epicms/web/js/bootstrap-editable.min.js"></script>
    <script>
        $('table .key').each(function(){
            var keyParts = $(this).find('span').text().split(':');
            $(this).parent().find('.value span').editable({
                type: 'text',
                url: '/epicms/admin/'+keyParts.shift()+'/'+keyParts.join(':'),
                pk: 1,
                placement: 'top',
                title: 'Enter username'
            });
        });
    </script>
  </body>
</html>