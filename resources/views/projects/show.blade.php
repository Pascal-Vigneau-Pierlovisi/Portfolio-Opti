{{-- projects/show.blade.php --}}
@extends('base')

@section('content')

<style>
    @keyframes blink {
        50% {
            border-color: transparent;
        }
    }

    .typing {
        border-right: 3px solid;
        animation: blink 1s step-end infinite;
    }

    .cursor {
        opacity: 1;
        animation: blink 1s step-end infinite;
    }

    .image-container {
        position: relative;
    }

    .edit-icon#main-picture {
        position: absolute;
        top: 10px;
        /* Ajustez selon vos besoins */
        right: 10px;
        /* Ajustez selon vos besoins */
        z-index: 10;
        /* Assurez-vous que l'icône reste au-dessus de l'image */
        color: white;
        /* Changez la couleur si nécessaire */
    }

    /* Styles par défaut pour les écrans plus grands */
    #title-reduct {
        font-size: 2rem;
        /* Taille par défaut */
    }


    /* Styles pour les écrans de moins de 768px (par exemple) */
    @media screen and (max-width: 768px) {
        #title-reduct {
            font-size: 1.5rem;
            /* Taille plus petite pour le mobile */
        }

        .edit-icon .icon i {
            font-size: 0.75rem;
            /* Taille plus petite pour l'icône sur mobile */
        }
    }
</style>


<section id="projectshow">

    <div class="container mt-5">
        <h1 class="title is-2 has-text-centered" id="title-reduct">
            <span id="typing-effect" data-title="{{ $project->title }}"></span>
            <span id="cursor" class="cursor">|</span>
            @if(Auth::guard('admin')->check())
            <a class="edit-icon" id="edit-title" data-target="edit-title-modal">
                <span class="icon is-clickable">
                    <i class="fas fa-pencil-alt" style="font-size: 0.5em; color: #ffcc00;"></i>
                </span>
            </a>
            @endif
        </h1>


        <div style="margin:0" class="columns is-centered">
            <!-- Ajustez la taille de la colonne pour différents écrans -->
            <div class="column is-half-desktop is-full-mobile">
                <div class="image-container">
                    <figure class="image is-3by2">
                        <img src="{{ asset($project->mainPicture) }}" alt="{{ $project->title }}" class="project-main-image">
                    </figure>
                    @if(Auth::guard('admin')->check())
                    <a id="main-picture" class="edit-icon" data-target="edit-mainPicture-modal">
                        <span class="icon">
                            <i class="fas fa-pencil-alt" style="color:#ffcc00"></i>
                        </span>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="box">
            <div class="media">
                <div class="media-content">
                    <h2 class="title is-4">Description</h2>
                    <p>{!! $project->mainDescription !!}</p>
                </div>
                @if(Auth::guard('admin')->check())
                <div class="media-right">
                    <a id="open-mainDescription-modal" class="edit-icon">
                        <span class="icon">
                            <i class="fas fa-pencil-alt" style="color : #ffcc00;"></i>
                        </span>
                    </a>
                </div>
                @endif
            </div>
            @if($project->secondDescription)
            <div class="media">
                <div class="media-content">
                    <h2 class="title is-4">More</h2>
                    <p>{!! $project->secondDescription !!}</p>
                </div>
                @if(Auth::guard('admin')->check())
                <div class="media-right">
                    <a id="open-secondDescription-modal" class="edit-icon">
                        <span class="icon">
                            <i class="fas fa-pencil-alt" style="color : #ffcc00;"></i>
                        </span>
                    </a>
                </div>
                @endif
            </div>
            @else
            @if(Auth::guard('admin')->check())
            <br>
            <div class="has-text-centered">
                <a class="button is-black" href="{{ route('projects.index') }}">+ Second Description</a>
            </div>
            @endif
            @endif

        </div>

        @if($project->projectPictures->isNotEmpty())
        <div class="box">
            <div class="media">
                <div class="media-content">
                    <h2 class="title is-4">Image gallery</h2>
                </div>
                @if(Auth::guard('admin')->check())
                <div class="media-right">
                    <a id="open-gallery-modal" class="edit-icon">
                        <span class="icon">
                            <i class="fas fa-pencil-alt" style="color : #ffcc00;"></i>
                        </span>
                    </a>
                </div>
                @endif
            </div>
            <br>
            <div class="columns is-multiline" id="projectImages">
                @foreach($project->projectPictures as $picture)
                <div class="column is-one-quarter">
                    <figure class="image is-4by3">
                        <img src="{{ asset($picture->picture) }}" alt="Additional image">
                    </figure>
                </div>
                @endforeach
            </div>
        </div>
        @else
        @if(Auth::guard('admin')->check())
        <div class="box has-text-centered">
            <a class="button is-black" id="open-add-picture-modal">+ Pictures</a>
        </div>
        @endif
        @endif

        @if($project->githubLink)
        <div class="box has-text-centered">
            <h2 class="title is-4">GitHub</h2>
            <a style="color: inherit;" href="{{ $project->githubLink }}" target="_blank">
                <span class="icon">
                    <i class="fab fa-github fa-2x"></i>
                </span>
            </a>
            @if(Auth::guard('admin')->check())
            <div class="media-right">
                <a id="open-github-modal" class="edit-icon">
                    <span class="icon">
                        <i class="fas fa-pencil-alt" style="color : #ffcc00;"></i>
                    </span>
                </a>
            </div>
            @endif

        </div>
        @else
        @if(Auth::guard('admin')->check())
        <div class="box has-text-centered">
            <a id="open-github-modal" class="button is-black">+ GitHub</a>
        </div>
        @endif
        @endif
    </div>


