<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

$items = [
    1 => ['name' => 'Espada', 'price' => 50],
    2 => ['name' => 'Escudo', 'price' => 30],
    3 => ['name' => 'Poção', 'price' => 10],
];

$itemId = isset($_GET['item']) ? (int) $_GET['item'] : null;
$playerCoins = isset($_GET['coins']) ? (int) $_GET['coins'] : null;

if ($itemId === null || $playerCoins === null) {
    echo json_encode(['error' => 'Parâmetros inválidos']);
    exit;
}

if (!array_key_exists($itemId, $items)) {
    echo json_encode(['error' => 'Item não encontrado']);
    exit;
}

$item = $items[$itemId];
if ($playerCoins >= $item['price']) {
    echo json_encode([
        'success' => true,
        'item' => $item,
        'remaining_coins' => $playerCoins - $item['price']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Moedas insuficientes'
    ]);
}
?>