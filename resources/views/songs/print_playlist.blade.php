
<link href="{{asset('css/print.css')}}" rel="stylesheet">
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




