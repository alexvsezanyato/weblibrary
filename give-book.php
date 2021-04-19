<?php

if (!$_POST['bookID'] || !$_POST['studentID']) die();

$bookID = $_POST['bookID'];
$studentID = $_POST['studentID'];
$user = "user";
$password = "DiffPass!1";
$database = "librarytestex";

try {
  // connection
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

  // ..
  $sql = "INSERT INTO givenBooks (bookID, studentID, date) VALUES (?, ?, CURRENT_DATE())";
  $result = $db->prepare($sql)->execute([$bookID, $studentID]);
  if (!$result) echo "fail";
  else echo "success";

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
