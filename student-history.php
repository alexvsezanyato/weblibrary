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
      a.disabled {
        pointer-events: none; /* делаем элемент неактивным для взаимодействия */
        cursor: default; /*  курсор в виде стрелки */
        color: #999;/* цвет текста серый */
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <h2><a href="/">Your library</a> (<a href="/update.php">Update</a>) / Student history / <a href="/given-books.php">Unreturned books</a></h2>
    <hr>
    Student search by id:
    <input id="input-student-id" class="input" placeholder="Student id">
    <button id="find-student" class="submit" formmethod="post">Find</button>

    <script type="text/javascript">
      input = document.querySelector("#input-student-id");
      button = document.querySelector("#find-student");
      button.addEventListener("click", function(){
        value = input.value;
        if (!isNaN(value)) {
          window.location = "/student-history.php?id=" + value;
        } else {
          alert("Wrong id");
        }
      });
    </script>

    <h2><?php if ($_GET['id']):
    $db = 0;
    $user = "user";
    $password = "DiffPass!1";
    $database = "librarytestex";
    $i = 0;
    $max = 10;
    $from = is_numeric($_GET['from']) ? (int) $_GET['from'] : 1;

    try {
      $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
      $r = $db->query("SELECT * FROM students WHERE id={$_GET['id']}");
      $student = $r->fetch();
      echo "{$student['name']} {$student['surname']} {$student['patronymic']}";
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    endif;?></h2>
    <table class="books-list">
      <tr class="table-tr-title">
        <td>Book name</td>
        <td>Given</td>
        <td>Returned</td>
      </tr>
      <?php
      if ($_GET['id']) {

        $booksQuery = "SELECT * FROM books
          JOIN givenBooks ON books.id=givenBooks.bookID
          WHERE givenBooks.studentID={$_GET['id']}
          ORDER BY id
          LIMIT $max OFFSET " . ($from - 1);

        foreach ($db-> query($booksQuery) as $e) {
          echo "<tr>";
          echo "<td>{$e['name']}</td>";
          echo "<td>{$e['date']}</td>";

          $unreturnedQuery = "SELECT * FROM returnedBooks
            WHERE returnedBooks.actionID={$e['actionID']}";

          $uqResults = $db->query($unreturnedQuery);
          $uqCount = $uqResults->rowCount();
          $uqRow = $uqResults->fetch();

          if ($uqCount) echo "<td>{$uqRow['date']}</td>";
          else echo "<td>Unreturned</td>";

          echo "</tr>";
        }
      }
      ?>
    </table>
    <?php if (is_numeric($_GET['id'])):
    $nextFrom = $from + $max;
    $prevFrom = ($from - $max > 1) ? $from - $max : 1;

    $prevFromLink = "/student-history.php";
    if (is_numeric($_GET['id']))
      $prevFromLink = $prevFromLink . "?id=" . $_GET['id'];
    if (is_numeric($_GET['id']) && $_GET['from'] - $max > 1)
      $prevFromLink = $prevFromLink . "&from=" . ($_GET['from'] - $max);
    else $prevFromLink = $prevFromLink . "&from=1";

    if ($from > 1) echo "<a href='$prevFromLink'>Previous ones</a> / ";
    else echo "<a href='/?from=$prevFromLink' class='disabled'>Previous ones</a> / ";

    try {
        $nextBooksQuery = "SELECT COUNT(*) FROM
          (SELECT * FROM books
          JOIN givenBooks ON books.id=givenBooks.bookID
          WHERE givenBooks.studentID={$_GET['id']}
          ORDER BY id
          LIMIT $max OFFSET " . ($nextFrom - 1) . ") books";
        $result = $db-> query($nextBooksQuery)-> fetch();

        $nextFromLink = "/student-history.php?id={$_GET['id']}&from=" . ($from + $max);

        if ((int) $result['COUNT(*)'] != 0)
          echo "<a href='$nextFromLink'>Next ones</a>";
        else
          echo "<a href='$nextFromLink' class='disabled'>Next ones</a>";



    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    endif; ?>
  </body>
</html>
