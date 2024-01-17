@extends('base')
@section('content')

<center>
    <section id="login">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-4-desktop">
                        <div class="login-container">
                            <div class="box">
                                <h1 class="title has-text-centered">Login</h1>
                                <form action="/admin/login" method="post">
                                    @csrf <!-- Token CSRF pour la protection contre les attaques de type CSRF -->
                                    <div class="field">
                                        <label class="label" for="email">Email</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="email" id="email" name="email" required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="password">Password</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" id="password" name="password" required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <button class="button is-dark is-fullwidth">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</center>

@endsection