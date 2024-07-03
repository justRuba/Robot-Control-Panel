<!DOCTYPE html>
<html>
<head>
    <title>Robot Control</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            margin: 0;
        }
        .container {
            margin-top: 50px;
        }
        button {
            width: 150px;
            height: 50px;
            margin: 20px;
            font-size: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Control the Robot</h1>
    <div class="container">
        <form method="post" action="control.php">
            <button name="direction" value="forward">Forward</button><br>
            <button name="direction" value="left">Left</button>
            <button name="direction" value="stop">Stop</button>
            <button name="direction" value="right">Right</button><br>
            <button name="direction" value="backward">Backward</button>
        </form>
    </div>
</body>
</html>
