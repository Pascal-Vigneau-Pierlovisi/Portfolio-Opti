@extends('base')
@section('content')


<section class="section" id="admin-dashboard">
    <div class="container">
        <h1 class="title has-text-centered">Dashboard Admin</h1>
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>Bienvenue, {{ session('admin_name', 'Admin') }}</strong>
                            <br>
                            Utilisez les options ci-dessous pour gérer votre portfolio.
                        </p>
                    </div>
                </div>
            </article>
        </div>

        <div class="columns is-multiline">
            {{-- Carte des paramètres --}}
            <div class="column is-one-third">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Paramètres</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Modifiez les paramètres de votre portfolio ici.
                        </div>
                    </div>
                    <footer class="card-footer">
                        <button class="button is-dark">Gérer</button>
                    </footer>
                </div>
            </div>

            {{-- Carte de profil --}}
            <div class="column is-one-third">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Profil</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Mettez à jour vos informations de profil.
                        </div>
                    </div>
                    <footer class="card-footer">
                        <button class="button is-dark">Gérer</button>
                    </footer>
                </div>
            </div>

            {{-- Carte des statistiques --}}
            <div class="column is-one-third">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Statistiques</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Voir les statistiques liées à votre portfolio.
                        </div>
                    </div>
                    <footer class="card-footer">
                        <button class="button is-dark">Gérer</button>
                    </footer>
                </div>
            </div>
        </div>

        {{-- Bouton de déconnexion --}}
        <div class="has-text-centered">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf {{-- Protection CSRF --}}
                <button type="submit" class="button is-danger">Déconnexion</button>
            </form>
        </div>
    </div>
</section>

@endsection