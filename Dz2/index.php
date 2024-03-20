<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Подсчет целых недель</title>
</head>
<body>

<h2>Выберите год и месяц:</h2>

<form method="post" action="">
    <label for="year">Год:</label>
    <select name="year" id="year">
        <?php
        // Создание списка годов от 2001 до 2019
        for ($i = 2001; $i <= 2019; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>

    <label for="month">Месяц:</label>
    <select name="month" id="month">
        <?php
        // Создание списка месяцев
        $months = [
            'Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август',
            'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];
        foreach ($months as $key => $month) {
            echo "<option value='".($key + 1)."'>$month</option>";
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Показать отчет">
</form>

<?php
// Обработка данных из формы
if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];

    // Получение количества дней в месяце и первого дня недели месяца
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstDayOfWeek = date('N', strtotime("$year-$month-01"));

    // Подсчет целых недель
    $fullWeeks = floor(($numDays - (8 - $firstDayOfWeek)) / 7);

    // Вывод отчета
    echo "<h2>Отчет за $year/$month:</h2>";
    echo "<p>Целых недель в выбранном месяце: $fullWeeks</p>";

    // Определение дня недели первого и последнего дня месяца
    $firstDayName = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'][$firstDayOfWeek - 1];
    $lastDayName = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'][date('N', strtotime("$year-$month-$numDays")) - 1];

    echo "<p>Первый день месяца: $firstDayName</p>";
    echo "<p>Последний день месяца: $lastDayName</p>";
}
?>

</body>
</html>
