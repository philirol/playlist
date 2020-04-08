@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Plan E</div>
                <div class="card-body">     
                                   
                    <form action="{{ route('plane.post') }}" method="post">
                    @csrf
                        <label for="prix">Prix</label>
                        <input type="text" name="prix" id="prix">
                        <button>Procéder au paiement</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection