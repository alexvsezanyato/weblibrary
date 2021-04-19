<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Unreturned books</title>
    <style media="screen">
      .books-list {
        width: 100%;
      }
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
      .content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
      }
      .content > * {
        min-width: 700px;
      }
      body, html, .content {
        height: 100%;
        padding: 0;
        margin: 0;
      }
      .bottom-block {
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <div class="content">
      <div class="top-block">
        <h2><a href="/">Your library</a> (<a href="/update.php">Update</a>) / <a href="/student-history.php">Student history</a> / Unreturned books</h2>
        <hr>
        <p>Самый злостный читатель: <?php
        $user = "user";
        $password = "DiffPass!1";
        $database = "librarytestex";

        try {
          $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

          foreach ($db->query("SELECT * FROM (
            SELECT COUNT(*) as count, studentID, students.name, students.surname, students.patronymic FROM givenBooks
            JOIN students ON students.id=givenBooks.studentID
            WHERE actionID NOT IN ( SELECT actionID FROM returnedBooks )
            GROUP BY studentID) x WHERE x.count=(
              SELECT COUNT(*) FROM givenBooks
              WHERE actionID NOT IN ( SELECT actionID FROM returnedBooks )
              GROUP BY studentID ORDER BY `COUNT(*)`
              DESC LIMIT 1)") as $student) {
                echo "{$student['name']} {$student['surname']} {$student['patronymic']} <br>";
              }



        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        ?></p>
        <table class="books-list">
          <tr class="table-tr-title">
            <td>Student</td>
            <td>Unreturned books</td>
          </tr>
          <?php

          $i = 0;
          $max = 10;
          $from = is_numeric($_GET['from']) ? (int) $_GET['from'] : 1;

            $query = "SELECT * FROM students
              JOIN givenBooks ON givenBooks.studentID=students.id
              WHERE givenBooks.actionID NOT IN (SELECT actionID FROM returnedBooks)
              ORDER BY students.id LIMIT $max OFFSET " . ($from - 1);

            $rows = $db-> query($query);

            foreach($rows as $student) {
              //if ($i >= $max) break;
              //$i++;

              $unreturnedQuery = "SELECT books.name, givenBooks.date FROM books
                JOIN givenBooks ON books.id=givenBooks.bookID
                JOIN students ON students.id=givenBooks.studentID
                WHERE students.id={$student['id']}
                AND givenBooks.actionID NOT IN (SELECT actionID FROM returnedBooks)";

              $unreturned = $db->query($unreturnedQuery);

              if (!$unreturned->rowCount()) continue;

              echo "<tr>";
              echo "<td><a href='/student-history.php?id={$student['id']}'>{$student['name']} {$student['surname']} {$student['patronymic']}</a></td>";
              echo "<td>";
              echo "<ul>";
              foreach($unreturned as $book) {
                echo "<li>{$book['name']} ({$book['date']})</li>";
              }
              echo "</ul>";
              echo "</td>";
              echo "</tr>";
            }
          ?>
        </table>
      </div>
      <div class="bottom-block">
        <p><?php
        $nextFrom = $from + $max;
        $prevFrom = ($from - $max > 1) ? $from - $max : 1;

        if ($from > 1) echo "<a href='/given-books.php?from=$prevFrom'>Previous ones</a> / ";
        else echo "<a href='/given-books.php?from=$prevFrom' class='disabled'>Previous ones</a> / ";

        try {
            $prevStudentsQuery = "SELECT COUNT(*) FROM (SELECT * FROM students
              JOIN givenBooks ON givenBooks.studentID=students.id
              WHERE givenBooks.actionID NOT IN (SELECT actionID FROM returnedBooks)
              ORDER BY students.id LIMIT $max OFFSET " . ($nextFrom - 1) . ") students";
            $result = $db->query($prevStudentsQuery);

            if ((int) $result->fetch()['COUNT(*)'] != 0)
              echo "<a href='/given-books.php?from=$nextFrom'>Next ones</a>";
            else
              echo "<a href='/given-books.php?from=$nextFrom' class='disabled'>Next ones</a>";

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        ?></p>
      </div>
    </div>
  </body>
</html>
