@extends('layouts.app')

@section('content')

<table class="table">
  <tr class="table-info">
    <td class="align-middle"><h4>{{ __(session('listname')) }} @lang('de') {{ $bandname }}</h4>
    <!-- Plus utilisé à cause de la partie Admin où on passe l'id du groupe en paramètre 
    @if (Auth::check())
    {{ Auth::user()->band->bandname }}
    @else
    Démo
    @endif
    -->
    </u></h3></td>
    @if(Auth::check())
    <td class="text-right"><a href="{{ route('songs.create') }}" class="btn btn-primary my-3">@lang('Nouveau morceau')</a></td>
    @endif
  </tr>
</table>

<table class="table table-striped">
  <tbody id="tablecontents"> {{-- tbody for sorting list js --}}
    @foreach($songs as $song)
      <tr class="row1" data-id="{{ $song->id }}">
        <th class="pl-3"><i class="fa fa-sort"></i></th>
        {{--<td class="text-center">{{ $song->order }}</td> --}}
        <td><a href="{{ route('songs.show', $song->id) }}">{{ $song->title  }}</a></td>
        {{--<td>{{ $song->list }}</td> --}}
        @if($song->comments)
        <td><i class="fa fa-comments" aria-hidden="true" title="@lang('Commentaires')"></i></td>
        @else<td>&nbsp;</td>
        @endif
        @if($song->songsub>0)
        <td><img src="{{asset('images/folder.png')}}" alt="files attached" title="{{ $song->songsub }} @lang('Fichiers attachés')"></td>      
        @else<td>&nbsp;</td>
        @endif
        @if($song->url)
        <td><a href="{{ $song->url }}" target="_blank"><img src="{{asset('images/ytb.png')}}" alt="logo youtube" height="22" width="33" title="@lang('Aller sur le lien')"></a></td>      
        @else<td>&nbsp;</td>
        @endif
      </tr>
      @endforeach
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