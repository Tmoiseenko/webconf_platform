<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru-RU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <title>ИНФОСЭЛ</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0;background:#F9F9F9;font-family:'Open Sans'">
<!--[if mso]>
<style type="text/css">
body, table, td {font-family: Arial, Helvetica, sans-serif !important;}
</style>
<![endif]-->
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0;border-collapse: collapse;max-width: 650px">
        <tr>
            <td align="center" style="border: 1px solid transparent; background-color: #131954; height: 50px;">

            </td>
        </tr>
        <tr>
            <td align="center" style="border: 1px solid transparent;padding:20px 0 10px 0">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;font-weight:bolder;color:#131954;font-size:36px">{!! $event->title !!}</div>
            </td>
        </tr>
        <tr>
            <td align="center" style="border: 1px solid transparent;padding:0 0 20px 0;">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;font-weight:bolder;color:#283583;font-size:26px;padding:20px 20px;">{!!\Illuminate\Support\Carbon::parse($event->start_time)->translatedFormat('d F')!!} в
                    {!! \Illuminate\Support\Carbon::parse($event->start_time)->translatedFormat('H:i') !!}</div>
            </td>
        </tr>
        <tr>
            <td align="center" style="vertical-align:middle;padding:20px 20px;">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;text-align:center;color:#283583;font-size:16px;font-weight:normal;padding:0 20px 20px 20px">
                    {!! __('emails.sendCalendar.confirmation') !!}
                </div>
            </td>
        </tr>

        <tr>

        <tr style="padding:40px 0 40px 0;text-align:left;background:#F3F3F3;border: 1px solid transparent;">
            <td align="left" style="max-width:600px;padding:40px 20px 20px;vertical-align:middle">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;text-align:center;color:#000;font-size:16px;font-weight:normal;padding:0 20px 0 20px">
                    {!! __('emails.sendCalendar.description') !!}
                </div>
            </td>
        </tr>

        <tr style="padding:40px 0 40px 0;text-align:left;background:#F3F3F3;border: 1px solid transparent;">
            <td align="left" style="max-width:600px;padding:20px 20px 40px;vertical-align:middle">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;text-align:center;color:#000;font-size:16px;font-weight:normal;padding:0 20px 0 20px">
                    {!! __('emails.sendCalendar.reminding') !!}
                </div>
            </td>
        </tr>

        <tr style="padding:0px 0 40px 0;text-align:left;background:#F3F3F3;border: 1px solid transparent;">
            <td align="center" style="vertical-align:middle;padding:0 20px 20px 20px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0;border-collapse: collapse;">
                    <tbody>
                        <tr style="text-align:center;">
                            <td align="center" style="padding:20px 20px;vertical-align:middle;background:#C6201E;border-radius: 5px;">
                                <a href="https://conference.infocell.ru/event.ics" style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;color:#fff;text-decoration: none;font-size:20px;font-weight:bolder;">
                                    {!! __('emails.sendCalendar.addCalendar') !!}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr style="text-align:center;background:#131954;border: 1px solid transparent;">
            <td align="center" style="padding:20px 20px;vertical-align:middle">
                <div style="padding-bottom:20px;max-width: 600px;font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:16px;font-weight:bolder;">{!! __('emails.sendCalendar.translationLink') !!}</div>
            </td>
        <tr>

        <tr style="padding:0px 0 40px 0;text-align:left;background:#131954;border: 1px solid transparent;">
            <td align="center" style="vertical-align:middle;padding:0 20px 20px 20px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0;border-collapse: collapse;">
                    <tbody>
                        <tr style="text-align:center;">
                            <td align="center" style="padding:20px 20px;vertical-align:middle;background:#C6201E;border-radius: 5px;">
                                <a href="https://conference.infocell.ru" style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;color:#fff;text-decoration: none;font-size:20px;font-weight:bolder;">{!! __('emails.sendCalendar.translationButton') !!}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr style="text-align:center;background:#131954;border: 1px solid transparent;">
            <td align="center" style="padding:20px 20px;vertical-align:middle">
                <div style="max-width: 600px;font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:16px;font-weight:normal;">{!! __('emails.sendHourly.writeHere') !!}
                    <a style="color:#fff;text-decoration:underline" href="mailto:{!! env('CLIENT_MAIL_ADDRESS') !!}">{!! env('CLIENT_MAIL_ADDRESS') !!}</a></div>
                <div style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:16px;font-weight:bolder;padding-top:20px">{!! __('emails.sendHourly.waitYou') !!}</div>
            </td>
        <tr>
    </table>
</body>
</html>
