@extends('base')
@section('content')
<section class="section" id="contact">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <h1 class="title">To contact me</h1>
                <p class="subtitle">The contact form is for professional purposes</p>

                <div class="box">
                    <form action="/send-email" method="post">
                    @csrf <!-- Token CSRF pour la protection contre les attaques de type CSRF -->
                        <div class="field">
                            <label class="label" for="name">Name</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" id="name" name="name" placeholder="Your name" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="email">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" id="email" name="email" placeholder="Your email" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="message">Message</label>
                            <div class="control">
                                <textarea class="textarea" id="message" name="message" placeholder="Your message" required></textarea>
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-dark">Submit</button>
                            </div>
                            <div class="control">
                                <button type="reset" class="button is-light">Cancel</button>
                            </div>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div>


                <p>If you prefer, you can also reach me:</p>
                <ul>
                    <li><strong>Phone:</strong> +33 6 50 91 04 25</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection