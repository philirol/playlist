@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" :band="$band" page="{{__('Suppression du groupe')}}" margbot="3"/>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
        <br>
        <div class="p-3 mb-2 bg-danger text-white">
            <p>En confirmant cette action, tous les membres du groupe ainsi que tout les fichiers téléchargés disparaîtront. Cet action est irréversible</p>
            <p class="note">By confirming this action, all group members and all downloaded files will disappear. This action is irreversible.</p>
        </div>
        <form action="{{ route('band.destroy', ['band' => $band->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-primary my-4">@lang('Supprimer le groupe')</button>
        </form>        
        <a href="{{ route('band.show')  }}" class="btn btn-outline-primary">@lang('Retour')</a>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    function delAsk() {
      if(!confirm('Are you sure ?'))
      event.preventDefault();
  }
</script>        
@endsection