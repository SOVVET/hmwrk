<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работы и даты</title>
</head>
<body>
    <h1>Форма ввода данных</h1>
    
    <form action="process.php" method="post">
        <label for="works">Наименование работ:</label>
        <input type="text" name="works" required>

        <label for="start_date">Дата начала работ:</label>
        <input type="date" name="start_date" required>

        <label for="end_date">Дата завершения работ:</label>
        <input type="date" name="end_date" required>

        <button type="submit">Добавить работы</button>
    </form>

    <h2>Содержимое таблицы БД:</h2>
    <?php
        // Вывод содержимого таблицы БД отсортированного по дням в обратном порядке
        // Подключение к базе данных
        $conn = new mysqli("localhost", "root", "root", "dz3");

        // Проверка соединения
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Выполнение SQL-запроса
        $result = $conn->query("SELECT * FROM work ORDER BY works_day DESC");

        // Вывод данных в таблице
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Наименование работ</th><th>Дата работ</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['works'] . "</td><td>" . $row['works_day'] . "</td></tr>";
        }

        echo "</table>";

        // Закрытие соединения
        $conn->close();
    ?>
</body>
</html>
