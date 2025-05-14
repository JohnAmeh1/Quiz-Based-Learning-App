<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Configuration settings
$config = [
    'timeout' => 5, // Execution timeout in seconds
    'memory_limit' => '128M', // Memory limit
    'max_filesize' => 100000, // Max code size (bytes)
    'allowed_languages' => ['python', 'javascript', 'php', 'html', 'java', 'c', 'cpp'],
    'sandbox_path' => '/tmp/', // Change to '/tmp/sandbox/' for Linux
    // 'sandbox_path' => 'C:/xampp/tmp/sandbox/', // Change to '/tmp/sandbox/' for Linux
];

// Create sandbox directory if it doesn't exist
if (!file_exists($config['sandbox_path'])) {
    mkdir($config['sandbox_path'], 0777, true);
}

// Get input data
$input = json_decode(file_get_contents('php://input'), true);
$code = $input['code'] ?? '';
$language = strtolower($input['language'] ?? '');

// Validate input
if (empty($code) || empty($language)) {
    http_response_code(400);
    echo json_encode(['error' => 'Code and language parameters are required']);
    exit;
}
if (strlen($code) > $config['max_filesize']) {
    http_response_code(400);
    echo json_encode(['error' => 'Code size exceeds maximum allowed']);
    exit;
}
if (!in_array($language, $config['allowed_languages'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Language not supported']);
    exit;
}

// Sanitize PHP code (basic protection)
if ($language === 'php') {
    $code = preg_replace('/<\?php/i', '<?php', $code); // Normalize PHP tags
    $code = str_replace('<?=', '<?php echo ', $code); // Replace short echo tags
}

// Execute code
try {
    $result = execute_code($code, $language, $config);
    echo json_encode($result);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Execution failed: ' . $e->getMessage()]);
}

/**
 * Execute code in a language-specific sandbox
 */
function execute_code($code, $language, $config)
{
    $output = '';
    $error = '';
    $filename = '';
    $command = '';

    // Create unique filename
    $uniqid = uniqid();
    $sandboxFile = $config['sandbox_path'] . $uniqid;

    try {
        switch ($language) {
            case 'python':
                $filename = $sandboxFile . '.py';
                file_put_contents($filename, $code);
                $command = "python " . escapeshellarg($filename) . " 2>&1";
                break;

            case 'javascript':
                $filename = $sandboxFile . '.js';
                file_put_contents($filename, $code);
                $command = "node " . escapeshellarg($filename) . " 2>&1";
                break;

            case 'php':
                $filename = $sandboxFile . '.php';
                file_put_contents($filename, $code);
                $command = "php " . escapeshellarg($filename) . " 2>&1";
                break;

            case 'html':
                // Directly return the HTML content for client-side rendering
                return ['output' => $code, 'html' => true];

            case 'java':
                $filename = $sandboxFile . '.java';
                $classname = 'Main';
                file_put_contents($filename, $code);
                // Compile Java code
                $compileCmd = "javac " . escapeshellarg($filename) . " 2>&1";
                $compileOutput = shell_exec($compileCmd);
                if ($compileOutput) {
                    return ['error' => $compileOutput];
                }
                $command = "cd " . escapeshellarg($config['sandbox_path']) . " && java " . escapeshellarg($classname) . " 2>&1";
                break;

            case 'c':
                $filename = $sandboxFile . '.c';
                $outputFile = $sandboxFile . '_out.exe';
                file_put_contents($filename, $code);
                $compileCmd = "gcc " . escapeshellarg($filename) . " -o " . escapeshellarg($outputFile) . " 2>&1";
                $compileOutput = shell_exec($compileCmd);
                if ($compileOutput) {
                    return ['error' => $compileOutput];
                }
                $command = escapeshellarg($outputFile) . " 2>&1";
                break;

            case 'cpp':
                $filename = $sandboxFile . '.cpp';
                $outputFile = $sandboxFile . '_out.exe';
                file_put_contents($filename, $code);
                $compileCmd = "g++ " . escapeshellarg($filename) . " -o " . escapeshellarg($outputFile) . " 2>&1";
                $compileOutput = shell_exec($compileCmd);
                if ($compileOutput) {
                    return ['error' => $compileOutput];
                }
                $command = escapeshellarg($outputFile) . " 2>&1";
                break;

            default:
                throw new Exception("Unsupported language");
        }

        if (!empty($command)) {
            // Set execution time limit and memory limit
            ini_set('max_execution_time', $config['timeout']);
            ini_set('memory_limit', $config['memory_limit']);

            // Execute command with timeout handling
            $descriptors = [
                0 => ['pipe', 'r'], // stdin
                1 => ['pipe', 'w'], // stdout
                2 => ['pipe', 'w'], // stderr
            ];

            $process = proc_open($command, $descriptors, $pipes);

            if (!is_resource($process)) {
                throw new Exception("Failed to execute code");
            }

            // Handle timeout
            $startTime = time();
            $timeout = false;
            while (true) {
                $status = proc_get_status($process);
                if (!$status['running']) {
                    break;
                }
                if (time() - $startTime > $config['timeout']) {
                    $timeout = true;
                    proc_terminate($process);
                    break;
                }
                usleep(100000); // Sleep for 100ms
            }

            $output = stream_get_contents($pipes[1]);
            $errorOutput = stream_get_contents($pipes[2]);
            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            if ($timeout) {
                throw new Exception("Execution timed out after {$config['timeout']} seconds");
            }

            if ($errorOutput) {
                $error .= $errorOutput;
            }
        }
    } finally {
        // Clean up files
        if (file_exists($filename)) {
            unlink($filename);
        }

        // Clean up compiled files for compiled languages
        if ($language === 'java' && file_exists($sandboxFile . '.class')) {
            unlink($sandboxFile . '.class');
        }
        if (($language === 'c' || $language === 'cpp') && file_exists($sandboxFile . '_out.exe')) {
            unlink($sandboxFile . '_out.exe');
        }
    }

    return [
        'output' => $output,
        'error' => $error
    ];
}
