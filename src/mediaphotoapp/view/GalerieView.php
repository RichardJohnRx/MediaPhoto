<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\GalerieController as GalerieController;
use \mediaphotoapp\model\Galerie as Galerie;
use \mf\router\Router as Router;
use \mediaphotoapp\model\Photo as Photo;

class GalerieView extends AbstractView {

      /* Constructeur 
     * 
     * Paramètres :  
     *
     * - $data (mixed) : selon la vue, une instance d'un modèle ou un tableau 
     *                   d'instances d'un modèle
     *  Algorithme 
     *  
     * - Stocker les données passées en paramètre dans l'attribut $data.
     *   
     *
     */

    public function __construct( $data ){
        parent::__construct($data);
    }
    
    /* Méthode addStyleSheet
     * 
     * Permet d'ajouter une feuille de style à la liste:
     * 
     * Paramètres : 
     *
     * - $path_to_css_files (String) : le chemin vers le fichier 
     *                                 (relatif au script principal)
     *
     *
     */

    static public function addStyleSheet($path_to_css_files){
        parent::addStyleSheet($path_to_css_files);
    }
    private function renderHeader(){
        $router = new Router();
        $html = "
            <div class='recherche' method='GET' action='searchbar.php'>
                <form>
                    <input id='search' type='search' name='searchbar' placeholder='Recherche...' ></input>
                </form>
            </div>
            
            <div class='logo'>
                <a href= '" . $router->urlFor('Home',"") ."  ' > <img src='https://i.ibb.co/Q9zB0mr/logo.png' alt='logo-app' /> <a/>
            </div>

            <div class='icon'>
                <img src='https://i.ibb.co/PjtNj2R/icon-login.png' alt='icon-login'/>
                <a href='login.html'>Login</a>
                <a href='inscription.html'>Register</a> 
            </div>";
        return $html;
    } 
    private function renderFooter(){
        $html = "
            <div class='socialNetworks'>
                <a href='https://github.com/RichardJohnRx/MediaPhoto'><img src='https://i.ibb.co/HtS8z2k/icon-github.png' alt='Logo de Github' width='30px'/></a>
                <a href='https://www.univ-lorraine.fr/'><img src='https://i.ibb.co/1Z6YJJ4/icon-lorraine.png' alt='Logo Université de Lorraine' width='95px'/></a>
            </div>
            
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne</p>";
        return $html;
    }

    //View des galeries public 
    public function renderHomeGuest(){
        $html="";
        $router = new \mf\router\Router();
        
        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','=',0)
            ->get();

        foreach ($photo as $key) {
            
            $titre = "<h1>ACCUEIL</h1>";
            
            $html .="<section class='galerie'>
            
            <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . $key->metaDonnees . "></a>
                
            <div class='infosGalerieHover'>
                <h3>Style japonais</h3>
                <p>Par Antonin Winterstein</p>
            </div>
            </section>";
        }
        return $titre . $html;
    }



