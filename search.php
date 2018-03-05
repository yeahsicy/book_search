<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SEARCH</title>
        <script src="js/validateForm.js" type="text/javascript"></script>
        <link href="css/search.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php
        include './template/header_nav.php';
        include './template/footer.php';
        include './PHP_function/util.php';
        include './PHP_function/MySQL_config.php';

        echo<<<MAIN
        <main>
            <form action="search.php" onsubmit="return NotAllBlank();" method="get">
                KEYWORD:
                <input type="text" class="textbox" name="keyword">
                TITLE:
                <input type="text" class="textbox" name="intitle">
                AUTHOR:
                <input type="text" class="textbox" name="inauthor">
                PUBLISHER:
                <input type="text" class="textbox" name="inpublisher">
                CATEGORY:
                <input type="text" class="textbox" name="subject">
                ISBN:
                <input type="text" class="textbox" name="isbn">
                <br>
                <input id="submit" type="submit"value="FIND">
            </form>
        </main>
MAIN;
        if (util::GetInfoToDB())
            util::redirectToResultAfter(0);
        ?>
    </body>
</html>
