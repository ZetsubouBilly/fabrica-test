<!DOCTYPE html>
<html>
<head>
    <title>Test Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JK"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Test Task</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Add new record</h2>
            <form method="post" action="add_user.php" id="add-user-form">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" class="form-control" name="comment" id="comment" required>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Last 50 records</h2>
            <div class="table-responsive">
                <table class="table" id="users-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <?php include 'get_users.php'; ?>
                        
                        <th>Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JK"
        crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    // AJAX-запрос для добавления новой записи в таблицу
    $('#add-user-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#users-table tbody').prepend(response);
                $('#add-user-form')[0].reset();
            }
        });
    });

    // AJAX-запрос для обновления таблицы на экране
    setInterval(function() {
        $.ajax({
            type: 'GET',
            url: 'get_users.php',
            success: function(response) {
                $('#users-table tbody').html(response);
            }
        });
    }, 5000);
});
</script>
</body>
</html>