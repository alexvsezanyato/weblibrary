<?php

if (!$_POST['actionID']) die();

$actionID = $_POST['actionID'];
$user = "user";
$password = "DiffPass!1";
$database = "librarytestex";

try {
  // connection
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

  // ..
  $sql = "INSERT INTO returnedBooks (actionID, date) VALUES (?, CURRENT_DATE())";
  $result = $db->prepare($sql)->execute([$actionID]);
  if (!$result) echo "fail";
  else echo "success";

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
