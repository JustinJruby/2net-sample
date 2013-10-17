<?php
require('session.php');
require('sample.php');

$tracks = $twonet->user_tracks($_SESSION['guid']);

if ($twonet->user_has(TwonetPartner::TRACK_ENTRA, $tracks)) {
    $blood_measure = $twonet->blood_latest($_SESSION['guid'], $twonet->get_track_guid(TwonetPartner::TRACK_ENTRA, $tracks));
}

if ($twonet->user_has(TwonetPartner::TRACK_FITBIT, $tracks)) {
    $body_measure = $twonet->body_latest($_SESSION['guid'], $twonet->get_track_guid(TwonetPartner::TRACK_FITBIT, $tracks));
}
if (empty($blood_measure)) {
    $blood_measure = array("time" => "0", "blood" => array("glucose" => "0"));
}
if (empty($body_measure)) {
    $body_measure = array("time" => "0", "body" => array("weight" => "0", "bmi" => "0"));
}
?>
<html lang="en" dir="ltr">
<head>
    <title>Diabetes management made easy</title>
    <meta charset="utf-8" />
    <meta name="description" content="A mobile newspaper template homepage" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="style.css" /><!--SET MEDIA HANDELD HERE-->
</head>
<body>
<header>
    <div id="logo">
        <div class="top-title">
            <h1>Diabetes<span>Manager</span></h1>
        </div><!--/.top-title-->
    </div><!--/#logo-->
    <div id="logout"><a href="logout.php"><img src="images/logout.png" alt="Logout" /></a></div>
    <div id="manage-devices"><a href="devices.php"><img src="images/settings.png" alt="Manage Devices" /></a></div>
</header>
<div id="main-wrapper">
    <section class="main-content">
        <article class="readings">
            <p class="device-name">Entra Glucometer</p>
            <hr />
            <div class="bood-sugar">
                <img src="images/bloodsugar.png" class="device-icon" alt="Blood Sugar Level" />
                <h3 style="font-size: 1.6em;">BLOOD SUGAR (mg/dL)</h3>
                <p class="reading-time"><?=date("m/d/Y - g:ia", $blood_measure['time']);?></p>
                <p class="blood-sugar-reading"><?=number_format($blood_measure['blood']['glucose']);?></p>
            </div>
            <p class="device-name">FitBit Weight Scale</p>
            <hr />
            <div class="weight">
                <img src="images/weight.png" class="device-icon" alt="Weight" />
                <h3>WEIGHT (lbs)</h3>
                <p class="reading-time"><?=date("m/d/Y - g:ia", $body_measure['time']);?></p>
                <p class="weight-reading"><?=number_format($body_measure['body']['weight']);?></p>
            </div>
            <div class="bmi">
                <img src="images/BMI.png" class="device-icon" alt="BMI" />
                <h3>BMI</h3>
                <p class="reading-time"><?=date("m/d/Y - g:ia", $body_measure['time']);?></p>
                <p class="bmi-reading"><?=number_format($body_measure['body']['bmi']);?></p>
            </div>
            <div class="clearfix"></div>
            <div class="check-readings"><a href="#"><img src="images/btnCheckReadings.png" alt="Check Readings" /></a></div>
        </article>
     </section>
</div>
</body>
</html>
