<?php
session_start();

date_default_timezone_set("Asia/Jakarta");
define('namaweb', 'ADMIN');

                        $days = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];

                        $months = [
                            '01' => 'Januari',
                            '02' => 'Februari',
                            '03' => 'Maret',
                            '04' => 'April',
                            '05' => 'Mei',
                            '06' => 'Juni',
                            '07' => 'Juli',
                            '08' => 'Agustus',
                            '09' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember'
                        ];
function generateRandomDate() {
    global $months, $days;

    $randomDay = rand(1, 31); 
    $randomMonth = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT); 
    $randomDate = '2024-' . $randomMonth . '-' . str_pad($randomDay, 2, '0', STR_PAD_LEFT);

    while (!checkdate((int)$randomMonth, $randomDay, 2024)) {
        $randomDay = rand(1, 31); 
        $randomDate = '2024-' . $randomMonth . '-' . str_pad($randomDay, 2, '0', STR_PAD_LEFT);
    }

    $timestamp = strtotime($randomDate);
    $dayName = $days[date('l', $timestamp)]; 
    $day = date('d', $timestamp); 
    $month = $months[date('m', $timestamp)];
    $year = date('Y', $timestamp); 

    return $dayName . ', ' . $day . ' ' . $month . ' ' . $year;
}
$date1 = generateRandomDate();
$date2 = generateRandomDate();

while ($date1 === $date2) {
    $date2 = generateRandomDate();
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

$koneksi = new mysqli($host, $username, $password, $dbname);

?>