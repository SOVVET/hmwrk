<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем выбранный год и месяц из формы
    $selectedYear = $_POST['year'];
    $selectedMonth = $_POST['month'];

    // Получаем первый и последний день месяца
    $firstDayOfMonth = date('Y-m-01', strtotime("$selectedYear-$selectedMonth-01"));
    $lastDayOfMonth = date('Y-m-t', strtotime("$selectedYear-$selectedMonth-01"));

    // Подсчитываем количество целых недель
    $numberOfWeeks = ceil((strtotime($lastDayOfMonth) - strtotime($firstDayOfMonth)) / (7 * 24 * 3600));

    // Определяем день недели для первого и последнего дня месяца
    $firstDayOfWeek = date('l', strtotime($firstDayOfMonth));
    $lastDayOfWeek = date('l', strtotime($lastDayOfMonth));

    // Выводим результат
    echo "В выбранном месяце ($selectedYear/$selectedMonth):<br>";
    echo "1) Количество целых недель: $numberOfWeeks<br>";
    echo "2) День недели первого дня месяца: $firstDayOfWeek<br>";
    echo "3) День недели последнего дня месяца: $lastDayOfWeek<br>";
}
?>
