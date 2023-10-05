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

  // Вывод добавленной записи на экран
  $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo "<tr><td>" . $row["id"] . "</td><td>" . $row["comment"] . "</td></tr>";
  exit();
}

// Получение последних 50 записей из таблицы
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 50";
$result = mysqli_query($conn, $sql);
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
  $users[] = $row;
}

// Функция для генерации полей ввода на основе структуры таблицы
function generateFields($pdo) {
  $sql = "SELECT comment FROM users";
  $result = mysqli_query($pdo, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $field = $row["comment"];
    if ($field != "id" && $field != "comment") {
      echo "<div class='form-group'>";
      echo "<label for='" . $field . "'>" . $field . "</label>";
      echo "<input type='text' class='form-control' name='" . $field . "' id='" . $field . "' required>";
      echo "</div>";
    }
  }
}

mysqli_close($conn);
?>