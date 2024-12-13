<?php
// Шлях до файлу з подіями
$eventsFile = 'events.json';

// Перевірка наявності файлу
if (!file_exists($eventsFile)) {
    echo json_encode([]);
    exit;
}

// Зчитування подій із файлу
$events = json_decode(file_get_contents($eventsFile), true);
if (!is_array($events)) {
    echo json_encode([]);
    exit;
}

echo json_encode($events);
