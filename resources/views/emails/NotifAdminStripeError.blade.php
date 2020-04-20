<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist</title>
   <style>
    body {
   font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
    }
   </style> 
</head>
<body>
    
<h4>A Stripe error occured on Playlist :</h>
<br>
<p>Classe de l'erreur : @isset($error['class']) {{ $error['class'] }} @endisset</p>
<p>Status : @isset($error['status']) {{ $error['status'] }} @endisset</p>
<p>Type : @isset($error['type']) {{ $error['type'] }} @endisset</p>
<p>Code : @isset($error['code']) {{ $error['code'] }} @endisset </p>
<p>Param : @isset($error['param']) {{ $error['param'] }} @endisset</p>
<p>Stripe type : @isset($error['stripe']) {{ $error['stripe'] }} @endisset</p>
<p>Message from admin : @isset($error['message']) <strong>{{ $error['message'] }}</strong> @endisset</p>

</body>
</html>