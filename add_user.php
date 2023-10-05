<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получение списка полей из базы данных
  $sql = "SELECT comment FROM users";
  $result = mysqli_query($conn, $sql);
  $fields = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $fields[] = $row["comment"];
  }

  // Формирование запроса на добавление записи
  $sql = "INSERT INTO users (";
  $values = "VALUES (";
  foreach ($fields as $field) {
    if ($field != "id" && $field != "comment") {
      $sql .= $field . ",";
      $values .= "'" . $_POST[$field] . "',";
    }
  }
  $sql .= "comment) ";
  $values .= "'" . $_POST["comment"] . "')";

  // Выполнение запроса на добавление записи
  mysqli_query($conn, $sql . $values);

  // Получение последней добавленной записи
  $last_id = mysqli_insert_id($conn);
  $sql = "SELECT * FROM users WHERE id = " . $last_id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  // Вывод строки таблицы с данными
  echo "<tr>";
  foreach ($row as $key => $value) {
    echo "<td>" . $value . "</td>";
  }
  echo "</tr>";
}

mysqli_close($conn);
?>