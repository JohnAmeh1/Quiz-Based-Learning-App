<?php
include("./header_1.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Playground</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .editor-container {
            height: 400px;
            /* Reduced height for mobile */
        }

        @media (min-width: 768px) {
            .editor-container {
                height: 600px;
                /* Larger height for desktop */
            }
        }

        .output-container {
            min-height: 150px;
        }

        .tab-active {
            border-bottom: 2px solid #4CAF50;
            color: #4CAF50;
            font-weight: 500;
        }

        .language-badge {
            top: 10px;
            right: 10px;
        }

        /* Responsive Layout */
        .main-container {
            display: flex;
            flex-direction: column;
            /* Stack vertically on mobile */
            gap: 1rem;
        }

        @media (min-width: 1024px) {
            .main-container {
                flex-direction: row;
                /* Side by side on desktop */
                gap: 2%;
            }
        }

        .editor-section {
            width: 100%;
            /* Full width on mobile */
        }

        @media (min-width: 1024px) {
            .editor-section {
                flex: 70%;
                /* 70% width on desktop */
            }
        }

        .examples-section {
            width: 100%;
            /* Full width on mobile */
        }

        @media (min-width: 1024px) {
            .examples-section {
                flex: 25%;
                /* 25% width on desktop */
            }
        }

        /* Mobile-friendly buttons */
        .action-btn {
            padding: 0.5rem 1rem;
            /* Smaller padding on mobile */
            font-size: 0.875rem;
            /* Smaller text on mobile */
        }

        @media (min-width: 768px) {
            .action-btn {
                padding: 0.5rem 1.5rem;
                /* Larger padding on desktop */
                font-size: 1rem;
                /* Normal text on desktop */
            }
        }

        /* Mobile-friendly tabs */
        .tab {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .tab {
                padding: 0.5rem 1.5rem;
                font-size: 1rem;
            }
        }

        /* Mobile-friendly language selector */
        #language-selector {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            #language-selector {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-2 sm:p-4"> <!-- Smaller padding on mobile -->
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-6">Code Playground</h1>

        <!-- Main Container -->
        <div class="main-container">
            <!-- Editor Section -->
            <div class="editor-section bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Language Selection -->
                <div class="flex flex-col sm:flex-row justify-between items-center bg-gray-800 p-2 sm:p-3">
                    <select id="language-selector" class="bg-gray-700 text-white px-2 sm:px-3 py-1 sm:py-2 rounded mb-2 sm:mb-0 w-full sm:w-auto">
                        <option value="javascript">JavaScript</option>
                        <option value="python">Python</option>
                        <option value="html">HTML</option>
                        <option value="java">Java</option>
                        <option value="c">C</option>
                        <option value="cpp">C++</option>
                    </select>
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                        <button id="run-btn" class="action-btn bg-green-600 hover:bg-green-700 text-white rounded flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Run
                        </button>
                        <button id="reset-btn" class="action-btn bg-gray-600 hover:bg-gray-700 text-white rounded">
                            Reset
                        </button>
                        <button id="download-btn" class="action-btn bg-blue-600 hover:bg-blue-700 text-white rounded flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 18h6"></path>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex border-b overflow-x-auto">
                    <button class="tab px-3 sm:px-4 py-2 font-medium" data-tab="editor">Editor</button>
                    <button class="tab px-3 sm:px-4 py-2 font-medium" data-tab="output">Output</button>
                    <button class="tab px-3 sm:px-4 py-2 font-medium" data-tab="console">Console</button>
                </div>

                <!-- Editor -->
                <div id="editor-tab" class="tab-content p-0">
                    <div class="relative editor-container">
                        <span id="language-badge" class="absolute language-badge bg-gray-800 text-white text-xs px-2 py-1 rounded z-10">javascript</span>
                        <textarea id="code-editor" class="w-full h-full p-4 font-mono text-gray-200 bg-gray-900 outline-none resize-none">// Write your code here
