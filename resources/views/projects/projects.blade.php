<!-- resources/views/home.blade.php -->

@extends('base')
@section('content')

<!-- Section Projects -->
<section class="section" id="projects">
    <div class="container">
        <h2 class="title has-text-centered">Projects</h2>

        <!-- Bouton d'ajout de projet pour l'admin -->
        @if(Auth::guard('admin')->check())
        <div class="has-text-right" style="margin-bottom: 20px;">
            <button class="button is-black" id="add-project-button">
                <span class="icon is-small">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </div>
        @endif
        <!-- Filter Menu -->
        <!-- ... -->
        <div class="tabs is-centered">
            <ul>
                <li class="is-active" data-filter="all"><a>All</a></li>
                @foreach($categories as $category)
                <li data-filter="{{ $category->libelle }}"><a>{{ $category->libelle }}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- Projects Grid -->
        <div class="columns is-multiline" id="projects-grid">
            @foreach($projects as $project)
            <!-- Project Card -->
            <div class="column is-one-quarter" data-category="{{ $project->category->libelle }}">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="{{ $project->mainPicture }}" alt="{{ $project->title }}">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <p class="title is-5">{{ $project->title }}</p>
                            <p class="subtitle is-6">{{ $project->summary }}</p>
                            <a href="{{ route('projects.show', $project) }}" class="button is-white is-outlined">
                                <span>Learn More</span>
                                <span class="icon">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>
                            @if(Auth::guard('admin')->check())
                            <div class="card-footer is-flex is-justify-content-space-between">
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="card-footer-item">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- ... -->

</section>


@if(Auth::guard('admin')->check())
<!-- Project Add Modal -->
<!-- Modal Structure -->
<div class="modal" id="add-project-modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Add New Project</p>
            <button id="close-modal" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <form id="add-project-form" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- GitHub Link -->
                <div class="field">
                    <label class="label">Title of Project</label>
                    <div class="control">
                        <input class="input" type="text" name="title" placeholder="Title of project" required>
                    </div>
                </div>
                <!-- Champ pour l'image principale du projet -->
                <div class="field">
                    <label class="label">Project Main Image</label>
                    <div class="file has-name is-fullwidth">
                        <label class="file-label">
                            <input class="file-input" type="file" name="mainPicture" id="main-picture-input" required>
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                            </span>
                            <span class="file-name" id="main-picture-name">
                                No file chosen
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Champ pour les images supplémentaires du projet -->
                <div class="field">
                    <label class="label">Additional Project Images</label>
                    <div class="file has-name is-fullwidth">
                        <label class="file-label">
                            <input class="file-input" type="file" name="projectImages[]" id="additional-images-input" multiple>
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose files…
                                </span>
                            </span>
                            <span class="file-name" id="additional-images-name">
                                No files chosen
                            </span>
                        </label>
                    </div>
                </div>


                <!-- Project Summary -->
                <div class="field">
                    <label class="label">Summary</label>
                    <div class="control">
                        <textarea class="textarea" name="summary" placeholder="Project summary..." required></textarea>
                    </div>
                </div>

                <!-- Project Category -->
                <div class="field">
                    <label class="label">Category</label>
                    <div class="control">
                        <div class="select">
                            <select name="idCat" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Main Description -->
                <div class="field">
                    <label class="label">Main Description</label>
                    <div class="control">
                        <textarea class="textarea" name="mainDescription" placeholder="Detailed description..." required></textarea>
                    </div>
                </div>

                <!-- Second Description -->
                <div class="field">
                    <label class="label">Second Description (Optional)</label>
                    <div class="control">
                        <textarea class="textarea" name="secondDescription" placeholder="Additional details..."></textarea>
                    </div>
                </div>

                <!-- GitHub Link -->
                <div class="field">
                    <label class="label">GitHub Link (Optional)</label>
                    <div class="control">
                        <input class="input" type="url" name="githubLink" placeholder="https://github.com/example/project">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-success">Save Project</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>

@endif


@endsection

@section('scripts')
<script src="/js/projects-filter.js"></script>
@if(Auth::guard('admin')->check())
<script src="/js/projects-modals.js"></script>
@endsection
@endif