<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
    function validateTextOnly(target) {
        if ($('#' + target).val().match(/^[a-z ]+$/i)) {
            return true;
        }

        $('#' + target).val("");
        $('#' + target).attr("placeholder", "Input must be letters.");

        return false;
    }

    function validateAlphanumeric(target) {
        if ($('#' + target).val().match(/^[a-z0-9' ]+$/i)) {
            return true;
        }

        $('#' + target).val("");
        $('#' + target).attr("placeholder", "Input must be alphanumeric.");

        return false;
    }

    function validatePhoneNumber(target) {
        if ($('#' + target).val().match(/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i)) {
            return true;
        }

        $('#' + target).val("");
        $('#' + target).attr("placeholder", "Input must be a valid phone number.");

        return false;
    }

    function validateInputs() {
        if ($('#username').val() == "")
            return false;
        if ($('#password').val() == "")
            return false;
        if ($('#first').val() == "")
            return false;
        if ($('#last').val() == "")
            return false;
        if ($('#company').val() == "")
            return false;
        if ($('#phone').val() == "")
            return false;

        $('form[name=form]').submit();
    }
    </script>
</head>
<body>
<div class="container">
<?php
if (isset($_COOKIE["USERNAME_TAKEN"]))
{
    echo "<h4 class='invalidMsg' style=\"color: red;\">Username already taken</h4>";
}
else if (isset($_COOKIE["INVALID_COMPANY"]))
{
    echo "<h4 class='invalidMsg' style=\"color: red;\">Company name does not exist.</h4>";
}
else
{
    echo "<br><br>";
}
?>
    <h1 class="well">Registration Form</h1>

    <div class="col-lg-12 well">
        <div class="row">
            <form name="form" action="registrationadd.php" method="POST">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Username</label>
                            <input id="username" type="text" onblur="validateAlphanumeric('username');" placeholder="Enter username here..." class="form-control" name="username" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Password</label>
                            <input type="password" id="password" onblur="validateAlphanumeric('password');" placeholder="Enter password here..." class="form-control" name="password" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>First Name</label>
                            <input type="text" id="first" onblur="validateTextOnly('first');" placeholder="Enter First Name Here.." class="form-control" name="first">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Last Name</label>
                            <input type="text" id="last" onblur="validateTextOnly('last');" placeholder="Enter Last Name Here.." class="form-control" name="last">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Company</label>
                            <input type="text" name="company" id="company" onblur="validateAlphanumeric('company');" placeholder="Enter Company Name Here.." class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Phone Number</label>
                            <input type="text" id="phone" name="phone" onblur="validatePhoneNumber('phone');" placeholder="123-456-7890" class="form-control">
                        </div>
                    </div>
                    <button type="button" onclick="validateInputs();" class="btn btn-lg btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
