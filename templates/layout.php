<?php use EpiCMS\Box; ?>
<?php use EpiCMS\Boxes; ?>
<html>
    <head>
        <title>EpiCMS</title>
    </head>
    <body>
        <header>
            <h1>EpiCMS <?php echo Box::text('layout', 'header'); ?></h1>
            <h3><?php echo $page->value(); ?></h3>
        </header>
        <div class="menu">
            <ul>
                <?php foreach(new Boxes('page') as $box): ?>
                    <li><a href="/epicms/<?php echo $box->name() ?>"><?php echo $box ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="content">
            <?php echo Box::text($page->key(), 'content') ?>
        </div>
    </body>
</html>
