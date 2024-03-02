<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Html</title>
</head>
<body>
    <table>
        <tr><td>Dear {{$first_name}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Click on the below link to activate your account.</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><a href="{{url ('user/confirm/'.$code) }}">Confirm Account</a></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards</td></tr>
        <tr><td>SiteMaker.in</td></tr>
        <tr><td>&nbsp;</td></tr>


    </table>
</body>
</html>