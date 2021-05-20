<?php
session_start()
?>
<html>

<head>
    <title>Employee DTR</title>
</head>

<body bgcolor='#CCCCCC'>
    <center>
        <h2>Work Schedule </h2>
        <h3>[ Online Daily Time Record ]</h3>
        <?php
$DBConnect = mysqli_connect("localhost", "root", "")
or die("Unable to Connect" . mysqli_error());
mysqli_select_db($DBConnect, "dbemployee");

$user = $_SESSION['getLogin'];

$query = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE usercred ='$user'");
while ($retrieve = mysqli_fetch_array($query)) {
    echo $retrieve["empid"] . "<br />";
    echo $retrieve["empname"] . "<br />";
    echo $retrieve["empstatus"] . "<br />";
    echo $retrieve["empgender"] . "<br />";
}
echo $_SESSION['getLogin'];

?>

        <form action="dtrprocess.php" method="post">

            Enter Name: <input type="text" name="empname" size="8"><br>
            Enter ID: <input type="text" name="empid" size="8"><br>
            Date of Effectivity: &nbsp;
            <select name="startmonth">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>&nbsp;&nbsp;
            <select name="startday">
                <?php
for ($i = 1; $i <= 31; $i++) {
    echo "<option value=$i>$i</option>";
}
?>
            </select>&nbsp;&nbsp;
            <select name="startyear">
                <?php
for ($x = date("Y"); $x >= 2000; $x--) {
    echo "<option value=$x>$x</option>";
}
?>
            </select> &nbsp; Cut Off Date: &nbsp;
            <select name="endmonth">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>&nbsp;&nbsp;
            <select name="endday">
                <?php
for ($i = 1; $i <= 31; $i++) {
    echo "<option value=$i>$i</option>";
}
?>
            </select>&nbsp;&nbsp;
            <select name="endyear">
                <?php
for ($x = date("Y"); $x >= 2000; $x--) {
    echo "<option value=$x>$x</option>";
}

?>
            </select>
            <br /><br />
            <?php
$dayArray = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
echo "<table width='40%'>";
echo "<tr><th>/</th><th>Day</th><th>Time In</th><th>Time Out</th><tr>";
for ($day = 0; $day <= 5; $day++) {
    echo "<tr><td><input type='checkbox' name='work$day' value='$dayArray[$day]'></td><td>" . $dayArray[$day] . "</td>" .
        "<td align='center'><select name='in$day'><option></option>";
    for ($timein = 0; $timein <= 24; $timein++) {
        echo "<option value=$timein>$timein</option>";
    }
    echo "</select></td>";
    echo "<td align='center'><select name='out$day'><option></option>";
    for ($timeout = 0; $timeout <= 24; $timeout++) {
        echo "<option value=$timeout>$timeout</option>";
    }
    echo "</select></td></tr>";
}
echo "</table>";
?>
            <br />
            <input type="submit" name="enter" value="Save"><input type="reset">

        </form>
        <form action="dtrdelete.php" method="post">
            <h2>[Delete Data]</h2>
            Enter Log ID: <input type="text" name="empID" size="8"><br>
            <input type="submit" name="enter" value="Delete">
        </form>
        <center>
</body>

</html>