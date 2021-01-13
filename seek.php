<!DOCTYPE html>
<html lang="en">
<title>POS Z Read Monitoring</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<head>

<style>

body, html {
height: 100%;
margin: 0;
}

.bg{
background-image: url('w3images/2.jpeg');
height:100%;

background-position: center;
background-repeat: no-repeat;
background-size: cover;
}


</style>


  </head>
<body class="bg">

<!-- Header -->
<!-- <header class="w3-display-container w3-content w3-center" style="max-width:1500px"> -->
  <!-- <img class="w3-image" src="w3images\3632441.jpg" alt="Me" width="1500" height="600"> -->
  <!-- <img class="w3-image" src="w3images\1.jpg" alt="Me" width="1000" height="500"> -->
  <div class="w3-display-middle w3-padding-large w3-border w3-wide w3-text-light-grey w3-center">
    <Form name="Filter" action="display_result.php" target="_blank" method="POST">
    <h3>Z Read Monitoring</h3>
    <input type="date" name="dateFrom" value="<?php echo date('Y-m-d'); ?>" />
    <br>
    <input type="submit" name="submit" value="Generate"/>
    </form>
  </div>
<!-- </header> -->
<!-- Page content -->
<div class="w3-content w3-padding-large w3-margin-top" id="portfolio">

</div>
</body>
</html>
