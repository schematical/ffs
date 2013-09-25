<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>
        <?php echo $SUBJECT; ?>
    </title>
    <style type="text/css">
        a:hover { text-decoration: none !important; }
        .header h1 {color: #47c8db !important; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;}
        .header p {color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;}

        .content h2 {color:#646464 !important; font-weight: bold; margin: 0; padding: 0; line-height: 26px; font-size: 18px; font-family: Helvetica, Arial, sans-serif;  }
        .content p {color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Helvetica, Arial, sans-serif;}
        .content a {color: #0eb6ce; text-decoration: none;}
        .footer p {font-size: 11px; color:#7d7a7a; margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;}
        .footer a {color: #0eb6ce; text-decoration: none;}
    </style>
</head>
<body style="margin: 0; padding: 0; background: #4b4b4b url('images/bg_email.png');" bgcolor="#4b4b4b">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 35px 0; background: #4b4b4b url('images/bg_email.png');">
    <tr>
        <td align="center" style="margin: 0; padding: 0; background: url('images/bg_email.png') ;" >
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Helvetica, Arial, sans-serif; background:#2a2a2a;" class="header">
                <tr>
                    <td width="600" align="left" style="padding: font-size: 0; line-height: 0; height: 7px;" height="7" colspan="2"><img src="<?php echo __ASSETS__; ?>/email/images/bg_header.png" alt="header bg"></td>
                </tr>
                <tr>
                    <td width="20"style="font-size: 0px;">&nbsp;</td>
                    <td width="580" align="left" style="padding: 18px 0 10px;">
                        <h1 style="color: #47c8db; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;">
                            TumbleScore.com
                        </h1>

                    </td>
                </tr>
            </table><!-- header-->
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Helvetica, Arial, sans-serif; background: #fff;" bgcolor="#fff">

                <tr>
                    <td width="600" valign="top" align="left" style="font-family: Helvetica, Arial, sans-serif; padding: 20px 0 0;" class="content">
                        <table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Helvetica, Arial, sans-serif; margin: 0; padding: 0;" width="600">
                            <tr>
                                <td width="21" style="font-size: 1px; line-height: 1px;"><img src="<?php echo __ASSETS__; ?>/email/images/spacer.gif" alt="space" width="20"></td>
                                <td style="padding: 0;  font-family: Helvetica, Arial, sans-serif; background: url('images/bg_date_wide.png') no-repeat left top; height:20px; line-height: 20px;"  align="center" width="558" height="20">
                                    <h3 style="color:#666; font-weight: bold; text-transform: uppercase; margin: 0; padding: 0; line-height: 10px; font-size: 10px;"><currentdayname> <currentday> <currentmonthname></h3>
                                </td>
                                <td width="21" style="font-size: 1px; line-height: 1px;"><img src="<?php echo __ASSETS__; ?>/email/images/spacer.gif" alt="space" width="20"></td>
                            </tr>
                            <tr>
                                <td width="21" style="font-size: 1px; line-height: 1px;"><img src="<?php echo __ASSETS__; ?>/email/images/spacer.gif" alt="space" width="20"></td>
                                <td style="padding: 20px 0 0;" align="left">
                                    <h2 style="color:#646464; font-weight: bold; margin: 0; padding: 0; line-height: 26px; font-size: 18px; font-family: Helvetica, Arial, sans-serif; ">
                                        <?php echo $SUBJECT; ?>
                                    </h2>
                                </td>
                                <td width="21" style="font-size: 1px; line-height: 1px;"><img src="<?php echo __ASSETS__; ?>/email/images/spacer.gif" alt="space" width="20"></td>
                            </tr>
                            <tr>
                                <td width="21" style="font-size: 1px; line-height: 1px;"><img src="<?php echo __ASSETS__; ?>/email/images/spacer.gif" alt="space" width="20"></td>
                                <td style="padding: 15px 0 15px;"  valign="top">