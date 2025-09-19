<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Configuration basique des logs
$log_file = '../logs/access.log';
$max_entries = 100;

function getSystemLogs() {
    global $log_file, $max_entries;
    
    if (!file_exists($log_file)) {
        return ['error' => 'Log file not found'];
    }
    
    $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $recent_logs = array_slice($lines, -$max_entries);
    
    $formatted_logs = [];
    foreach ($recent_logs as $line) {
        $parts = explode(' - ', $line, 3);
        if (count($parts) >= 3) {
            $formatted_logs[] = [
                'timestamp' => $parts[0],
                'level' => $parts[1],
                'message' => $parts[2]
            ];
        }
    }
    
    return $formatted_logs;
}

// API endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(getSystemLogs());
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>