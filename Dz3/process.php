<?php
$conn = new mysqli("localhost", "root", "root", "dz3");

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Получение данных из формы
$works = $_POST['works'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Преобразование диапазона дат в набор дней
$date_range = new DatePeriod(new DateTime($start_date), new DateInterval('P1D'), new DateTime($end_date));

// Вставка данных в таблицу БД
foreach ($date_range as $day) {
    $formatted_date = $day->format('Y-m-d');
    $sql = "INSERT INTO work (works, works_day) VALUES ('$works', '$formatted_date')";
    $conn->query($sql);
}

// Закрытие соединения
$conn->close();

// Перенаправление обратно на форму
header("Location: index.php");
exit();
?>
