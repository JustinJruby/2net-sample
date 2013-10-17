<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

require('session.php');
require('sample.php');

$tracks = $twonet->user_tracks($_SESSION['guid']);
if (isset($_POST['track']) && isset($_POST['action'])) {
	if ($_POST['action'] == 'remove') {
        $status = $twonet->unregister_device($_SESSION['guid'], $twonet->get_track_guid($_POST['track'], $tracks));
	}

    if ($_POST['track'] == TwonetPartner::TRACK_ENTRA && $_POST['action'] == 'add') {
        $twonet->register_entra($_SESSION['guid'], $_POST['serial_number']);
    }

    if ($_POST['track'] == TwonetPartner::TRACK_ANDBPM && $_POST['action'] == 'add') {
        $twonet->register_andbpm($_SESSION['guid'], $_POST['serial_number']);
    }

    if ($_POST['track'] == TwonetPartner::TRACK_ANDWS && $_POST['action'] == 'add') {
        $twonet->register_andws($_SESSION['guid'], $_POST['serial_number']);
    }

    if ($_POST['track'] == 'fitbit' && $_POST['action'] == 'add') {
        $response = $twonet->authorize_fitbit($_SESSION['guid']);
        $oauth_url = $response['oauthAuthorizationUrl'];
    }

	// Get the tracks again because some may have been added or removed
	$tracks = $twonet->user_tracks($_SESSION['guid']);
}
?>
<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
    <title>Diabetes management made easy</title>
    <meta charset="utf-8" />
    <meta name="description" content="A mobile newspaper template homepage" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!--SET MEDIA HANDELD HERE-->
</head>
<body>
<header>
    <div id="logo">
        <div class="top-title">
            <h1><a href="index.php">Diabetes<span>Manager</span></a></h1>
        </div>
        <!--/.top-title-->
    </div>
    <!--/#logo-->
</header>
<div id="main-wrapper">
    <section class="main-content">
        <article class="device-manager">
            <p class="device-name">Manage Devices</p>
            <hr />
            <!-- Entra Device -->
            <div class="device">
                <span class="device-delete">
                    <form class="device-form" method="post" action="devices.php">
                        <input type="hidden" name="track" value="<?=TwonetPartner::TRACK_ENTRA ?>">
                        <?php if ($twonet->user_has(TwonetPartner::TRACK_ENTRA, $tracks)) { ?>
<!--						<span>--><?// var_dump($twonet->track_details($_SESSION['guid'], $twonet->get_track_guid(TwonetPartner::TRACK_ENTRA, $tracks))) ?><!--</span>-->
                        <input type="hidden" name="action" value="remove">
                        <input type="submit" value="Remove">
                        <?php } else { ?>
                        <input type="hidden" name="action" value="add">
                        <input name="serial_number" type="text" size="12" value="2NET00001">
                        <input type="submit" value="Add">
                        <label>
                        </label>
                        <?php } ?>
                    </form>
                </span>
                <h3>Entra Glucometer</h3>
            </div>
            <!-- A&D BP Device -->
            <div class="device">
                <span class="device-delete">
                    <form class="device-form" method="post" action="devices.php">
                        <input type="hidden" name="track" value="<?=TwonetPartner::TRACK_ANDBPM ?>">
                        <?php if ($twonet->user_has(TwonetPartner::TRACK_ANDBPM, $tracks)) { ?>
<!--						<span>-->
							<? $track_details = $twonet->track_details($_SESSION['guid'],
								$twonet->get_track_guid(TwonetPartner::TRACK_ANDBPM, $tracks));
//							var_dump($track_details) ?>
						<!--</span>-->
                        <input type="hidden" name="action" value="remove">
                        <input type="submit" value="Remove">
                        <?php } else { ?>
                        <input type="hidden" name="action" value="add">
                        <input name="serial_number" type="text" size="12" value="2NET00004">
                        <input type="submit" value="Add">
                        <label>
                        </label>
                        <?php } ?>
                    </form>
                </span>
                <h3>A&D Blood Pressure Monitor</h3>
            </div>
            <!-- A&D BP Device -->
            <div class="device">
                <span class="device-delete">
                    <form class="device-form" method="post" action="devices.php">
                        <input type="hidden" name="track" value="<?=TwonetPartner::TRACK_ANDWS ?>">
                        <?php if ($twonet->user_has(TwonetPartner::TRACK_ANDWS, $tracks)) { ?>
<!--						<span>-->
							<? $track_details = $twonet->track_details($_SESSION['guid'],
								$twonet->get_track_guid(TwonetPartner::TRACK_ANDWS, $tracks));
//							var_dump($track_details) ?>
						<!--</span>-->
                        <input type="hidden" name="action" value="remove">
                        <input type="submit" value="Remove">
                        <?php } else { ?>
                        <input type="hidden" name="action" value="add">
                        <input name="serial_number" type="text" size="12" value="2NET00003">
                        <input type="submit" value="Add">
                        <label>
                        </label>
                        <?php } ?>
                    </form>
                </span>
                <h3>A&D Weight Scale</h3>
            </div>
            <!-- Fitbit Device -->
            <div class="device">
                <span class="device-delete">
                <?php if (isset($oauth_url)) { ?>
                    <a target="oauth" href="<?=$oauth_url?>">Click to authorize Fitbit</a>
                <?php } else { ?>
                    <form class="device-form" method="post" action="devices.php">
                        <input type="hidden" name="track" value="<?=TwonetPartner::TRACK_FITBIT ?>">
                        <?php if ($twonet->user_has(TwonetPartner::TRACK_FITBIT, $tracks)) { ?>
                        <input type="hidden" name="action" value="remove">
                        <input type="submit" value="Remove">
                        <?php } else { ?>
                        <input type="hidden" name="action" value="add">
                        <input type="submit" value="Add">
                        <label>
                        </label>
                        <?php } ?>
                    </form>
                <?php } ?>
                </span>
                <h3>FitBit Scale</h3>
            </div>
            <div class="clearfix"></div>
            <div><a href="index.php"><img src="images/btnReturnToReadings.png" alt="Return to Readings" /></a></div>
        </article>
        <!--/.main-front--></section>
    <!--/.main-content-->

</div>
</body>
</html>
