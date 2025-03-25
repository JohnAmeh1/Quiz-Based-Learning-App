<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $code = $data['code'];

    // Detect the language of the code snippet
    $language = detectLanguage($code);

    // Execute the code based on the detected language
    $output = executeCode($code, $language);

    // Return the output or error
    echo json_encode($output);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

/**
 * Detects the programming language of the code snippet.
 */
function detectLanguage($code)
{
    // Trim whitespace and normalize the code
    $code = trim($code);

    // Language detection based on code patterns
    if (strpos($code, '<?php') !== false) {
        return 'php';
    } elseif (strpos($code, 'print(') !== false || strpos($code, 'def ') !== false) {
        return 'python';
    } elseif (strpos($code, 'console.log(') !== false || strpos($code, 'function ') !== false) {
        return 'javascript';
    } elseif (strpos($code, 'puts ') !== false || strpos($code, 'def ') !== false) {
        return 'ruby';
    } elseif (strpos($code, 'echo ') !== false || strpos($code, '#!/bin/bash') !== false) {
        return 'bash';
    } elseif (strpos($code, 'System.out.println') !== false || strpos($code, 'public class') !== false) {
        return 'java';
    } elseif (strpos($code, 'cout ') !== false || strpos($code, '#include') !== false) {
        return 'cpp';
    } elseif (strpos($code, 'printf ') !== false || strpos($code, '#include') !== false) {
        return 'c';
    } elseif (strpos($code, 'println!') !== false || strpos($code, 'fn main()') !== false) {
        return 'rust';
    } elseif (strpos($code, 'package ') !== false || strpos($code, 'import "fmt"') !== false) {
        return 'go';
    } elseif (strpos($code, '<?xml') !== false || strpos($code, '<html>') !== false || strpos($code, '<head>') !== false || strpos($code, '<body>') !== false || strpos($code, '<!DOCTYPE html>') !== false) {
        return 'html';
    } elseif (strpos($code, 'SELECT ') !== false || strpos($code, 'INSERT INTO') !== false) {
        return 'sql';
    } elseif (strpos($code, 'fun ') !== false || strpos($code, 'println(') !== false) {
        return 'kotlin';
    } elseif (strpos($code, 'puts ') !== false || strpos($code, 'module ') !== false) {
        return 'elixir';
    } elseif (strpos($code, 'say ') !== false || strpos($code, 'my ') !== false) {
        return 'perl';
    } elseif (strpos($code, 'disp(') !== false || strpos($code, 'function ') !== false) {
        return 'matlab';
    } elseif (strpos($code, 'print ') !== false || strpos($code, 'let ') !== false) {
        return 'swift';
    } elseif (strpos($code, 'print ') !== false || strpos($code, 'var ') !== false) {
        return 'dart';
    } elseif (strpos($code, 'print ') !== false || strpos($code, 'let ') !== false) {
        return 'typescript';
    } elseif (strpos($code, 'print ') !== false || strpos($code, 'let ') !== false) {
        return 'scala';
    } elseif (strpos($code, 'print ') !== false || strpos($code, 'let ') !== false) {
        return 'haskell';
    } else {
        return 'unknown';
    }
}

/**
 * Executes the code based on the detected language.
 */
function executeCode($code, $language)
{
    // Map languages to their respective Docker images
    $languageImages = [
        'php' => 'php:latest',
        'python' => 'python:latest',
        'javascript' => 'node:latest',
        'ruby' => 'ruby:latest',
        'bash' => 'bash:latest',
        'java' => 'openjdk:latest',
        'cpp' => 'gcc:latest',
        'c' => 'gcc:latest',
        'rust' => 'rust:latest',
        'go' => 'golang:latest',
        'html' => null, // Non-executable
        'sql' => null, // Non-executable
        'kotlin' => 'openjdk:latest', // Kotlin runs on JVM
        'elixir' => 'elixir:latest',
        'perl' => 'perl:latest',
        'matlab' => null, // MATLAB requires a license
        'swift' => 'swift:latest',
        'dart' => 'dart:latest',
        'typescript' => 'node:latest', // Transpiled to JavaScript
        'scala' => 'openjdk:latest', // Scala runs on JVM
        'haskell' => 'haskell:latest',
    ];

    // Non-executable languages
    if ($language === 'html' || $language === 'sql') {
        return ['output' => $code];
    }

    // Check if the language is supported
    if (!isset($languageImages[$language])) {
        return ['error' => 'Unsupported language'];
    }

    // Create a temporary file with the code
    $tempFile = tempnam(sys_get_temp_dir(), 'code');
    file_put_contents($tempFile, $code);

    // Docker command to execute the code
    $dockerImage = $languageImages[$language];
    $command = "docker run --rm -v $tempFile:/code $dockerImage ";

    // Language-specific execution commands
    switch ($language) {
        case 'php':
            // Remove <?php and tags for eval()
            $code = str_replace(['<?php', '?>'], '', $code);

            // For PHP, we need to execute the code and capture the output
            ob_start();
            try {
                eval($code); // Execute PHP code
                $output = ob_get_clean();
                return ['output' => $output];
            } catch (Throwable $e) {
                ob_end_clean();
                return ['error' => $e->getMessage()];
            }
            break;

        case 'python':
            $command .= 'python /code';
            break;
        case 'javascript':
            $command .= 'node /code';
            break;
        case 'ruby':
            $command .= 'ruby /code';
            break;
        case 'bash':
            $command .= 'bash /code';
            break;
        case 'java':
            $command .= 'sh -c "javac /code && java Main"';
            break;
        case 'cpp':
            $command .= 'sh -c "g++ /code -o /tmp/a.out && /tmp/a.out"';
            break;
        case 'c':
            $command .= 'sh -c "gcc /code -o /tmp/a.out && /tmp/a.out"';
            break;
        case 'rust':
            $command .= 'sh -c "rustc /code -o /tmp/a.out && /tmp/a.out"';
            break;
        case 'go':
            $command .= 'go run /code';
            break;
        case 'kotlin':
            $command .= 'sh -c "kotlinc /code -include-runtime -d /tmp/a.jar && java -jar /tmp/a.jar"';
            break;
        case 'elixir':
            $command .= 'elixir /code';
            break;
        case 'perl':
            $command .= 'perl /code';
            break;
        case 'swift':
            $command .= 'swift /code';
            break;
        case 'dart':
            $command .= 'dart /code';
            break;
        case 'typescript':
            $command .= 'sh -c "tsc /code && node /code.js"';
            break;
        case 'scala':
            $command .= 'sh -c "scalac /code && scala Main"';
            break;
        case 'haskell':
            $command .= 'sh -c "ghc /code -o /tmp/a.out && /tmp/a.out"';
            break;
        default:
            return ['error' => 'Unsupported language'];
    }

    // Execute the command and capture output
    exec($command, $output, $returnCode);

    // Clean up the temporary file
    unlink($tempFile);

    // Handle execution errors
    if ($returnCode !== 0) {
        return ['error' => implode("\n", $output)];
    }

    return ['output' => implode("\n", $output)];
}