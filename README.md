# Robot-Control-Panel
Create a simple web interface to control a robot and display its last movement using XAMPP and VS Code. This involves setting up a database to store movement commands, creating a control page with buttons to send commands, and a display page to show the last recorded movement direction.

# Robot Control Web Interface

This project provides a simple web interface to control a robot's movements and display the last recorded direction using XAMPP and VS Code.

## Features

- **Control Interface**: A web page with buttons to control the robot's movements.
- **Database Logging**: Stores movement commands in a MySQL database.
- **Display Page**: Shows the last movement direction.

## Prerequisites

- XAMPP (Apache and MySQL)
- Visual Studio Code

## Setup

### 1. Install XAMPP

Download and install XAMPP from [here](https://www.apachefriends.org/index.html).

### 2. Start Services

Start Apache and MySQL services from the XAMPP Control Panel.

### 3. Create Database

1. Open your browser and go to [phpMyAdmin](http://localhost/phpmyadmin).
2. Create a new database named `robot_control`.
3. Create a `movement` table with the following SQL:

    ```sql
    CREATE TABLE `movement` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `direction` varchar(50) NOT NULL,
      `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    );
    ```

### 4. Set Up Project

1. Clone this repository into the XAMPP `htdocs` directory (e.g., `C:\xampp\htdocs`).
2. Open the project folder in VS Code.

### 5. Create Files

Create the following files in the `robot_control` folder:

- **index.php**: Control interface

    ```html
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
    ```

- **control.php**: Handle form submissions

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "robot_control";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $direction = $_POST['direction'];
        $sql = "INSERT INTO movement (direction) VALUES ('$direction')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    header("Location: index.php");
    exit();
    ?>
    ```

- **display.php**: Display last movement direction

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "robot_control";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT direction FROM movement ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $last_direction = "";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_direction = $row['direction'];
    } else {
        $last_direction = "No data";
    }

    $conn->close();
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Last Movement</title>
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
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            a:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Last Movement Direction</h1>
        <div class="container">
            <h2><?php echo $last_direction; ?></h2>
            <a href="index.php">Go Back</a>
        </div>
    </body>
    </html>
    ```

## Usage

1. Open your browser and go to [http://localhost/robot_control/index.php](http://localhost/robot_control/index.php) to control the robot.
2. Navigate to [http://localhost/robot_control/display.php](http://localhost/robot_control/display.php) to view the last movement direction.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
