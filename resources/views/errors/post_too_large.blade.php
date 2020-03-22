@extends('layouts.app')

@section('content')
    <br><h5>
    @lang('La taille des fichiers est limitée à ')2Mo
    </h5><br><br>
    <a href="javascript:history.back()" class="btn btn-primary">
    <span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
    </a>
@endsection