<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Получение последних 50 записей из таблицы
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 50";
$result = mysqli_query($conn, $sql);

// Вывод таблицы с данными
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  foreach ($row as $key => $value) {
    echo "<td>" . $value . "</td>";
  }
  echo "</tr>";
}

mysqli_close($conn);
?>