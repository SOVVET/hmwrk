<!DOCTYPE html>
<html>
<head>
    <title>Отчет о неделях</title>
    <meta charset="UTF-8">
</head>
<body>

<?php
// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedYear = $_POST["year"];
    $selectedMonth = $_POST["month"];

    // Проверка на корректность выбранных данных
    if (is_numeric($selectedYear) && is_numeric($selectedMonth) && $selectedMonth >= 1 && $selectedMonth <= 12) {
        // Получение первого и последнего дня выбранного месяца
        $firstDayOfMonth = date("Y-m-01", strtotime("$selectedYear-$selectedMonth-01"));
        $lastDayOfMonth = date("Y-m-t", strtotime("$selectedYear-$selectedMonth-01"));

        // Подсчет целых недель
        $start = new DateTime($firstDayOfMonth);
        $end = new DateTime($lastDayOfMonth);
        $interval = $start->diff($end);
        $weeks = floor($interval->days / 7);

        // Определение дня недели для первого и последнего дней месяца
        $firstDayOfWeek = getRussianDayOfWeek(date("N", strtotime($firstDayOfMonth)));
        $lastDayOfWeek = getRussianDayOfWeek(date("N", strtotime($lastDayOfMonth)));

        // Отображение результата
        echo "<h2>Отчет за $selectedYear год, $selectedMonth месяц</h2>";
        echo "<p>Целых недель в месяце: $weeks</p>";
        echo "<p>Первый день месяца: $firstDayOfWeek</p>";
        echo "<p>Последний день месяца: $lastDayOfWeek</p>";
    } else {
        echo "<p>Ошибка: Некорректные данные</p>";
    }
}

function getRussianDayOfWeek($dayNumber) {
    $daysOfWeek = [
        1 => 'понедельник', 2 => 'вторник', 3 => 'среда',
        4 => 'четверг', 5 => 'пятница', 6 => 'суббота', 7 => 'воскресенье'
    ];

    return $daysOfWeek[$dayNumber];
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="year">Год:</label>
    <select name="year" id="year">
        <?php
        // Заполнение выпадающего списка годами с 2001 по 2019
        for ($i = 2001; $i <= 2019; $i++) {
            echo "<option value=\"$i\">$i</option>";
        }
        ?>
    </select>

    <label for="month">Месяц:</label>
    <select name="month" id="month">
        <?php
        // Заполнение выпадающего списка месяцами с января по декабрь
        $months = [
            1 => 'январь', 2 => 'февраль', 3 => 'март',
            4 => 'апрель', 5 => 'май', 6 => 'июнь',
            7 => 'июль', 8 => 'август', 9 => 'сентябрь',
            10 => 'октябрь', 11 => 'ноябрь', 12 => 'декабрь'
        ];

        foreach ($months as $monthNumber => $monthName) {
            echo "<option value=\"$monthNumber\">$monthName</option>";
        }
        ?>
    </select>

    <input type="submit" value="Сгенерировать отчет">
</form>

</body>
</html>
