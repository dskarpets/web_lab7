<?php
// Шлях до файлу для збереження подій
$eventsFile = 'events.json';

// Отримання даних із запиту
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['time']) || !isset($data['message'])) {
    echo json_encode(['error' => 'Некоректні дані']);
    exit;
}

$event = [
    'time' => $data['time'],
    'message' => $data['message'],
    'server_time' => date('Y-m-d H:i:s')
];

// Зчитування наявних подій із файлу
$events = [];
if (file_exists($eventsFile)) {
    $events = json_decode(file_get_contents($eventsFile), true);
    if (!is_array($events)) {
        $events = [];
    }
}

// Додавання нової події
$events[] = $event;

// Збереження подій у файл
if (file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode(['success' => true, 'server_time' => $event['server_time']]);
} else {
    echo json_encode(['error' => 'Не вдалося зберегти подію']);
}
