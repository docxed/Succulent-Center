<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succulent Center</title>
    <link rel="icon" href="./assets/images/logo.png" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a24161bc92.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyALC4_1XPkHu7nZ82vQ0Uv1F5ZtGpJJe4M&region=TH&language=th"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            font-family: 'Kanit', sans-serif;
        }

        .content {
            border: solid 1px #ccc;
            padding: 40px 25px 40px 25px;
            border-radius: 8px;
        }
        .pac-icon {
            display: none;
        }

        .pac-item {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .pac-item:hover {
            background-color: #ececec;
        }

        .pac-item-query {
            font-size: 16px;
        }

        #map {
            background-color: #ffffff;
            height: 400px;
        }
    </style>

</head>

<body>