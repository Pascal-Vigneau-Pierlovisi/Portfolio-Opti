<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectPicture;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\File; // Assurez-vous d'importer la classe File en haut de votre contrôleur

class ProjectController extends Controller
{
    // Afficher la liste de tous les projets
    public function index()
    {
        $projects = Project::with('category')->get();
        $categories = Category::all();
        return view('projects.projects', compact('projects', 'categories'));
    }

    // Afficher le formulaire de création d'un nouveau projet
    public function create()
    {
        $categories = Category::all(); // Récupère toutes les catégories pour le formulaire
        return view('projects.projects', compact('categories'));
    }

    // Stocker un projet nouvellement créé dans la base de données
    public function store(Request $request)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'title' => 'required',
            'summary' => 'required|min:50',
            'idCat' => 'required|exists:project_categorie,id',
            'mainDescription' => 'required',
            'secondDescription' => 'nullable',
            'githubLink' => 'nullable|url',
            'mainPicture' => 'required|image', // Assure-toi que c'est bien une image et qu'elle ne dépasse pas la taille que tu définis
        ]);

        $project = new Project([
            'title' => $validatedData['title'],
            'summary' => $validatedData['summary'],
            'idCat' => $validatedData['idCat'],
            'mainDescription' => $validatedData['mainDescription'],
            'secondDescription' => $validatedData['secondDescription'],
            'githubLink' => $validatedData['githubLink'],
            // Ne pas inclure 'mainPicture' ici
        ]);

        $project->save(); // Sauvegarder pour obtenir l'ID

        // Télécharger l'image et obtenir le chemin avec l'ID du projet
        if ($request->hasFile('mainPicture')) {
            $image = $request->file('mainPicture');
            $imageName = 'mainPicture.' . $image->getClientOriginalExtension();
            $folderPath = '/img/projects/project-' . $project->id . '/mainPicture/';
            $imagePath = $folderPath . $imageName;

            // Vérifier si le dossier existe, sinon le créer
            if (!file_exists(public_path($folderPath))) {
                mkdir(public_path($folderPath), 0777, true);
            }

            // Déplacer l'image dans le dossier public
            $image->move(public_path($folderPath), $imageName);

            // Mettre à jour le chemin de l'image dans la base de données
            $project->mainPicture = $imagePath;
            $project->save();
        }


        // Traitement des images supplémentaires
        if ($request->hasFile('projectImages')) {
            foreach ($request->file('projectImages') as $image) {
                $directory = 'img/projects/project-' . $project->id . '/add-picture';

                // Vérifier si le dossier existe, sinon le créer
                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0777, true);
                }

                // Définir le nom de l'image
                $imageName = time() . '-' . $image->getClientOriginalName();

                // Déplacer l'image dans le dossier public
                $image->move(public_path($directory), $imageName);

                // Chemin d'accès pour enregistrer dans la base de données
                $path = $directory . '/' . $imageName;

                // Création de l'entrée dans la table project_picture
                ProjectPicture::create([
                    'picture' => $path,
                    'idProject' => $project->id,
                ]);
            }
        }


        return redirect()->route('projects.index');
    }

    // Afficher un projet spécifique
    public function show(Project $project)
    {
        // Charger les relations nécessaires, par exemple les images supplémentaires
        $project->load('projectPictures');

        // Envoyer les données à la vue
        return view('projects.show', compact('project'));
    }

    // Supprimer un projet spécifique de la base de données
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        ProjectPicture::where('idProject', $project->id)->delete();

        // Chemin relatif au dossier public
        $directory = public_path('img/projects/project-' . $project->id);

        // Supprimer le dossier et son contenu
        if (File::isDirectory($directory)) {
            File::deleteDirectory($directory);
        }

        // Supprimer le projet de la base de données
        $project->delete();

        return redirect()->route('projects.index');
    }


    // Update le titre d'un projet
    public function editTitle(Project $project)
    {
        // Validez la requête (vous pouvez ajouter des règles de validation personnalisées ici si nécessaire)
        $validatedData = request()->validate([
            'title' => 'required|string|max:25', // Exemple de règle de validation pour le titre
        ]);

        // Mettez à jour le titre du projet
        $project->update([
            'title' => $validatedData['title'],
        ]);

        // Redirigez l'utilisateur ou effectuez une autre action après la mise à jour
        return redirect()->route('projects.show', ['project' => $project->id]);
    }

    // Update l'image principale d'un projet
    public function editMainPicture(Project $project)
    {
        // Validez la requête (vous pouvez ajouter des règles de validation personnalisées ici si nécessaire)
        $validatedData = request()->validate([
            'mainPicture' => 'required|image|mimes:jpeg,png,jpg,gif', // Exemple de règles de validation pour l'image
        ]);

        // Récupérez le fichier de la nouvelle image
        $newImage = request()->file('mainPicture');

        // Supprimez l'ancienne image si elle existe
        $oldImagePath = public_path($project->mainPicture);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Enregistrez la nouvelle image dans le dossier "mainPicture" en la renommant
        $imageName = 'mainPicture.' . $newImage->getClientOriginalExtension();
        $newImagePath = 'img/projects/project-' . $project->id . '/mainPicture/' . $imageName;
        $newImage->move(public_path('img/projects/project-' . $project->id . '/mainPicture/'), $imageName);

        // Mettez à jour le champ de la base de données avec le nouveau chemin et nom de l'image principale
        $project->update([
            'mainPicture' => $newImagePath,
        ]);

        // Redirigez l'utilisateur ou effectuez une autre action après la mise à jour
        return redirect()->route('projects.show', ['project' => $project->id]);
    }

    // Update la description principale d'un projet
    public function editMainDescription(Project $project)
    {
        // Validez la requête (vous pouvez ajouter des règles de validation personnalisées ici si nécessaire)
        $validatedData = request()->validate([
            'mainDescription' => 'required|string', // Exemple de règle de validation pour le titre
        ]);

        // Mettez à jour le titre du projet
        $project->update([
            'mainDescription' => $validatedData['mainDescription'],
        ]);

        // Redirigez l'utilisateur ou effectuez une autre action après la mise à jour
        return redirect()->route('projects.show', ['project' => $project->id]);
    }

    // Update la description secondaire d'un projet
    public function editSecondDescription(Project $project)
    {
        // Validez la requête (vous pouvez ajouter des règles de validation personnalisées ici si nécessaire)
        $validatedData = request()->validate([
            'secondDescription' => 'required|string', // Exemple de règle de validation pour le titre
        ]);

        // Mettez à jour le titre du projet
        $project->update([
            'secondDescription' => $validatedData['secondDescription'],
        ]);

        // Redirigez l'utilisateur ou effectuez une autre action après la mise à jour
        return redirect()->route('projects.show', ['project' => $project->id]);
    }

    public function editPicture(Request $request)
    {
        // Validez la requête (vous pouvez ajouter des règles de validation personnalisées ici si nécessaire)
        $validatedData = $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif', // Exemple de règles de validation pour l'image
            'id' => 'required|exists:project_picture,id',
        ]);

        $picture = ProjectPicture::findOrFail($request->id);

        // Récupérez le fichier de la nouvelle image
        $newImage = $request->file('picture');

        // Supprimez l'ancienne image si elle existe
        $oldImagePath = public_path($picture->picture);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Enregistrez la nouvelle image dans le dossier "mainPicture" en la renommant
        $imageName = time() . '-' . $newImage->getClientOriginalName();
        $newImagePath = 'img/projects/project-' . $picture->idProject . '/add-picture/' . $imageName;
        $picture->update([
            'picture' => $newImagePath,
        ]);
        $newImage->move(public_path('img/projects/project-' . $picture->idProject . '/add-picture/'), $imageName);

        return redirect()->route('projects.show', ['project' => $picture->idProject]);
    }

    public function destroyPicture(ProjectPicture $picture)
    {
        try {
            $picture = ProjectPicture::findOrFail($picture->id);

            // Chemin complet au fichier image
            $filePath = public_path($picture->picture);

            // Vérifiez si le fichier existe avant de tenter de le supprimer

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $picture->delete();

            return redirect()->route('projects.show', ['project' => $picture->idProject]);
        } catch (\Exception $e) {
            // Gérer les erreurs ici
            return back();
        }
    }
    public function addPicture(Project $project)
    {
        $validatedData = request()->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif', // Exemple de règles de validation pour l'image
        ]);

        // Récupérez le fichier de la nouvelle image
        $newImage = request()->file('picture');

        // Vérifiez si le dossier "add-picture" existe, sinon créez-le
        $addPicturePath = public_path('img/projects/project-' . $project->id . '/add-picture/');
        if (!File::exists($addPicturePath)) {
            File::makeDirectory($addPicturePath, 0755, true);
        }

        // Enregistrez la nouvelle image dans le dossier "add-picture" en la renommant
        $imageName = time() . '-' . $newImage->getClientOriginalName();
        $newImagePath = 'img/projects/project-' . $project->id . '/add-picture/' . $imageName;
        $newImage->move($addPicturePath, $imageName);

        // Création de l'entrée dans la table project_picture
        ProjectPicture::create([
            'picture' => $newImagePath,
            'idProject' => $project->id,
        ]);

        return redirect()->route('projects.show', ['project' => $project->id]);
    }
}
