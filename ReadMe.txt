This is a book search interface via google books api. The database is MySQL which has a "search_book" database where "book_info" table contains rows of book information. 

FYI, 
A sql script that drops and creates the database for this project: search_book.sql
SQL connection constants in a config file along with port specified: \PHP_function\MySQL_config.php


"index.php" basically introduces what is this web application and how to use it. 

"search.php" contains a form with JS validation that allows users to find the book by optionally filling in keyword (vague search), title, author, publisher, category and ISBN, this 6 fields. On submit, the form uses cURL and HTTP GET to get the JSON data from Google book API. It uses DELETE query to clear the history. Then it extracts useful information like title, author, ISBN, etc. from the JSON data and saves them to database by INSERT query. Also, it redirects to "result.php" after submitted. 

"result.php" shows the result of the search from database by SELECT query. It will send a message for nothing found, then redirect to "search.php". Else, it lists rows of book information which contain a link to preview the book. 
