<?php include('variables/variables.php') ?>

<head>

<script>

function closewindow() {
 
    open(location, '_self').close();

}

</script>

</head>

<body>

<div id="invalid">

<div id="iheader">

<h4>WontBlinkBox</h4>

<img src="images/invalid.jpg" style="width:45px;height:45px">

</div>

<h3>invalid request</h3>

<p><?php echo $invalid ?></p>

<!--<div id="close">-->

<input type="button" class="btn btn-success" value="x" onclick="closewindow();"></input>

<!--</div>-->

</div> <!-- end #invalid -->

</body>
