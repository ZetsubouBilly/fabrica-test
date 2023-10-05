// AJAX-запрос для добавления новой записи в таблицу
$(document).ready(function() {
    $('form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#users-table tbody').prepend(response);
                $('form')[0].reset();
            }
        });
    });
});

// AJAX-запрос для обновления таблицы на экране
$(document).ready(function() {
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