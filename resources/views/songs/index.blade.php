@extends('layouts.app')

@section('content')

<table class="table">
  <tr class="table-info">
    <td class="align-middle"><h3>{{ __(session('listname')) }} : {{ $bandname }}<u>
    <!-- Plus utilisé à cause de la partie Admin où on passe l'id du groupe en paramètre 
    @if (Auth::check())
    {{ Auth::user()->band->bandname }}
    @else
    Démo
    @endif
    -->
    </u></h3></td>
    @if(Auth::check() and !Auth::user()->admin)
    <td class="text-right"><a href="{{ route('songs.create') }}" class="btn btn-primary my-3">@lang('Nouveau morceau')</a></td>
    @endif
  </tr>
</table>

<table class="table table-striped">
  <thead>
    <tr>
      <td scope="col">AA</td>
      <td scope="col">order</td>
      <td scope="col">titre</td>
      <td scope="col">list</td>
      <td scope="col">ref</td>
      <td scope="col">Groupe</td>
    </tr>
  </thead>
  <tbody id="tablecontents">
  @foreach($songs as $song)
    <tr class="row1" data-id="{{ $song->id }}">
      <th class="pl-3"><i class="fa fa-sort"></i></th>
      <td class="text-center">{{ $song->order }}</td>
      <td><a href="{{ route('songs.show', ['song' => $song->id]) }}">{{ $song->title  }}</a></td>
      <td>{{ $song->list }}</td>
      <td>{{ $song->reference }}</td>
      <td>{{ $song->band->bandname }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button class="btn btn-success btn-sm" onclick="window.location.reload()">Réord.</button>


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