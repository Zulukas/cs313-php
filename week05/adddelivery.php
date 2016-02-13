<?php
session_start(); //This guy is a pain in the butt to debug

$user     = $_SESSION['user'];
$orgName = $_SESSION['orgname'];
$orgID = $_SESSION['orgid'];

 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Delivery</title>

    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
        /* Space out content a bit */
        body {
          padding-top: 20px;
          padding-bottom: 20px;
        }

        /* Everything but the jumbotron gets side spacing for mobile first views */
        .header,
        .marketing,
        .footer {
          padding-right: 15px;
          padding-left: 15px;
        }

        /* Custom page header */
        .header {
          border-bottom: 1px solid #e5e5e5;
        }
        /* Make the masthead heading the same height as the navigation */
        .header h3 {
          padding-bottom: 19px;
          margin-top: 0;
          margin-bottom: 0;
          line-height: 40px;
        }

        /* Custom page footer */
        .footer {
          padding-top: 19px;
          color: #777;
          border-top: 1px solid #e5e5e5;
        }

        /* Customize container */
        @media (min-width: 768px) {
          .container {
            max-width: 730px;
          }
        }
        .container-narrow > hr {
          margin: 30px 0;
        }

        /* Main marketing message and sign up button */
        .jumbotron {
          text-align: center;
          border-bottom: 1px solid #e5e5e5;
        }
        .jumbotron .btn {
          padding: 14px 24px;
          font-size: 21px;
        }

        /* Supporting marketing content */
        .marketing {
          margin: 40px 0;
        }
        .marketing p + h4 {
          margin-top: 28px;
        }

        /* Responsive: Portrait tablets and up */
        @media screen and (min-width: 768px) {
          /* Remove the padding we set earlier */
          .header,
          .marketing,
          .footer {
            padding-right: 0;
            padding-left: 0;
          }
          /* Space out the masthead */
          .header {
            margin-bottom: 30px;
          }
          /* Remove the bottom border on the jumbotron for visual effect */
          .jumbotron {
            border-bottom: 0;
          }
        }
    </style>
    <script>
        function validateAddress(target) {
            if ($('#' + target).val().match(/^[0-9a-z,.# ]+$/i)) {
                return true;
            }

            $('#' + target).val("");
            $('#' + target).attr("placeholder", "Invalid address.");

            return false;
        }

        function validateInputs() {
            if ($('#pickupaddress').val() == "")
                return false;


            if ($('#dropoffaddress').val() == "")
                return false;


            if ($('#datepicker').val() == "")
                return false;

            var val = $("#radio:checked").val();
            alert(val);

            if (val == 1 || val == 2 || val == 3 || val == 4)
                document.forms["form"].submit();
                // $('form[name=form]').submit();


            return false;
        }

        $(function() {
        	$( "#datepicker" ).datepicker();
      	});
    </script>
</head>
<body>
<div class="container">
    <h1 class="well"><?php echo $orgName; ?>: Add Delivery</h1>

    <div class="col-lg-12 well">
        <div class="row">
            <form id="form" name="form" action="insertdelivery.php" method="POST">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Pick-up Location</label>
                            <input id="pickupaddress" type="text" onblur="validateAddress('pickupaddress');" placeholder="Enter address here..." class="form-control" name="pickupaddress" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Drop-off Location</label>
                            <input id="dropoffaddress" type="text" onblur="validateAddress('dropoffaddress');" placeholder="Enter address here..." class="form-control" name="dropoffaddress" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Pick-up Date</label>
                            <input name="startdate" type="text" id="datepicker" name="pickupdate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Priority</label><br />
                            <div class="radio">
                                <label><input type="radio" name="priority[]" value="1" id="radio">Next-Day</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="priority[]" value="2" id="radio">2-Day</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="priority[]" value="3" id="radio">3-5 Days</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="priority[]" value="4" id="radio">Economy</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="validateInputs();" class="btn btn-lg btn-info">Submit</button>
                    <button type="button" onclick="window.location.href='deliveries.php'" class="btn btn-lg btn-info">Back</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