</section>

@if(Auth::guard('admin')->check())
<div id="edit-title-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Edit Title</p>
            <button class="delete is-pulled-right" aria-label="close" data-target="edit-title-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-form" action="{{ route('projects.edit.title', ['project' => $project]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field has-text-centered">
                    <label class="label">New Title</label>
                    <div class="control">
                        <input class="input" type="text" id="edited-title" name="title" value="{{ $project->title }}">
                    </div>
                </div>
                <div class="field has-text-centered">
                    <button class="button is-black" type="submit" id="save-title-button">Save</button>
                </div>
            </form>
        </section>
    </div>
</div>

<div id="edit-mainDescription-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Edit main description</p>
            <button class="delete is-pulled-right" aria-label="close" data-target="edit-title-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-form" action="{{ route('projects.edit.mainDescription', ['project' => $project]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field has-text-centered">
                    <label class="label">New description</label>
                    <div class="control">
                        <textarea class="textarea" id="edited-title" name="mainDescription">{{ $project->mainDescription }}</textarea>
                    </div>
                </div>
                <div class="field has-text-centered">
                    <button class="button is-black" type="submit" id="save-title-button">Save</button>
                </div>
            </form>
        </section>
    </div>
</div>

<div id="edit-secondDescription-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Edit second description</p>
            <button class="delete is-pulled-right" aria-label="close" data-target="edit-title-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-form" action="{{ route('projects.edit.secondDescription', ['project' => $project]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field has-text-centered">
                    <label class="label">New description</label>
                    <div class="control">
                        <textarea class="textarea" id="edited-title" name="secondDescription">{{ $project->secondDescription }}</textarea>
                    </div>
                </div>
                <div class="field has-text-centered">
                    <button class="button is-black" type="submit" id="save-title-button">Save</button>
                </div>
            </form>
        </section>
    </div>
</div>




<div id="edit-mainPicture-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Edit MainPicture</p>
            <button class="delete is-pulled-right" aria-label="close" data-target="edit-image-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-image-form" action="{{ route('projects.edit.mainPicture', ['project' => $project]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="field is-grouped is-grouped-centered">
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input" type="file" id="new-image" name="mainPicture">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                            </span>
                            <span class="file-name">
                                No file selected
                            </span>
                        </label>
                    </div>
                </div>
                <center><button class="button is-black" type="submit" id="save-image-button">Save</button></center>
            </form>
        </section>
    </div>
</div>

