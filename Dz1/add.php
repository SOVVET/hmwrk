<?php
// Подключение к базе данных
$conn = new mysqli("localhost", "root", "root", "dz1");

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Получение данных для сводной таблицы
$sql = "SELECT departments.department_name, GROUP_CONCAT(employees.full_name SEPARATOR '<br>') as employee_list
        FROM departments
        LEFT JOIN employees ON departments.id = employees.department_id
        GROUP BY departments.id";
$result = $conn->query($sql);

// Отображение сводной таблицы
echo "<table border='1'>
        <tr>
            <th>Отдел</th>
            <th>Сотрудники</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['department_name']}</td>
            <td>{$row['employee_list']}</td>
          </tr>";
}

echo "</table>";

// Форма добавления новой записи
echo "<form action='' method='post'>
        <label>Выберите отдел:</label>
        <select name='department_id'>";

$sql = "SELECT * FROM departments";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['department_name']}</option>";
}

echo "</select><br>
        <label>ФИО сотрудника:</label>
        <input type='text' name='full_name' required><br>
        <label>Должность:</label>
        <input type='text' name='position' required><br>
        <input type='submit' name='submit' value='Добавить запись'>
      </form>";

// Обработка формы
if (isset($_POST['submit'])) {
    $department_id = $_POST['department_id'];
    $full_name = $_POST['full_name'];
    $position = $_POST['position'];

    $sql = "INSERT INTO employees (department_id, full_name, position) VALUES ('$department_id', '$full_name', '$position')";
    $conn->query($sql);

    // Обновление страницы после добавления записи
    echo "<meta http-equiv='refresh' content='0'>";
}

// Закрытие соединения
$conn->close();
?>
