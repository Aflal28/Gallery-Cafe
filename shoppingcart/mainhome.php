<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Boxes</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image:url("images/blur-background-at-wooden-style-restaurant-and-cafe-with-people-free-photo.jpg");
            margin: 0;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .box {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5em;
            color: white;
            border-radius: 10px;
        }
        .box1 {
            background-color: maroon;
            animation: bounce 2s infinite;
            width: 200px;
            height: 150px;
        }
        .box2 {
            background-color: green;
            animation: spin 3s linear infinite;
            width: 200px;
            height: 150px;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        @keyframes spin {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-20px);
            }
        }
        a{
            text-decoration: none;
            color: white;
            font-size: 3em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box box1"><a href="adminlogin.php">Admin</a></div>
        <div class="box box2"><a href="stafflogin">Staff</a></div>
    </div>
</body>
</html>
