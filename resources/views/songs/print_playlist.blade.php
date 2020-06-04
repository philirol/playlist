<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        html { margin-top: 40px; margin-left: 70px;}

        h3 { text-decoration: underline; }

        table, td {
            /* border-collapse: collapse;
            border: 1px solid black; */
            /* width: 20%; */
            text-align: left;
            }
        th, td {
            height: 20px;
            }
        body {
            font-family:arial, sans-serif;
            font-size: 1.3em;
            }
    </style>
</head>
<body>

<h3>Playlist {{$bandname}}</h3>

<table>
  <tbody>
    @foreach($data as $song)
      <tr>
        <td>{{ $song->order }}&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>{{ $song->title }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>



