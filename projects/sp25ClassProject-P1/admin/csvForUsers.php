<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=users.csv');
$output = fopen('php://output', 'w');


fputcsv($output, ['ID', 'First Name', 'Last Name', 'Phone', 'Email', 'Gender', 'level', 'password', 'user type']);

include '../connection.php';
$data = mysqli_query($dbc, "SELECT * FROM users");
foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);
