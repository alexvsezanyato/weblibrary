<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update your library</title>
    <script src="http://code.jquery.com/jquery-1.8.3.js"/></script>
  </head>
  <body>
    <h2><a href="/">Your library</a> / Update</h2>
    <hr>
    <div class="add-book">
      <p>Add a book</p>
      <input type="text" name="" placeholder="">
      <button class="delete-button" type="button" name="button">Delete book</button>
      <br>
      <p>Authors</p>
      <ol>
        <li><input type="text" name="" placeholder="Author id"></li>
      </ol>
      <button type="button" name="button">Add author</button>
      <br>
      <p>Publisher</p>
      <ol>
        <li><input type="text" name="" placeholder="Publisher id"></li>
      </ol>
      <button type="button" name="button">Add publisher</button>
      <br>
    </div>
    <hr>
    <div class="delete-book">
      <p>Delete a book</p>
      <input type="text" name="" placeholder="Book id">
      <button class="delete-button" type="button" name="button">Delete</button>
    </div>
    <hr>
    <div class="add-author">
      <p>Add / delete an author</p>
      <input class="author-name" type="text" name="" placeholder="Name">
      <input class="author-surname" type="text" name="" placeholder="Surname">
      <input class="author-patronymic" type="text" name="" placeholder="Patronymic">
      <button class="add-button" type="button" name="button">Add</button>
      <br><br>
      <input type="text" name="" placeholder="Author id">
      <button class="delete-button" type="button" name="button">Delete</button>
    </div>
    <hr>
    <div class="publishers">
      <p>Add / delete a publisher</p>
      <input type="text" name="" placeholder="Name">
      <button class="add-button" type="button" name="button">Add</button>
      <br><br>
      <input type="text" name="" placeholder="Publisher id">
      <button class="delete-button" type="button" name="button">Delete</button>
    </div>
    <hr>
    <div class="give-return-book">
      <p>Give / return a book</p>
      <input id="gr-book-id" type="text" name="" placeholder="Book ID">
      <input id="gr-student-id" type="text" name="" placeholder="Student ID">
      <button id="give-book-button" class="add-button" type="button" name="button">Give</button><br>
      <input id="gr-action-id" type="text" name="" placeholder="ActionID">
      <button id="return-book-button" class="delete-button" type="button" name="button">Return</button>
    </div>
    <script>
      // script here
      $('#give-book-button').click(function(){
        var url = "/give-book.php";
        var bookID = $('#gr-book-id').val();
        var studentID = $('#gr-student-id').val();
        $.ajax(url, {
            type: 'POST',  // http method
            data: { studentID: studentID, bookID: bookID },  // data to submit
            success: function (data, status, xhr) {
                alert("Status: " + status + ". Data: " + data);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('Error' + errorMessage);
            }
        });
      });

      $('#return-book-button').click(function(){
        var url = "/return-book.php";
        var actionID = $('#gr-action-id').val();
        $.ajax(url, {
            type: 'POST',  // http method
            data: { actionID: actionID },  // data to submit
            success: function (data, status, xhr) {
                alert("Status: " + status + ". Data: " + data);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('Error' + errorMessage);
            }
        });
      });
    </script>
  </body>
</html>
