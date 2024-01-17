<!-- resources/views/home.blade.php -->

@extends('base')
@section('content')
<section class="section" id="about-me">
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-12">
                <h1 class="title has-text-centered has-text-weight-bold">About Me</h1>
            </div>
            <div class="column is-6 is-offset-3 has-text-centered">
                <figure class="image is-128x128 is-inline-block profile-picture">
                    <div class="profile-container">
                        <figure class="image profile-picture">
                            <img class="profile-photo" src="/img/IMG_1317.jpg" alt="Photo de profil">
                            <img class="profile-logo" src="/img/logo.png" alt="Logo">
                        </figure>
                    </div>
                </figure>
            </div>
            <div class="column is-8 is-offset-2">
                <div class="box content-box">
                    <p class="subtitle has-text-centered has-text-weight-semibold">
                        I am currently a <strong>Master's student in Full-Stack Development</strong> at Corte, working as an apprentice at <strong>Crédit Agricole of Corsica</strong>. With a passion for <strong>web and mobile development</strong>, I possess a diverse range of knowledge across various digital fields.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="skills">
    <div class="container">
        <h2 class="title t has-text-centered">Primary Skills</h2>
        <div class="columns is-multiline">
            <!-- Skill Item: PHP -->
            <div class="column is-one-quarter-desktop is-half-tablet">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4"><i class="fab fa-php"></i> PHP</p>
                        <progress class="progress is-small is-link" value="100" max="100">100%</progress>
                    </div>
                </div>
            </div>
            <!-- Skill Item: Laravel -->
            <div class="column is-one-quarter-desktop is-half-tablet">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4"><i class="fab fa-laravel"></i> Laravel</p>
                        <progress class="progress is-small is-danger" value="95" max="100">95%</progress> <!-- Adjust the value as needed -->
                    </div>
                </div>
            </div>
            <!-- Skill Item -->
            <div class="column is-one-quarter-desktop is-half-tablet">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4"><i class="fab fa-angular"></i> Angular</p>
                        <progress class="progress is-small is-danger" value="90" max="100">90%</progress>
                    </div>
                </div>
            </div>
            <!-- Skill Item -->
            <div class="column is-one-quarter-desktop is-half-tablet">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4"><i class="fab fa-python"></i> Python</p>
                        <progress class="progress is-small is-link" value="90" max="100">90%</progress>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection