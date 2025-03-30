<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Multi-Language Code Runner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        pre {
            background: #f0f0f0;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Multi-Language Code Runner</h1>
    <form id="compileForm">
        <label for="language">Choose Language:</label>
        <select id="language" name="language">
            <option value="php">PHP</option>
            <option value="js">JavaScript</option>
            <option value="python">Python</option>
            <option value="java">Java</option>
            <option value="c">C</option>
            <option value="cpp">C++</option>
            <option value="html">HTML</option>
        </select>
        <br><br>
        <label for="code">Enter Code:</label><br>
        <textarea id="code" name="code" rows="12" cols="70" placeholder="Type your code here..."></textarea>
        <br><br>
        <button type="submit">Run Code</button>
    </form>
    <br>
    <div>
        <h3>Output:</h3>
        <pre id="result"></pre>
    </div>

    <script>
        document.getElementById('compileForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const language = document.getElementById('language').value;
            const code = document.getElementById('code').value;
            const formData = new FormData();
            formData.append('language', language);
            formData.append('code', code);

            try {
                const response = await fetch('compile.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.text();
                document.getElementById('result').innerText = result;
            } catch (err) {
                document.getElementById('result').innerText = 'Error: ' + err;
            }
        });
    </script>
</body>

</html>