<div id="edit-picture-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Edit Picture</p>
            <!-- Utilisez un attribut data-target pour cibler la modal à fermer -->
            <button class="delete is-pulled-right" aria-label="close" data-target="edit-picture-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="edit-image-form" action="{{ route('projects.edit.picture')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Utilisez un champ caché pour stocker l'ID de l'image -->
                <input type="hidden" name="id" value="" id="modal-edit-picture">
                <div class="field is-grouped is-grouped-centered">
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input picture-file-input" type="file" id="new-picture" name="picture">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                            </span>
                            <span class="file-name picture-file-name">
                                No file selected
                            </span>
                        </label>
                    </div>
                </div>
                <center><button class="button is-black" type="submit" id="save-image-button">Save</button></center>
            </form>
        </section>
    </div>
</div>

<!-- La modal -->
<div id="github-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head has-text-centered"> <!-- Ajout de la classe "has-text-centered" pour centrer le titre -->
            <p class="modal-card-title">Add GitHub</p>
            <button class="delete" aria-label="close" id="close-github-modal"></button>
        </header>
        <section class="modal-card-body has-text-centered"> <!-- Ajout de la classe "has-text-centered" pour centrer le contenu -->
            <form id="github-form" action="{{ route('projects.add.github', ['project' => $project]) }}" method="POST">
                @csrf
                <div class="field">
                    <label class="label">GitHub Link</label>
                    <div class="control">
                        <input class="input" type="text" id="github-link" name="github_link" placeholder="Enter Github link">
                    </div>
                </div>
                <button class="button is-dark" id="save-github-link" type="submit">Save</button> <!-- Bouton de soumission dans le formulaire -->
            </form>
        </section>
    </div>
</div>


<div class="modal" id="edit-picture-gallery">
    <div class="modal-background"></div>
    <div class="modal-content is-centered"> <!-- Ajoutez la classe is-centered ici -->
        <div class="modal-card" style="margin: 0;">
            <header class="modal-card-head">
                <p class="modal-card-title">Manage Image Gallery</p>
                <button class="delete" aria-label="close" id="close-gallery-modal"></button>
            </header>
            <section class="modal-card-body">
                <!-- Ajoutez ici la liste des noms d'images de la galerie avec des boutons pour la suppression et la modification -->
                <ul class="list-group">
                    @foreach($project->projectPictures as $picture)
                    <li class="list-group-item">
                        <span class="has-text-black">{{ basename($picture->picture) }}</span>
                        <div class="buttons is-pulled-right">
                            <form action="{{ route('projects.destroy.picture', $picture)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button is-danger is-small">Delete</button>
                            </form>
                            <br> <!-- Ajoutez un saut de ligne ici -->
                            <!-- Utilisez un identifiant unique basé sur l'ID de l'image -->
                            <button id="open-edit-picture-modal-{{ $picture->id }}" data-target="#edit-picture-modal" data-id="{{ $picture->id }}" style="margin-left:2px;" class="button is-black is-small">Edit</button>
                        </div>
                    </li>
                    <br>
                    @endforeach
                    <!-- Ajoutez d'autres éléments de liste pour chaque nom d'image de la galerie -->
                </ul>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-black">+ Add Image</button>
            </footer>
        </div>
    </div>
</div>


<div id="add-picture-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-centered">Add Picture</p>
            <button class="delete is-pulled-right" aria-label="close" data-target="add-picture-modal"></button>
        </header>
        <section class="modal-card-body">
            <form id="add-image-form" action="{{ route('projects.add.picture', ['project' => $project]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field is-grouped is-grouped-centered">
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input add-picture-input" type="file" id="new-image" name="picture">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                            </span>
                            <span class="file-name add-picture-name">
                                No file selected
                            </span>
                        </label>
                    </div>
                </div>
                <center><button class="button is-black" type="submit" id="add-image-button">Add</button></center>
            </form>
        </section>
    </div>
</div>







@endif



<br>
@endsection
@section('scripts')
<script src="/js/projects-show.js"></script>
@if(Auth::guard('admin')->check())
@if($project->secondDescription)
<script src="/js/projects-show-sd.js"></script>
@endif
@if($project->projectPictures->isNotEmpty())
<script src="/js/projects-show-up.js"></script>
@endif
<script src="/js/projects-show-admin.js"></script>
@endif





@endsection