<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RESULT</title>
        <link href="css/result.css" type="text/css" rel="stylesheet">
        <link href="css/NOT_FOUND.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php
        include './template/header_nav.php';
        include './template/footer.php';
        include './PHP_function/util.php';
        include './PHP_function/MySQL_config.php';
        util::OutputSeletor();
        ?>
    </body>
</html>
