<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="en-us" http-equiv="Content-Language">
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Schematical 500</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="//mde.schematical.com/assets/mde/css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="//mde.schematical.com/assets/mde/css/style.css"></link>
    <link rel="stylesheet" type="text/css" href="//mde.schematical.com/assets/MJaxBootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//mde.schematical.com/assets/MJaxBootstrap/css/bootstrap-responsive.min.css"/>

</head>
<body data-spy="scroll" data-target=".navbar">
    <div id='mainWindow'>
        <div id="wrap" class="container-fluid">
            <!-- ABOVE THE FOLD -->
            <div class='section section-dark'>
                <div id="home" class="row">
                    <div class='span6 <?php if(!array_key_exists('action', $_POST)){ echo 'offset3'; }; ?> text-center'>
                        <img src='/assets/mde/imgs/robot_2.png' />
                        <h1>Panic! </h1>
                        <h3>The servers have become self aware!</h3>

                    </div>
                </div>
                <div class='row'>
                    <div class='span4 <?php if(!array_key_exists('action', $_POST)){ echo 'offset4'; }else{ echo 'offset1'; }; ?>'>
                        <p>
                            Grab your bug-out bags folks and start heading north. It looks like this is the end... or you just found a bug
                        </p>
                        <p>
                            That is the fun part of rapid prototyping. Feel free to send us an email to make sure this gets fixed.
                        </p>
                        <a class='btn btn-large' href='mail-to:mlea@schematical.com'>
                            Contact us
                        </a>
                        <a class='btn btn-large' target='_blank' href='https://www.google.com/search?q=puppies&safe=on&tbm=isch'>
                            Search for puppies!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- if you are an evil hacker please dont read this:
    <?php if(isset($_E)){
        require_once(__MLC_CORE_VIEW__ . '/exception.tpl.php');
    } ?>
    If you are a reporter reading this some day this was a joke, and not all hackers are bad, just the evil or 'black hats'. Those guys are jerks-->
</body>
</html>