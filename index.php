<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your library</title>
    <style media="screen">
      .books-list td {
        padding-right: 35px;
        padding-bottom: 7px;
      }
      .table-tr-title > td {
        border-bottom: 1px solid #000;
      }
      .books-list tr:nth-of-type(odd) {
        background-color: rgba(100, 100, 100, .03);
      }
      .books-list tr:hover {
        background-color: rgba(100, 100, 100, .15);
      }
      ul, ul li {
        list-style-type: none;
        text-align: left;
        padding-left: 0;
        margin-left: 0;
      }
      a.disabled {
        pointer-events: none; /* делаем элемент неактивным для взаимодействия */
        cursor: default; /*  курсор в виде стрелки */
        color: #999;/* цвет текста серый */
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <h2>Your library (<a href="/update.php">Update</a>) / <a href="/student-history.php">Student history</a> / <a href="/given-books.php">Unreturned books</a></h2>
    <hr>
    <p>Самый популярный автор за год: <?php
    $user = "alex";
    $password = "Sfq6@8L~(peu~SX+";
    $database = "librarytestex";

    try {
      // connection
      $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    $query = "SELECT COUNT(*), authorID, authors.name, authors.surname, authors.patronymic
      FROM (
        SELECT actionID, authorID FROM givenBooks JOIN `books&authors` ON givenBooks.bookID=`books&authors`.`bookID` WHERE YEAR(givenBooks.date)=YEAR(CURRENT_DATE)
      ) x JOIN authors ON x.authorID=authors.id GROUP BY authorID ORDER BY `COUNT(*)` DESC LIMIT 1";

    foreach ($db->query($query) as $popular) {
      echo "{$popular['name']} {$popular['surname']} {$popular['patronymic']}";
    }
    ?></p>
    <table class="books-list">
      <tr class="table-tr-title">
        <td>Book name</td>
        <td>Authors</td>
        <td>Publishers</td>
        <td>Available</td>
      </tr>
      <?php
      $max = 10;

      // which rows to get
      $from = is_numeric($_GET['from']) ? (int) $_GET['from'] : 1;
      $to = $from + $max;

      // getting
      $booksQuery = "SELECT * FROM books WHERE id >= $from LIMIT $max";

      $i = 0;
      foreach($db-> query($booksQuery) as $book) {
        if ($i >= $max) break;
        $i++;

        echo "<tr>";
        echo "<td>{$book['name']}</td>";
        echo "<td>";
        echo "<ul>";

        // getting
        $authorsQuery = "SELECT * FROM `authors`
          JOIN `books&authors` AS `ba` ON `authors`.id=`ba`.authorID
          WHERE `ba`.bookID={$book['id']}";

        foreach($db-> query($authorsQuery) as $author) {
          echo "<li>{$author['name']} {$author['surname']} {$author['patronymic']}</li>";
        }

        echo "</ul>";
        echo "</td>";
        echo "<td>";
        echo "<ul>";

        $publishersQuery = "SELECT * FROM `publishers`
          JOIN `books&publishers` AS `bp`
          ON `publishers`.id=`bp`.publisherID
          WHERE `bp`.bookID={$book['id']}";

        foreach($db-> query($publishersQuery) as $publisher) {
          echo "<li>{$publisher['name']}, {$publisher['year']}</li>";
        }

        echo "</ul>";
        echo "</td>";
        echo "<td>{$book['available']}</td>";
        echo "</tr>";
      }
      ?>
    </table>
    <?php
    $nextFrom = $from + $max;
    $prevFrom = ($from - $max > 1) ? $from - $max : 1;

    if ($from > 1) echo "<a href='/?from=$prevFrom'>Previous ones</a> / ";
    else echo "<a href='/?from=$prevFrom' class='disabled'>Previous ones</a> / ";

    try {
        $prevBooksQuery = "SELECT COUNT(*) FROM books WHERE id >= $nextFrom";
        $result = $db-> query($prevBooksQuery);

        if ((int) $result->fetch()['COUNT(*)'] != 0)
          echo "<a href='/?from=$nextFrom'>Next ones</a>";
        else
          echo "<a href='/?from=$nextFrom' class='disabled'>Next ones</a>";

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
  </body>
</html>
