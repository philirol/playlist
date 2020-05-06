@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>Stripe Products & plans</h4></td>
  </tr>
</table>
</div>
<div class="py-3 row justify-content-center">
        <div class="jumbotron">
        Cliquer d'abord sur le bouton Creat Product pour créer le produit dans Stripe.<br>
        Une fois que le produit est créé, créer son plan tarifaire :<br>
        reporter son numéro de produit Stripe (aller voir sur Stripe) dans la zone ID product.<br>
        (l'ID du plan est celui en base dans la table "plans", il est directement inclus en "hidden" dans le formulaire).<br>
        Indiquez un montant en centimes d'euros dans la zone "amount" et envoyer le formulaire.<br>
        <span class="note">Supprimer les produits sur Stripe ne supprime pas les clients.</span>
        
        </div>
    <div class="col-md-8">
        <ul class="list-group">
            <li class="list-group-item clearfix">
                <a href="{{ route('plans.createProd','Basic') }}" class="btn btn-outline-dark">Create Basic product</a>
                <br><br>
                <form action="{{ route('plans.createPlan') }}" method="post">
                    @csrf
                    <div>
                        <label for="id">ID product</label>
                        <input type="text" name="id_product" size="40"><br>
                        <label for="id">amount/year</label>
                        <input type="text" name="amount" placeholder="enter 500 for 5€">
                        <input type="hidden" name="nickname" value="Basic">
                        <input type="hidden" name="plan" value="plan_H57guQCYMdY92N"><br>
                        <button>Go</button>
                        <br><br>
                        <p class="note">(id plan : plan_H57guQCYMdY92N)</p>
                    </div> 
                </form>
            </li>
            <li class="list-group-item clearfix">
                <a href="{{ route('plans.createProd','Stage') }}" class="btn btn-outline-dark">Create Stage product</a>
                <br><br>
                <form action="{{ route('plans.createPlan') }}" method="post">
                    @csrf
                    <div>
                        <label for="id">ID product</label>
                        <input type="text" name="id_product" size="40"><br>
                        <label for="id">amount/year</label>
                        <input type="text" name="amount" placeholder="enter 1000 for 10€"> 
                        <input type="hidden" name="nickname" value="Stage">
                        <input type="hidden" name="plan" value="plan_P12MfgYtEZ45RE"><br>
                        <button>Go</button>
                        <br>
                        <p class="note">(id plan : plan_P12MfgYtEZ45RE)</p>
                    </div> 
                </form>
            </li>
            <li class="list-group-item clearfix">
                <a href="{{ route('plans.createProd','Expand') }}" class="btn btn-outline-dark">Create Expand product</a>
                <br><br>
                <form action="{{ route('plans.createPlan') }}" method="post">
                    @csrf
                    <div>
                        <label for="id">ID product</label>
                        <input type="text" name="id_product" size="40"><br>
                        <label for="id">amount/year</label>
                        <input type="text" name="amount" placeholder="enter 2000 for 20€">
                        <input type="hidden" name="nickname" value="Expand">
                        <input type="hidden" name="plan" value="plan_H4Oq0K9DGJLYZu"><br>
                        <button>Go</button>
                        <br><br>
                        <p class="note">(id plan : plan_H4Oq0K9DGJLYZu)</p>
                    </div> 
                </form>
            </li>
        </ul>
        <br><br><br><br>
        Check IDs <a href="https://dashboard.stripe.com/test/subscriptions/products" target="_blank">here</a>
        &nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="https://stripe.com/docs/billing/subscriptions/products-and-plans" target="_blank" rel="noopener noreferrer">Stripe doc</a>
    </div>
</div>


@endsection