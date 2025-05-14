<?php
// compile.php
// WARNING: Running user code is dangerous. This example has no sandboxing or proper security measures.
// Do not use this code in a production environment.

function runPHP($code)
{
    ob_start();
    try {
        // Prepend closing tag to allow for normal PHP syntax in the user input
        eval("?>" . $code);
    } catch (Throwable $e) {
        echo "PHP Error: " . $e->getMessage();
    }
    return ob_get_clean();
}

function runJS($code)
{
    $temp_file = tempnam(sys_get_temp_dir(), 'JS_') . '.js';
    file_put_contents($temp_file, $code);
    $command = "node " . escapeshellarg($temp_file) . " 2>&1";
    $output = shell_exec($command);
    unlink($temp_file);
    return $output;
}

function runPython($code)
{
    $temp_file = tempnam(sys_get_temp_dir(), 'PY_') . '.py';
    file_put_contents($temp_file, $code);
    // Adjust the python command if necessary (python3 vs python)
    $command = "python " . escapeshellarg($temp_file) . " 2>&1";
    $output = shell_exec($command);
    unlink($temp_file);
    return $output;
}

function runJava($code)
{
    // Expecting a public class named Main in the Java code.
    $temp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'java_run_' . uniqid();
    mkdir($temp_dir);
    $java_file = $temp_dir . DIRECTORY_SEPARATOR . "Main.java";
    file_put_contents($java_file, $code);

    // Compile Java code
    $compile_command = "javac " . escapeshellarg($java_file) . " 2>&1";
    $compile_output = shell_exec($compile_command);
    if (!empty($compile_output)) {
        // Clean up
        array_map('unlink', glob("$temp_dir/*"));
        rmdir($temp_dir);
        return "Compilation Error:\n" . $compile_output;
    }
    // Run Java if compiled successfully
    $run_command = "java -cp " . escapeshellarg($temp_dir) . " Main 2>&1";
    $output = shell_exec($run_command);

    // Clean up
    array_map('unlink', glob("$temp_dir/*"));
    rmdir($temp_dir);

    return $output;
}

function runC($code)
{
    $temp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "c_run_" . uniqid();
    mkdir($temp_dir);
    $c_file = $temp_dir . DIRECTORY_SEPARATOR . "program.c";
    file_put_contents($c_file, $code);

    $executable = $temp_dir . DIRECTORY_SEPARATOR . "program_exec";
    $compile_command = "gcc " . escapeshellarg($c_file) . " -o " . escapeshellarg($executable) . " 2>&1";
    $compile_output = shell_exec($compile_command);
    if (!empty($compile_output)) {
        array_map('unlink', glob("$temp_dir/*"));
        rmdir($temp_dir);
        return "Compilation Error:\n" . $compile_output;
    }
    $output = shell_exec(escapeshellcmd($executable) . " 2>&1");

    array_map('unlink', glob("$temp_dir/*"));
    rmdir($temp_dir);
    return $output;
}

function runCpp($code)
{
    $temp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "cpp_run_" . uniqid();
    mkdir($temp_dir);
    $cpp_file = $temp_dir . DIRECTORY_SEPARATOR . "program.cpp";
    file_put_contents($cpp_file, $code);

    $executable = $temp_dir . DIRECTORY_SEPARATOR . "program_exec";
    $compile_command = "g++ " . escapeshellarg($cpp_file) . " -o " . escapeshellarg($executable) . " 2>&1";
    $compile_output = shell_exec($compile_command);
    if (!empty($compile_output)) {
        array_map('unlink', glob("$temp_dir/*"));
        rmdir($temp_dir);
        return "Compilation Error:\n" . $compile_output;
    }
    $output = shell_exec(escapeshellcmd($executable) . " 2>&1");

    array_map('unlink', glob("$temp_dir/*"));
    rmdir($temp_dir);
    return $output;
}

function runHTML($code)
{
    // HTML is not "compiled" because it’s rendered by a browser.
    // Here we simply return the code, escaped to preserve HTML tags in the output.
    return htmlspecialchars($code);
}

// Main controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $language = $_POST['language'] ?? '';
    $code = $_POST['code'] ?? '';

    if (empty($language) || empty($code)) {
        echo "Error: Missing language or code input.";
        exit;
    }

    $result = "";
    switch (strtolower($language)) {
        case 'php':
            $result = runPHP($code);
            break;
        case 'js':
        case 'javascript':
            $result = runJS($code);
            break;
        case 'python':
            $result = runPython($code);
            break;
        case 'java':
            $result = runJava($code);
            break;
        case 'c':
            $result = runC($code);
            break;
        case 'c++':
        case 'cpp':
            $result = runCpp($code);
            break;
        case 'html':
            $result = runHTML($code);
            break;
        default:
            $result = "Error: Unsupported language.";
            break;
    }

    echo $result;
} else {
    echo "Error: Invalid request method.";
}
