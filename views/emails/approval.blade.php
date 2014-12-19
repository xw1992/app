<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Dear {{$name}},</p>
    <p>Your application for the Gettysburg College CPS Immersion Trip: {{$trip_name}} has been approve!</p>
    <p>Please use this {{link_to(("https://commerce.cashnet.com/CPSImmersionTrips"), 'link')}} to make your deposit!</p>
    <p>Regards,
      <br/>
      <br>Jeff Rioux
    </p>
  </body>
</html>