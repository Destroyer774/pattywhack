<html>

<!-- BootStrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- JQuery -->
<script src="/pattywhack/mvc/public/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
<!-- Style Sheets -->
<link rel="stylesheet" type="text/css" href="/pattywhack/mvc/public/stylesheets/registerStyles.css">


<script>
    window.onload = function () {
        $("body").fadeIn(950);
    };
</script>
    
<script type="text/javascript">
$( document ).ready(function() {
    $("#budgBox").keyup(function() {
        $('#points').attr('max', $("#budgBox").val());
    });
    
    
});
    
function updateTextInput(val) {
    document.getElementById('dispVal').value=val; 
}    
  
function revealMPPI() {
   var MPItem = document.getElementById("MPPI");
    MPItem.style.display = MPItem.style.display === 'none' ? '' : 'none';
}
</script>

<head>
    <title>Patty Whack</title>
</head>
    <?php include("../public/includes/navbar.php"); ?>
    <h1 class="registerhead">Place your order</h1>

<body style="display:none;" class="homebody">

    <form method="POST" class="registerform" action="../home/shipping" >
        <div class="form-group">
            <label for="budgetBox">Order Budget: </label>
            <input type="number" required class="form-control" onkeyup="update()" name="budgetBox" id="budgBox"/>
        </div>
        <div id="MPPI" class="form-group" style="display: none;">
            <label for="budgetBox">Max Price/Item: </label> 
            <input type="range" name="points" id="points" min="1" max="100" onchange="updateTextInput(this.value);"> <br/>
            <input class="form-control" id="dispVal" disabled type="text" style="width:90px;">
        </div>
        <button type="button" class="btn btn-default" onclick="revealMPPI()">Choose the Max Price/Item</button> <br/><br/>
        <button type="submit" class="btn btn-default">Submit</button>
        
    </form>
</body>

</html>