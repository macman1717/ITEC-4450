<html>
<head>
    <title>Activity 17</title>
    <style>
        .error {color:red;}
    </style>
</head>
<body>
<h1>All About Date and Time</h1>

<?php
echo "<h3>Different Date Formats</h3>";
echo "1. Today is ".date("m/d/Y")."<br>";
echo "2. Today is ".date("m/d/y")."<br>";
echo "3. Today is ".date("M/d/Y")."<br>";
echo "4. Today is ".date("m/d/y")."<br>";
echo "5. Today is ".date("m.d.Y")."<br>";
echo "6. Today is ".date("m-d-Y")."<br>";
echo "<hr>";
echo "<h3>Different Time Formats</h3>";
echo "1. The time right now is ".date("h:i:s")."<br>";
echo "2. The time right now is ".date("h:i:sa")."<br>";
echo "3. The time right now is ".date("h:i:sA")."<br>";
echo "4. The time right now is ".date("H:i:s")."<br>";
echo "<hr>";
echo "<h3>Set Up Timezone</h3>";
date_default_timezone_set("America/Los_Angeles");
echo "After setting my time zone to Los Angeles, the time now is ".date("h:i:sa")."<br>";
date_default_timezone_set("America/New_York");
echo "After setting my time zone to New York, the time now is ".date("h:i:sa")."<br>";
echo "<hr>";
echo "<h3>Different Formats for Days in a Week</h3>";
echo "What day is today? Today is ".date("l")."<br>";
echo "What day is today? Today is ".date("D")."<br>";
echo "What day is today? Today is ".date("w")."<br>";
echo "<hr>";
echo "<h3>Create Dates Using Strings</h3>";
$dbstr="March 21 1997";
$bd=strtotime($dbstr);
echo "My birthday is ".$dbstr."<br>";
echo "What day is my birthday? It is ".date("l",$bd)."<br>";
echo "<hr>";
echo "<h3>Marking Time</h3>";
$anotherday=mktime(12,0,0,1,1,2000);
echo "<br> This is the number of seconds since 12am 1/1/1970 to 12pm on 1/1/2000: ".$anotherday."<br>";
echo "The created time is: ".date("Y-m-d h:i:sa",$anotherday)."<br>";
$x=strtotime("tomorrow");
echo "Tomorrow is: ".date("Y-m-d h:i:sa",$x)."<br>";
$x = strtotime("+3 months",time());
echo "<br> 3 months after tomorrow is: ".date("Y-m-d h:i:sa",$x)."<br>";
$x = strtotime("-3 months",time());
echo "<br> 3 months before tomorrow is: ".date("Y-m-d h:i:sa",$x)."<br>";
$x = strtotime("3/5/2025");
echo "<br>The time we created is ".date("Y-m-d h:i:sa",$x)."<br>";
echo "<hr>";
echo "<h3>Counting Down Example</h3>";
$specialDay = strtotime("Feb 9 2025");
$today = strtotime("today");
$diff = $specialDay - $today;
$nDays = ceil($diff / 60 / 60 / 24);
if($diff<0){
    echo "This event already happened ".abs($nDays)." days before today.<br>";
}else{
    echo "There are ".$nDays." days before until this event.<br>";
}

echo "<h3>Final Exam Count Down</h3>";
$finalExamDate = strtotime("May 5 2025");
$today = strtotime("today");
$diff = $finalExamDate - $today;
$nDays = ceil($diff / 60 / 60 / 24);
if($diff<0){
    echo "The final exam was finished ".$nDays." days ago.<br>";
}else{
    echo "There are ".$nDays." days until the final exam.<br>";
}
?>
</body>
</html>