console.log("Hello, World!");</textarea>
                    </div>
                </div>

                <!-- Output -->
                <div id="output-tab" class="tab-content hidden p-4 output-container bg-gray-100">
                    <div id="output-content" class="font-mono whitespace-pre-wrap"></div>
                </div>

                <!-- Console -->
                <div id="console-tab" class="tab-content hidden p-4 bg-gray-800 text-green-400 font-mono overflow-y-auto" style="min-height: 150px;">
                    <div id="console-output"></div>
                </div>
            </div>

            <!-- Examples Section -->
            <div class="examples-section bg-white rounded-lg shadow-lg p-3 sm:p-4 overflow-x-auto">
                <h2 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Examples</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3 sm:gap-4">
                    <!-- JavaScript Example -->
                    <div class="example-card" data-lang="javascript" data-code="// Hello World in JavaScript\nconsole.log('Hello, World!');\n// Simple calculation\nlet a = 5;\nlet b = 10;\nconsole.log(`Sum: ${a + b}`);">
                        <div class="bg-blue-100 p-2 sm:p-3 rounded-lg cursor-pointer hover:bg-blue-200">
                            <h3 class="font-medium text-sm sm:text-base">JavaScript Basics</h3>
                            <p class="text-xs sm:text-sm text-gray-600">Hello World and simple calculation</p>
                        </div>
                    </div>

                    <!-- Python Example -->
                    <div class="example-card" data-lang="python" data-code="# Hello World in Python\nprint('Hello, World!')\n# Fibonacci sequence\ndef fib(n):\n    if n <= 1:\n        return n\n    return fib(n-1) + fib(n-2)\nprint(fib(10))">
                        <div class="bg-yellow-100 p-2 sm:p-3 rounded-lg cursor-pointer hover:bg-yellow-200">
                            <h3 class="font-medium text-sm sm:text-base">Python Fibonacci</h3>
                            <p class="text-xs sm:text-sm text-gray-600">Recursive Fibonacci sequence</p>
                        </div>
                    </div>

                    <!-- HTML Example -->
                    <div class="example-card" data-lang="html" data-code="<!-- Simple HTML Page -->\n<!DOCTYPE html>\n<html>\n<head>\n    <title>My Page</title>\n    <style>\n        body { font-family: Arial; }\n        h1 { color: blue; }\n    </style>\n</head>\n<body>\n    <h1>Hello World!</h1>\n    <p>This is a simple HTML page.</p>\n</body>\n</html>">
                        <div class="bg-green-100 p-2 sm:p-3 rounded-lg cursor-pointer hover:bg-green-200">
                            <h3 class="font-medium text-sm sm:text-base">HTML Page</h3>
                            <p class="text-xs sm:text-sm text-gray-600">Simple HTML page with CSS</p>
                        </div>
                    </div>
                    <!-- Java Example -->
                    <div class="example-card" data-lang="java" data-code="// Hello World in Java\n class Main {\n    public static void main(String[] args) {\n        System.out.println(&quot;Hello, World!&quot;);\n        // Simple loop\n        for (int i = 1; i <= 5; i++) {\n            System.out.println(i);\n        }\n    }\n}">
                        <div class="bg-orange-100 p-3 rounded-lg cursor-pointer hover:bg-orange-200">
                            <h3 class="font-medium">Java Basics</h3>
                            <p class="text-sm text-gray-600">Hello World and a simple loop</p>
                        </div>
                    </div>
                    <!-- C Example -->
                    <div class="example-card" data-lang="c" data-code="// Hello World in C\n#include <stdio.h>\n\nint main() {\n    printf(&quot;Hello, World!\\n&quot;);\n    // Simple addition\n    int a = 5, b = 10;\n    printf(&quot;Sum: %d\\n&quot;, a + b);\n    return 0;\n}">
                        <div class="bg-gray-100 p-3 rounded-lg cursor-pointer hover:bg-gray-200">
                            <h3 class="font-medium">C Basics</h3>
                            <p class="text-sm text-gray-600">Hello World and simple addition</p>
                        </div>
                    </div>
                    <!-- C++ Example -->
                    <div class="example-card" data-lang="cpp" data-code="// Hello World in C++\n#include <iostream>\n\nint main() {\n    std::cout << &quot;Hello, World!&quot; << std::endl;\n    // Simple multiplication\n    int a = 5, b = 10;\n    std::cout << &quot;Product: &quot; << (a * b) << std::endl;\n    return 0;\n}">
                        <div class="bg-gray-200 p-3 rounded-lg cursor-pointer hover:bg-gray-300">
                            <h3 class="font-medium">C++ Basics</h3>
                            <p class="text-sm text-gray-600">Hello World and simple multiplication</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./fab.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const editor = document.getElementById('code-editor');
            const languageSelector = document.getElementById('language-selector');
            const runBtn = document.getElementById('run-btn');
            const resetBtn = document.getElementById('reset-btn');
            const downloadBtn = document.getElementById('download-btn');
            const outputContent = document.getElementById('output-content');
            const consoleOutput = document.getElementById('console-output');
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            const exampleCards = document.querySelectorAll('.example-card');
            const languageBadge = document.getElementById('language-badge');

            // Current state
            let currentLanguage = 'javascript';
            let consoleHistory = [];

            // Initialize
            updateLanguageBadge();

            // Event Listeners
            languageSelector.addEventListener('change', function() {
                currentLanguage = this.value;
                updateLanguageBadge();
            });

            runBtn.addEventListener('click', runCode);
            resetBtn.addEventListener('click', resetEditor);

            // Download Button Logic
            downloadBtn.addEventListener('click', function() {
                const code = editor.value;
                const blob = new Blob([code], {
                    type: 'text/plain'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `code.${currentLanguage}`;
                a.click();
                URL.revokeObjectURL(url);
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabName = this.dataset.tab;
                    // Update tabs
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    this.classList.add('tab-active');
                    // Update content
                    tabContents.forEach(content => content.classList.add('hidden'));
                    document.getElementById(`${tabName}-tab`).classList.remove('hidden');
                });
            });

            exampleCards.forEach(card => {
                card.addEventListener('click', function() {
                    const lang = this.dataset.lang;
                    let code = this.dataset.code;

                    // Decode HTML entities
                    code = code.replace(/</g, '<').replace(/>/g, '>').replace(/&apos;/g, "'").replace(/&quot;/g, '"');

                    // Replace \n with actual newlines
                    code = code.replace(/\\n/g, '\n');

                    languageSelector.value = lang;
                    currentLanguage = lang;
                    editor.value = code;
                    updateLanguageBadge();
                });
            });

            // Functions
            function updateLanguageBadge() {
                languageBadge.textContent = currentLanguage;
                languageBadge.className = 'absolute language-badge text-xs px-2 py-1 rounded z-10';
                const classes = getLanguageColorClass(currentLanguage).split(' ');
                classes.forEach(cls => languageBadge.classList.add(cls));
            }

            function getLanguageColorClass(lang) {
                const colors = {
                    'javascript': 'bg-yellow-500 text-gray-900',
                    'python': 'bg-blue-500 text-white',
                    'php': 'bg-purple-500 text-white',
                    'html': 'bg-red-500 text-white',
                    'java': 'bg-orange-500 text-white',
                    'c': 'bg-gray-700 text-white',
                    'cpp': 'bg-gray-800 text-white'
                };
                return colors[lang] || 'bg-gray-800 text-white';
            }

            async function runCode() {
                const code = editor.value;
                // Clear previous output
                outputContent.innerHTML = '';
                consoleOutput.innerHTML = '';
                // Show loading state
                outputContent.innerHTML = '<div class="text-gray-500">Running code...</div>';
                document.querySelector('[data-tab="output"]').click();
                try {
                    const response = await fetch('run_code.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            code: code,
                            language: currentLanguage
                        })
                    });
                    const result = await response.json();
                    if (result.error) {
                        outputContent.innerHTML = `<div class="text-red-600">Error: ${result.error}</div>`;
                    } else {
                        if (currentLanguage === 'html') {
                            // For HTML, show in an iframe
                            outputContent.innerHTML = `
                                <div class="mb-2">
                                    <button id="render-html" class="bg-blue-500 text-white px-3 py-1 rounded">
                                        Render HTML
                                    </button>
                                </div>
                                <iframe id="html-output" class="w-full h-64 border bg-white" srcdoc="${escapeHtml(result.output)}"></iframe>
                                <div class="mt-2 p-2 bg-gray-800 text-green-400 font-mono overflow-x-auto">
                                    ${escapeHtml(result.output)}
                                </div>
                            `;
                            document.getElementById('render-html').addEventListener('click', function() {
                                document.getElementById('html-output').style.display = 'block';
                            });
                        } else {
                            outputContent.textContent = result.output;
                        }
                    }
                    // Capture console output if any
                    if (result.console) {
                        consoleOutput.textContent = result.console;
                    }
                } catch (error) {
                    outputContent.innerHTML = `<div class="text-red-600">Failed to execute: ${error.message}</div>`;
                }
            }

            function resetEditor() {
                editor.value = '';
                outputContent.innerHTML = '';
                consoleOutput.innerHTML = '';
                document.querySelector('[data-tab="editor"]').click();
            }

            function escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "<")
                    .replace(/>/g, ">")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>

</html>