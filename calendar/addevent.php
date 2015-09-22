<?php
/**
 * Created by PhpStorm.
 * User: UltraKapes
 * Date: 9/20/2015
 * Time: 4:25 PM
 */
session_start();
require_once(__DIR__ . '/../classes/CalendarEvents.php');

$pID = $_POST['propertyID'];
$eventName = $_POST['eventName'];
$eventTime = $_POST['timepicker1'];
$eventInterval = $_POST['interval'];
$description = $_POST['description'];
$eventDate = $_POST['date'];
$email = $_POST['email'];


$addEvent = CalendarEvents::addEvent($pID, $eventName, $eventTime, $eventInterval, $description, $eventDate, $email);

if ($addEvent == true) {
    $_SESSION['eventAdded'] = "true";
    header('Location: calendar.php');
    exit();

} else {
    $_SESSION['eventAdded'] = "false";
    header('Location: calendar.php');
    exit();
}



