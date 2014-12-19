<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Dear {{$userTrip->user->fname}},</p>
    <p>This is a reminder regarding your payments for the CPS Immersion Trip: {{$trip->name}}</p>
    <p>{{$c_message}}</p>
    <table border="1">
      <tr>
        <td>Name: </td><td>{{$userTrip->user->fname .' '.$userTrip->user->lname}}</td></tr>
        <tr>
        <td>Trip: </td><td>{{$trip->name}}</td></tr>
        <tr><td>Total Cost: </td><td>${{$trip->cost}}</td></tr>
        <tr><td>Deposit: </td><td>${{$userTrip->deposit}}</td></tr>
        <tr><td>Student Leader Award: </td><td>${{$userTrip->leader_award}}</td></tr>
        <tr><td>Catholic Award: </td><td>${{$userTrip->catholic_award}}</td></tr>
        <tr><td>Scholarship Award-All: </td><td>${{$userTrip->scholarship_award}}</td></tr>
        <tr><td>First Payment Due {{$trip->first_due_day}}: </td><td>${{$due_amount}}</td></tr>
        <tr><td>Second Payment Due {{$trip->second_due_day}}: </td><td>${{$due_amount}}</td>
      </tr>
    </table>
    <p>Please use this {{link_to(("https://commerce.cashnet.com/CPSImmersionTrips"), 'link')}} to make the payment!</p>
    <p>Regards,
      <br/>
      <br>Jeff Rioux
    </p>
  </body>
</html>