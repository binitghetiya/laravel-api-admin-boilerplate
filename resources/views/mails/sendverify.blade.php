<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>{{config('app.name')}}</title>
    </head>
    <body style="font-family:arial; font-size:16px; border:0; color:#4c4c4c; padding:0; margin:0;">
        <table width="100%" style="font-family:arial; font-size:16px; border:0px solid #000; max-width:700px; padding-top:30px; border:0;"  align="center" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td>
                        <table width="100%" style="font-family:arial; font-size:16px; border:1px solid #afafaf; max-width:700px;"  align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="100%" style="max-width:700px;" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding:20px; background-color:#000;">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td valign="bottom">
                                                                <a target="_blanck" href="#" style="outline:none;">
                                                                    <img src="{{config('app.url')}}/site_img/logo.png" alt="" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:30px; font-size:16px; color:#4c4c4c;">
                                                    <h1 style="font-size:30px; color:#000; font-weight:normal; padding:0; margin:0 0 30px 0;">Hello {{$username}},</h1>
                                                    <p style="line-height:24px; margin:0 0 20px 0;">Please click below link to verify your email.</p>
                                                    <a href="{{$link}}" style="background-color:#ff8700; color: #FFFFFF; display: inline-block; letter-spacing:1px; font-size: 15px; padding: 15px 30px 15px 30px; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px; text-decoration:none;">Verify Email</a>
                                                    <br><br>
                                                    <p style="line-height:24px; margin:0 0 30px 0;">Thanks,<br><b>{{config('app.name')}}</b></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:10px; padding:20px 0 30px 0; color:#a6a6a6; text-transform:uppercase; text-align:center;">
                        &#169;  {{date('Y')}} {{config('app.name')}}
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
