<?php

$fullWeather = '';
$fullWeather_humidity = '';

if (isset($_POST['submit'])) {

    if ($_POST['city'] == '') {
        echo "<h2>Empty input, write a city name</h2>";
    } else {
        $city = $_POST['city'];

        $data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=cbe439ed5d7e9fd4dee89b0183fa437d");

        $weather = json_decode($data, true);

        // Uncomment the following line to see the full weather data for debugging
        // print_r($weather);

        $tempInCel = intval($weather['main']['temp'] - 273);
        $tempInCel1 = intval($weather['main']['temp_min'] - 273);
        $tempInCel2 = intval($weather['main']['temp_max'] - 273);
        $humidity = $weather['main']['humidity'];

        $fullWeather = "Temperature in " . $city . " is " . $tempInCel . "°C.";
        $tem_min = "Min temperature in " . $city . " is " . $tempInCel1 . "°C.";
        $tem_max = "Max temperature in " . $city . " is " . $tempInCel2 . "°C.";
        $fullWeather_humidity = "Humidity in " . $city . " is " . $humidity . "%.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            overflow: hidden;
        }

        .margin {
            margin-top: 100px;
        }

        .head-margin {
            margin-top: 160px;
            margin-bottom: -80px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: white;
            text-align: center;
        }

        body {
            background-image: url('temp3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    <title>Weather App</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h1 class="text-center head-margin">What's the weather today??</h1>
                <form class="mb-4 card p-2 margin" method="POST" action="index.php">
                    <div class="input-group">
                        <input type="text" name="city" class="form-control" placeholder="Enter city name e.g Lahore, Karachi">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
                <?php if ($fullWeather && $fullWeather_humidity) : ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="alert alert-success bg-info text-white card w-100">
                                <p><?php echo $fullWeather; ?></p>
                                <img src="temp4.png" class="card-img-top" alt="Temperature Image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="alert alert-success bg-info text-white card w-100">
                                <p><?php echo $fullWeather_humidity; ?></p>
                                <img src="humitity2.png" class="card-img-top" alt="Humidity Image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="alert alert-success bg-info text-white card w-100">
                                <p><?php echo $tem_min; ?></p>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="alert alert-success bg-info text-white card w-100">
                                <p><?php echo $tem_max; ?></p>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>