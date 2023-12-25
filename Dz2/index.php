<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подсчет недель</title>
</head>
<body>
    <form action="process.php" method="post">
        <label for="year">Выберите год:</label>
        <select name="year" id="year">
            <?php
            // Выводим варианты от 2001 до 2019 года
            for ($i = 2001; $i <= 2019; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            ?>
        </select>

        <label for="month">Выберите месяц:</label>
        <select name="month" id="month">
            <?php
            // С января по декабрь
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                echo "<option value=\"$i\">$monthName</option>";
            }
            ?>
        </select>

        <button type="submit">Подсчитать</button>
    </form>
</body>
</html>
