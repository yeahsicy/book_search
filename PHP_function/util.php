<?php

/**
 * PHP custom tools. 
 *
 * @author Jerry
 */
class util {

    static function redirectToResultAfter($second) {
        $temp = "<meta http-equiv='refresh' content='$second;url=result.php'>";
        echo $temp;
    }

    static function redirectToSearchAfter($second) {
        $temp = "<meta http-equiv='refresh' content='$second;url=search.php'>";
        echo $temp;
    }

    static function BuildApiRequestUrl() {
        $keyword = $_GET["keyword"];
        $intitle = $_GET["intitle"];
        $inauthor = $_GET["inauthor"];
        $inpublisher = $_GET["inpublisher"];
        $subject = $_GET["subject"];
        $isbn = $_GET["isbn"];

        $url = "https://www.googleapis.com/books/v1/volumes?q=";

        if ($keyword == "" && $intitle == "" && $inauthor == "" && $inpublisher == "" && $subject == "" && $isbn == "")
            return FALSE;

        if ($intitle != "")
            $intitle = "+intitle:" . $intitle;
        if ($inauthor != "")
            $inauthor = "+inauthor:" . $inauthor;
        if ($inpublisher != "")
            $inpublisher = "+inpublisher:" . $inpublisher;
        if ($subject != "")
            $subject = "+subject:" . $subject;
        if ($isbn != "")
            $isbn = "+isbn:" . $isbn;

        $url .= $keyword . $intitle . $inauthor . $inpublisher . $subject . $isbn;
        return $url;
    }

    static function GetApiResponse() {
        $url = util::BuildApiRequestUrl();
        if (!$url)
            return FALSE;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $json = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($json);
        return $resp;
    }

    static function GetInfoToDB() {
        $resp = util::GetApiResponse();
        if (!$resp)
            return FALSE;
        $items = $resp->items;
        $link = util::connectMySql();
        //clean cache
        mysqli_query($link, "DELETE FROM `book_info`");

        for ($index = 0; $index < count($items); $index++) {
            $volumeInfo = $items[$index]->volumeInfo;
            $title = $volumeInfo->title;
            $authors = util::GetInsideInfo($volumeInfo->authors);
            $publisher = $volumeInfo->publisher;
            $publishedDate = $volumeInfo->publishedDate;
            $description = $volumeInfo->description;
            $categories = util::GetInsideInfo($volumeInfo->categories);
            $isbn = $volumeInfo->industryIdentifiers[0]->identifier;
            $preview = $volumeInfo->previewLink;
            //put in database
            mysqli_query($link, "INSERT INTO `book_info`(`title`, `authors`, `publisher`, `publishedDate`, `description`, `categories`, `ISBN`, `previewLink`) VALUES ('$title', '$authors', '$publisher', '$publishedDate', '$description', '$categories', '$isbn', '$preview')");
        }
        mysqli_close($link);
        return TRUE;
    }

    static function GetInsideInfo($array) {
        $temp = "";
        for ($index = 0; $index < count($array); $index++) {
            $temp .= $array[$index] . "; ";
        }
        return $temp;
    }

    static function connectMySql() {
        $link = mysqli_connect(HOST, USER, PASSWORD, DATABASE, PORT);
        if (mysqli_connect_error())
            print_r(mysqli_connect_error());
        return $link;
    }

    static function OutputSeletor() {
        $link = util::connectMySql();
        $result = mysqli_query($link, "SELECT 1 FROM `book_info`");
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 0)
            util::output_for_no_row();
        else
            util::output_for_rows($link);

        mysqli_close($link);
    }

    static function output_for_no_row() {
        echo <<<NO_ROW
        <br><br>
        <h3 class="NOT_FOUND">NOT FOUND!</h3>
        <h3 class="NOT_FOUND">REDIRECT TO SEARCH IN 3 SECONDS...</h3>
NO_ROW;
        util::redirectToSearchAfter(3);
    }

    static function output_for_rows($link) {
        $query = "SELECT * FROM `book_info`";
        $result = mysqli_query($link, $query);
        $fetch = mysqli_fetch_all($result, 3);

        $htmlBlock = <<<BLK
            <main>
            <table>
                <tr>
                    <th>TITLE</th>
                    <th>AUTHORS</th>
                    <th>PUBLISHER</th>
                    <th>PUBLISHED DATE</th>
                    <th>DESCRIPTION</th>
                    <th>CATEGORIES</th>
                    <th>ISBN</th>
                    <th>PREVIEW LINK</th>
                </tr>
BLK;
        for ($index = 0; $index < count($fetch); $index++) {
            $title = $fetch[$index][1];
            $authors = $fetch[$index][2];
            $publisher = $fetch[$index][3];
            $publishedDate = $fetch[$index][4];
            $description = $fetch[$index][5];
            $categories = $fetch[$index][6];
            $ISBN = $fetch[$index][7];
            $previewLink = $fetch[$index][8];

            $htmlBlock .= <<<ADD
                    <tr>
                    <td>$title</td>
                    <td>$authors</td>
                    <td>$publisher</td>
                    <td>$publishedDate</td>
                    <td>$description</td>
                    <td>$categories</td>
                    <td>$ISBN</td>
                    <td><a href="$previewLink" target="_blank">VIEW</a></td>
                    </tr>
ADD;
        }
        $htmlBlock .= "</table></main>";
        echo $htmlBlock;
    }

}