    //view d'une galerie spécifique
    public function viewUneGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listUneGalerie($_GET['idGalerie']);
        self::render($result);
    }

    //les galeries d'un user spécifique
    public function viewGaleriesUser(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listGaleriesUser($_GET['idUser']);
        self::render($result);
    }

    //Rechercher les galeries avec des mots clés
    public function viewGaleriesMotsCles(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listGaleriesMotsCles($_GET['motsCles']);
        self::render($result);
    }

    private function renderPhoto() {
        $html = '';
        $photo = $this->data;
        $router = new Router();
        
        
        foreach ($_GET as $valeur) {
            $requete = \mediaphotoapp\model\Photo::select()
					->where("idPhoto","=",$valeur)
                    ->first();
                    
                    $user = $requete->user()->first();

            $html = "<div class='grid heading'>
            <h1>
                " . $requete->nom . " <br />
                <span>Créateur : " . $user->prenom . ' ' . $user->nom . "</span>
            </h1>
        </div>

        <p class='dateCreation'>
            Photo ajoutée à la galerie le ... par " . $user->prenom . ' ' . $user->nom . "
        </p>

        <div class='grid photosGallery'>
            <div class='thePhoto' id='myPhoto'>
                <img src=" . $requete->metaDonnees . ">
            </div>
        </div>

        <div class='keywordsPhoto'>
            <span> " . $requete->motsCles . "</span>
        </div>";
        }
		return $html;
    }

    private function renderGalerie() {
        $html = '';
        $galerie = $this->data;
        $router = new Router();

        foreach ($_GET as $valeur) {
        $requete = Galerie::select()
					->where("idGalerie","=",$valeur)
					->first();
                    
            $html = "<h1>$requete->nom</h1>";
        }
		return $html;
    }

    private function renderModGalerie(){
        $router = new Router();
        $photos = Photo::all();
        $galerie = Photo::select()
            ->join('depot','depot.idPhoto','=','photo.idPhoto')
            ->where('depot.idGalerie','=',$this->data->idGalerie)
            ->get();
        $html = "

            
			<h1>MODIFIER GALERIE</h1>
			<hr />
        <form class='grid' method='post' action='mod'>

                <input
                type='text'
                name='idGalerie'
                value='" . $this->data->idGalerie . "'
                hidden
                />
				<div class='nameGallery'>
					<label for='nom'>Nom : <span>*</span></label>
					<br />
					<input
						type='text'
						name='nom'
                        placeholder='Entrez le nom de la photo'
                        value='" . $this->data->nom . "'
					/>
				</div>
				<div class='keywordsGallery'>
					<label for='motsCles'>Mots-clés : <span>*</span></label>
					<br />
					<input
						type='text'
						name='motsCles'
                        placeholder='Entrez un ou plusieurs mots-clés'
                        value='".$this->data->motsCles."'
					/>
        </div>
        <div class='descriptionGallery'>
          <label for='description'>Description :</label>
          <br />
          <textarea name='description' placeholder='Entrer une définition pour la galerie'>".$this->data->description."</textarea>
        </div>
				<div class='accessMode'>
					<label for='type'>Mode d'accès : <span>*</span></label>
					<br />
					<select name='type' value='".$this->data->type."'>
						<option value='0'>Public</option>
						<option value='1'>Privé</option>
						<option value='2'>Partagé</option>
					</select>
        </div>
        
        <div class='choosePhotos'>
          <label for='choosePhotos'>Choisir les photos : <span>*</span></label>
          <br />
          <!-- Le bouton pour la modal -->
          <button type='button' id='myBtn'>Choisir des photos</button>
          
          ";
        foreach ($galerie as $image){
            $html .= "<img id='photo' src='".$image->metaDonnees."' alt='" . $image->nom . "' />";
        }

        $html .= "
            <p>Vos photos s'afficheront ici</p>
          <!-- La modal -->
          <div id='myModal' class='modal'>
            <!-- Le contenu de la modal -->
            <div class='modal-content grid'>
              <!-- Le header -->
              <div class='modal-header'>
                <span class='close'>&times;</span>
                <input class='search' type='search' placeholder='Chercher une photo...'>
              </div>
              <!-- Le body -->
              <div class='modal-body grid'>
                <h1>Sélectionnez les photos que vous voulez ajouter à votre galerie</h1>";
        if(isset($photos)){
            foreach($photos as $photo){
                $html .= "<img src='" . $photo->metaDonnees . "' alt='" . $photo->nom . "'>";
            }
        }

        $html .= "
            </div>
              <a class='arrowGoTop' id='buttonGoTop'><img src='../images/icon_arrow.svg' alt='Flèche pour remonter' width='50px'></a>
            </div>
            
          </div>
          
				</div>
                <input class='sendForm' type='submit' value='Modifier la galerie' src='" . $router->urlfor('/ModGalerie',["idGalerie" => $this->data->idGalerie]) ."'></form>
    ";

        $html .= '
        <script>
        // On récupère la modal
        var modal = document.getElementById("myModal");
        
        // On récupère le bouton qui permet ouvrir la modal
        var btn = document.getElementById("myBtn");
        
        // On récupère le span qui permet de fermer la modal (la croix)
        var span = document.getElementsByClassName("close")[0];
        
        // Lorsqu on clique sur le bouton, la modal passe en display block et s affiche en conséquence (car de base en display none)
        btn.onclick = function () {
            modal.style.display = "block";
        };
        
        // Lorsque l utilisateur clique sur la croix, on ferme la modal en la passant en display none
        span.onclick = function () {
            modal.style.display = "none";
        };
        
        // Lorsque l utilisateur n importe où en dehors de la modal, on ferme la modal en la passant en display none
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
        
        </script>
        <!-- Importation de jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!-- Importation de popper -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
		<!-- Importation du script des select -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        ';
        return $html;
    }

    //Ajouter une galerie, après afficher toutes les galeries de cet user
    public function viewAjouterGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtr->ajouterGalerie($_POST['nom'],$_POST['type'],
                                            $_POST['motsCles'] , $_POST['description'],
                                            $_POST['dateCreation'], $_POST['idUser']);
        $photos = $galCtr->ajouterPhotoDansGalerie($_POST['idGalerie']);
        $this->viewGaleriesUser();
    }

    protected function renderBody($selector){
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        $section = $this->renderHomeGuest();

        switch ($selector) {
            case "home":
                $main = $this->renderHomeGuest();
                break;
            case "photo":
                $main = $this->renderPhoto();
                break;
            case "galerie":
                $main = $this->renderGalerie();
                break;
            case "modGalerie":
                $main = $this->renderModGalerie();
                break;
        }
        
        $html = "
        <body>
            <header class='grid'>$header</header>
            <main class='grid home myGallery createGallery'>
                $main
            </main>
            <footer class='grid'>$footer</footer>
        </body>";

        return $html;
    } 
    
}
