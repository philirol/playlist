@extends('layouts.appmedia')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>{{ $bandname }}</h4> <h6>{{ __(session('listname')) }}</h6></td>
    @if(Auth::check())
    <td class="text-right"><a href="{{ route('songs.create') }}" class="btn btn-primary my-3">@lang('Nouveau morceau')</a></td>
    @endif
  </tr>
</table>
</div>
<table class="table table-striped">
  <tbody id="tablecontents"> {{-- tbody for sorting list js --}}
    @foreach($songs as $song)
      <tr class="row1" data-id="{{ $song->id }}">
        <th><img src="{{asset('images/updownarrow.png')}}"></th>
        <td><a href="{{ route('songs.show', $song->id) }}" title="{{ $song->songsub }} @lang('Fichier(s)/lien(s)')">{{ $song->title }}</a></td>
        @if($song->comments)
        <td><img src="{{asset('images/comment.png')}}" title="{{ substr($song->comments, 0, 50) }}..."></td>
        @else
        <td>&nbsp;</td>
        @endif
        <td>
        @foreach($song->songsubs as $songsub)        
          @if($songsub->main == 1)
          
          @switch($songsub->type)
              @case(1)
              @if( preg_match('/(vimeo)/', $songsub->url ) || preg_match('/(yout)/', $songsub->url ))
              <a href="{{ route('player',  $songsub) }}"><img src="{{asset('images/ytb.png')}}" alt="@lang('Ouvrir dans le lecteur')" title="@lang('Ouvrir dans le lecteur')"></a>
              @else
              <a href="{{ $songsub->url }}" target="_blank"><img src="{{asset('images/www.png')}}" width="22" height="22" alt="@lang('Ouvrir dans site web')" title="@lang('Ouvrir dans site web')"></a>
              @endif
                  @break

              @case(2)
              <a href="#" onClick="javascript:vidSwap('{{ asset('storage/' . $songsub->file) }}'); return false;"><img src="{{asset('images/file2.png')}}" alt="@lang('Ouvrir dans le lecteur')" title="@lang('Ouvrir dans le lecteur')"></a>
          {{-- 
              <a href="{{ action('SongController@index', ['player' =>$songsub]) }}"><img src="{{asset('images/file.png')}}" alt="Go Youtube"></a>
          
              <figure>
              <figcaption>{{ $songsub->title }}:</figcaption>
              <audio controls src="{{ asset('storage/' . $songsub->file) }}">Your browser does not support the <code>audio</code> element.</audio>
              </figure>
          --}}
                  @break

              @default
              <a href="{{ route('songsub.dwnld', ['songsub' => $songsub->id]) }}"><img src="{{asset('images/dwnld.png')}}" width="22" height="22" alt="@lang('Télécharger le fichier')" title="@lang('Télécharger le fichier')"></a>
          @endswitch

          @endif          
        @endforeach
        </td>
      </tr>
    @endforeach
      <tr>
        <td colspan="4"><img src="{{asset('images/uparrow.png')}}"><span class="align-bottom">&nbsp;&nbsp;<span class="note">@lang('Ordonner les lignes avec')</span>&nbsp;&nbsp;<img src="{{asset('images/updownarrow.png')}}"></span></td>
      </tr>
    </tbody>
</table>

{{--<button class="btn btn-success btn-sm" onclick="window.location.reload()">Réord.</button> --}}


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/dragdrop.js') }}"></script> -->
    <!-- <script src="{{ asset('js/test.js') }}"></script> -->
    <script type="text/javascript">
    $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({             
            dataType: "json", 
            url: "{{ route('orderingPlaylist') }}",
            type: 'POST',
            data: {order: order, _token: token},
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
      </script>
@endsection