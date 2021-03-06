<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\GalerieController as GalerieController;
use \mediaphotoapp\model\Galerie as Galerie;
use \mf\router\Router as Router;
use \mediaphotoapp\model\Photo as Photo;
use Illuminate\Support\Facades\Storage as Storage;

\mf\view\AbstractView::addStyleSheet('src/css/home_login.css');

class GalerieView extends AbstractView {


    public function __construct( $data ){
        parent::__construct($data);
    }
    

    static public function addStyleSheet($path_to_css_files){
        parent::addStyleSheet($path_to_css_files);
    }



    private function renderAPropos(){

    	$html = "
<style> 
html {
	width :100%;
}
body > main.grid {
	display : block;
}
main a {
	color : blue;
	text-align : left;
}
</style>
<html>
<h3>Lien vers le Dépôt GITHUB : <a href='https://github.com/RichardJohnRx/MediaPhoto'>https://github.com/RichardJohnRx/MediaPhoto</a> <h3> 

<h1>Les Documents de Conception : </h1>

<h2> 1 - LES DIAGRAMMES </h2> 

<h3>Diagramme Use Case</h3> 

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/1%20Use%20Cases.png'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/1%20Use%20Cases.png</a>

<h3>Diagramme User Stories Mapping</h3>

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/2%20User%20Stories%20Mapping.jpg'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/2%20User%20Stories%20Mapping.jpg</a>

<h3>Diagramme d'Activités du Login</h3>

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/4%20Diagramme%20d%27activit%c3%a9s%20_%20Connexion%20-%20D%c3%a9connexion%20-%20Inscription.png'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/4%20Diagramme%20d%27activit%c3%a9s%20_%20Connexion%20-%20D%c3%a9connexion%20-%20Inscription.png</a>

<h3>Diagramme d'Activités Ajouter Photos / Créer Galeries</h3>

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/5%20Diagramme%20d%27activit%c3%a9s%20_%20Ajouter%20Photo%20-%20Cr%c3%a9er%20Galerie.pdf'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/5%20Diagramme%20d%27activit%c3%a9s%20_%20Ajouter%20Photo%20-%20Cr%c3%a9er%20Galerie.pdf</a>

<h3>Diagramme de Classes</h3>

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/3%20Diagramme_de_classes.png'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Diagrammes/3%20Diagramme_de_classes.png</a>

<h2> 2 - LA MAQUETTE </h2> 

<h3>Les Scénarios D'Usages + Le WireFrame</h3> 

<a href='https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Maquettes/Scenario_usages.pdf'>https://webetu.iutnc.univ-lorraine.fr/www/winters24u/mediaphotoapp/rendu/Conception/Maquettes/Scenario_usages.pdf</a>
</html>
";


return $html;
    }


    private function renderHeaderGuest(){
        $router = new Router();
        $html = "
            <div class='recherche'>
                <form method='GET' action='searchbar.php'>
                    <input id='search' type='search' name='searchbar' placeholder='Recherche...' >
                </form>
            </div>

            <div class='logo'>
                <img src='https://i.ibb.co/Q9zB0mr/logo.png' alt='logo application MediaPhoto'>
            </div>

            <div class='icon'>
                <img src='https://i.ibb.co/PjtNj2R/icon-login.png' alt='icon-login'/>
                <a href='" . $router->urlFor('login') . "'>Login</a>
                <a href='" . $router->urlFor('signupform') ." '>Register</a>
            </div>";

        return $html;
    } 

    private function renderHeader(){
        $router = new Router();
        $html = "
            <div class='recherche'>
                <form method='GET' action='searchbar.php'>
                    <input id='search' type='search' name='searchbar' placeholder='Recherche...' >
                </form>
            </div>

            <div class='logo'>
                <img src='https://i.ibb.co/Q9zB0mr/logo.png' alt='logo application MediaPhoto'>
            </div>

            <div class='icon'>
                <img src='https://i.ibb.co/PjtNj2R/icon-login.png' alt='icon-login'/>
                <a href='" . $router->urlFor('login') . "'>Déconnexion</a>
            </div>";

        return $html;
    }

    private function renderFooter(){
    	$router = new Router();
        $html = "
        <div class='socialNetworks'>
                <a href='https://github.com/RichardJohnRx/MediaPhoto'><img src='https://i.ibb.co/HtS8z2k/icon-github.png' alt='Logo de Github'/></a>
                <a href='https://www.univ-lorraine.fr/'><img src='https://i.ibb.co/1Z6YJJ4/icon-lorraine.png' alt='Logo Université de Lorraine'/></a>
            </div>

            <a href=\"" . $router->urlFor('aPropos') ."\">À PROPOS</a>
            
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne.</p>";
        return $html;
    }


    //View des galeries public non connecter
    public function renderHomeGuest(){
        $html="";
        $router = new \mf\router\Router();

        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','=',0)
            ->get();

        foreach ($photo as $key) {
            
            $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
            $user = $photos->user()->first();

            $titre = "<h1>ACCUEIL</h1>";
            $soustitre = "<h2>VEUILLEZ TROUVER ICI DE MULTIPLES GALERIES</h2>";
            
            $html .=
            "<section class='galerie'>
            <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . $photos->metaDonnees . ">
            <div class='infosGalerieHover'>
            <h3>$photos->nom</h3>
            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
            </div></a>
            </section>";

           
        }
        return $titre . $soustitre .  $html;
    }

    public function renderHomeLogin(){
        $html="";
        $router = new \mf\router\Router();

        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','!=',1)          // Public & Partagé
            ->get();

        foreach ($photo as $key) {
            
            $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
            $user = $photos->user()->first();
            
            $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>

            </div>";

            $titre = "<h1>BIENVENUE</h1>";

            $html .=
                "<section class='galerie'>
                    <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . 
                    $photos->metaDonnees . ">
                        <div class='infosGalerieHover'>
                            <h3>$photos->nom</h3>
                            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
                        </div>
                    </a>
                </section>";
        }
        return $menu . $titre . $html;
    }

    public function renderMesPhotoPrive(){
        $html="";
        $router = new \mf\router\Router();

        $photo = Photo::select()
            ->get();

        foreach ($photo as $key) {
            
            $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
            $user = $photos->user()->first();

            $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
            </div>";

            $titre = "<h1>MES PHOTOS PRIVÉES</h1>";

            $html .=
                "<section class='galerie'>
                    <a href=\"" . $router->urlFor('photo', [['id', $key->idPhoto]]) . "\"><img src=" . 
                    $photos->metaDonnees . ">
                        <div class='infosGalerieHover'>
                            <h3>$photos->nom</h3>
                            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
                        </div>
                    </a>
                </section>";
        }
        return $menu . $titre . $html;
    }



    public function renderTouteGalerie(){
        $html="";
        $router = new \mf\router\Router();
        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->get();

            foreach ($photo as $key) {  
                $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
                $user = $photos->user()->first();

                $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    
                        <li class='deroulant'><a href='#'>Galeries</a>
                            <ul class='enfant grid'>
                                <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                                <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                                <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                            </ul>
                        </li>
                        
                    
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
                </div>";

                $titre = "<h1>TOUTES LES GALERIES</h1>";

                $html .=
                "<section class='galerie'>
                    <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . 
                    $photos->metaDonnees . ">
                        <div class='infosGalerieHover'>
                            <h3>$photos->nom</h3>
                            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
                        </div>
                    </a>
                </section>";
        }
        return $menu . $titre .$html;
    }



    public function renderGaleriePartage(){
        $html="";
        $router = new \mf\router\Router();
        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','=',2)          // Partagé
            ->get();

            foreach ($photo as $key) {  
                $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
                $user = $photos->user()->first();

                $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
                </div>";

                $titre = "<h1>LES GALERIES PARTAGÉES</h1>";

                $html .=
                "<section class='galerie'>
                    <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . 
                    $photos->metaDonnees . ">
                        <div class='infosGalerieHover'>
                            <h3>$photos->nom</h3>
                            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
                        </div>
                    </a>
                </section>";
        }
        return $menu . $titre .$html;
    }


    public function renderGaleriePrive(){
        $html="";
        $router = new \mf\router\Router();
        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','=',1)          // Privé
            ->get();

            foreach ($photo as $key) {  
                $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
                $user = $photos->user()->first();

                $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
                </div>";

                $titre = "<h1>MES GALERIES PRIVÉES</h1>";

                $html .=
                "<section class='galerie'>
                    <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . 
                    $photos->metaDonnees . ">
                        <div class='infosGalerieHover'>
                            <h3>$photos->nom</h3>
                            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
                        </div>
                    </a>
                </section>";
        }
        return $menu . $titre .$html;
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
        
        $user = $requete->user()->first();
        
        $liste_photos = $requete->photos()->get();

        $photos = '';


        foreach ($liste_photos as $v) {

            switch($requete->type) {
                case "0":
                    $type = 'publique';
                break;
                case "1":
                    $type = 'privée';
                break;
                case "2":
                    $type = 'protégée';
                break;
            }

            $photos .= "<div class='thePhoto'><a href=\"" . $router->urlFor('photo', [['id', $v->idPhoto]]) . "\"><img src=" . $v->metaDonnees . "><div class='infosGalerieHover'>
            <h3>$v->nom</h3>
            </div></a></div>";

            

            $html = "<div class='grid heading'>
            <h1>
                " . $requete->nom . " <br />
                <span>Galerie " . $type . " (par " . $user->prenom . ' ' .  $user->nom . ")</span>
            </h1>
        </div>
    
        <p class='lengthPhotos'></p>
    
        <p class='dateCreation'>
            Galerie créée le " . $requete->dateCreation . " par  " . $user->prenom . ' ' .  $user->nom . "
        </p>
    
        <div class='grid photosGallery'>
            " . $photos . "
            
        </div>
    
        <div class='keywordsPhoto'>
            <span>" . $requete->motsCles . "</span>
        </div>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>

        <script>
            $( document ).ready(function() {
                var lengthPhoto = $('.thePhoto').length;
                $('.lengthPhotos').html('Nombre de photos : ' + lengthPhoto + ' photos');

                
            });
      </script>";
        }
        }
        return $html;
    }

    private function renderCreerGalerie() {
        $router = new Router();
        $photos = Photo::all();
        $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
                </div>";

        $titre = "<h1>CRÉER GALERIE</h1>";

        $html = "<form class='grid' method='post' action='add'>

				<div class='nameGallery'>
					<label for='nom'>Nom : <span>*</span></label>
					<br />
                    <input
                    id='nom'
						type='text'
						name='nom'
                        placeholder='Entrez le nom de la photo'
					/>
				</div>
				<div class='keywordsGallery'>
					<label for='motsCles'>Mots-clés : <span>*</span></label>
					<br />
                    <input
                    id='motsCles'
						type='text'
						name='motsCles'
                        placeholder='Entrez un ou plusieurs mots-clés'
					/>
        </div>
        <div class='descriptionGallery'>
          <label for='description'>Description :</label>
          <br />
          <textarea id='description' name='description' placeholder='Entrer une définition pour la galerie'></textarea>
        </div>
        <div class='accessMode'>
            <label for='type'>Mode d'accès : <span>*</span></label>
            <br />
            <select id='type' name='type'>
                <option selected value='0'>Public</option>
                <option value='1'>Privé</option>
                <option value='2'>Partagé</option>
            </select>
        </div>
        
        <div class='choosePhotos'>
          <label>Choisir les photos : <span>*</span></label>
          <br />
          <!-- Le bouton pour la modal -->
          <button type='button' id='myBtn'>Choisir des photos</button>
          
          <img id='photo' src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' alt='Image importée' >
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
              <a class='arrowGoTop' id='buttonGoTop'><img src='https://i.ibb.co/cc92XPX/icon-arrow.png' alt='Flèche pour remonter'></a>
            </div>
            
          </div>
          
				</div>
                <input class='sendForm' type='submit' value='Créer la galerie'></form>
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
        return $menu . $titre . $html ;
    }

    private function renderModGalerie(){
        $router = new Router();
        $photos = Photo::all();
        $galerie = Photo::select()
            ->join('depot','depot.idPhoto','=','photo.idPhoto')
            ->where('depot.idGalerie','=',$this->data->idGalerie)
            ->get();


            $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
            </div>";

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
                    id='nom'
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
                    id='motsCles'
                        type='text'
                        name='motsCles'
                        placeholder='Entrez un ou plusieurs mots-clés'
                        value='".$this->data->motsCles."'
                    />
        </div>
        <div class='descriptionGallery'>
          <label for='description'>Description :</label>
          <br />
          <textarea id='description' name='description' placeholder='Entrer une définition pour la galerie'>".$this->data->description."</textarea>
        </div>
                
        <div class='accessMode'>
            <label for='type'>Mode d'accès : <span>*</span></label>
            <br />
            <select id='type' name='type' value='".$this->data->type."'>
                <option value='0'>Public</option>
                <option value='1'>Privé</option>
                <option value='2'>Partagé</option>
            </select>
        </div>
        
        <div class='choosePhotos'>
          <label>Choisir les photos : <span>*</span></label>
          <br />
          <!-- Le bouton pour la modal -->
          <button type='button' id='myBtn'>Choisir des photos</button>
          
          ";
        foreach ($galerie as $image){
            $html .= "<img id='photo' src='".$image->metaDonnees."' alt='" . $image->nom . "' style='max-height: unset;'/>";
        }

        $html .= "
            
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
              <a class='arrowGoTop' id='buttonGoTop'><img src='https://i.ibb.co/cc92XPX/icon-arrow.png' alt='Flèche pour remonter'></a>
            </div>
            
          </div>

                </div>
                <input class='sendForm' type='submit' value='Modifier la galerie' src='" . $router->urlfor('/ModGalerie',["idGalerie" => $this->data->idGalerie]) ."'></form>

				</div>
                </form>";

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
        return $menu . $html;
    }


    /*//view d'une galerie spécifique non connecter
    public function viewUneGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listUneGalerie($_GET['idGalerie']);
        self::render($result);
    }

    //les galeries d'un user spécifique non connecter
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
    }*/

    /*//Ajouter une galerie, après afficher toutes les galeries de cet user
    public function viewAjouterGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtr->ajouterGalerie($_POST['nom'],$_POST['type'],
                                            $_POST['motsCles'] , $_POST['description'],
                                            $_POST['dateCreation'], $_POST['idUser']);
        $photos = $galCtr->ajouterPhotoDansGalerie($_POST['idGalerie']);
        $this->viewGaleriesUser();
    }*/


    public function renderAjoutPhoto(){
        $router = new \mf\router\Router();

        $menu = "<div class='menu'>
                <ul class='grid'>
                    <li><a href=\"" . $router->urlFor('homelogin') . "\">Accueil</a></li>
                    <li><a href=\"" . $router->urlFor('mesPhotos') . "\">Mes Photos</a></li>
                    <li><a href=\"" . $router->urlFor('addPhoto') . "\">Ajouter Photos</a></li>
                    <div class='deroulant'>
                        <li><a href='#'>Galeries</a></li>
                        <ul class='enfant grid'>
                            <li><a href=\"" . $router->urlFor('touteGalerie') . "\">Toutes Les Galeries</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePartage') . "\">Galeries Partagées</a></li>
                            <li><a href=\"" . $router->urlFor('galeriePrive') . "\">Galeries Privées</a></li>
                        </ul>
                    </div>
                    <li><a href='". $router->urlFor('creerGalerie')."'>Créer Galerie</a></li>
                    <li><a href='#'>Profil</a></li>
                </ul>
            </div>";

        $title = "<h1>AJOUTER PHOTO</h1>";
        $html =
        "<form  class='grid' method='post' action='add' enctype='multipart/form-data'>

            <div class='namePhoto'>
                <label for='namePhoto'>Nom : <span>*</span>
                </label> <br />
                <input id='namePhoto' type='text' name='nom' placeholder='Entrez le nom de la photo'/>
            </div>

            <div class='namePhoto'>
                <label for='motsCles'>Mots-clés : <span>*</span>
                </label> <br />
                <input id='motsCles' type='text' name='motsCles' placeholder='Entrez un ou plusieurs mots-clés'/>
            </div>

            <div class='choosePhotos'>
                <label>Choisir une photo : <span>*</span>
                </label> <br />
            
                <input type='hidden' name='MAX_FILE_SIZE' value='250000' />
                <input type='file' name='imageChoisi' size=50 onchange='readURL(this);'/>
              
                <img id='photo' src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' alt='Image importée' >

                 <p>La photo s'affichera ici</p>
            </div>
          
            <input class='sendForm' type='submit' value='Ajouter la photo'>
        </form>
        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('#photo').attr('src', e.target.result);
                    $('#photo').css('border', 'none');
                    $('.choosePhotos p').css('display', 'none');
                    $('.choosePhotos img').css('width', 'unset');
                };
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        </script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>";

        return $menu . $title  . $html;
    }


    private function renderModPhoto(){
        $router = new Router();
        $photos = Photo::all();
        $galerie = Photo::select()
            ->join('depot','depot.idPhoto','=','photo.idPhoto')
            ->where('depot.idGalerie','=',$this->data->idGalerie)
            ->get();
        $html = "

            
            <h1>MODIFIER PHOTO</h1>
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

                </div>
                <input class='sendForm' type='submit' value='Modifier la galerie'></form>";

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

    protected function renderBody($selector){
        
        $footer = $this->renderFooter();
        $header = $this->renderHeader();

        switch ($selector) {

            case "home":
                $header = $this->renderHeaderGuest();
                $main = $this->renderHomeGuest();
                break;
            case "homelogin":
                $header = $this->renderHeader();
                $main = $this->renderHomeLogin();
                break;
            case "mesPhotos":
                $main = $this->renderMesPhotoPrive();
                break;
            case "photo":
                $header = $this->renderHeader();
                $main = $this->renderPhoto();
                break;
            case "galerie":
                $header = $this->renderHeader();
                $main = $this->renderGalerie();
                break;
            case "touteGalerie":
                $main = $this->renderTouteGalerie();
                break;
            case "galeriePartage":
                $main = $this->renderGaleriePartage();
                break;
            case "galeriePrive":
                $main = $this->renderGaleriePrive();
                break;
            case "creerGalerie":
                $main = $this->renderCreerGalerie();
                break;
            case "modGalerie":
                $header = $this->renderHeader();
                $main = $this->renderModGalerie();
                break;
            case "mesphoto": 
                $header = $this->renderHeader();
                $main = $this->renderMesPhoto();
                break;
            case "addPhoto":
                $main = $this->renderAjoutPhoto();
                break;
            case "modPhoto":
                $main = $this->renderModPhoto();
                 break;
            case "aPropos":
                $main = $this->renderAPropos();
                break;
        }

        
        $html = "<body>
            <header class='grid'>$header</header>
            <main class='grid home myGallery createGallery'>$main</main>
            <footer class='grid'>$footer</footer>
        </body>";

        return $html;
    } 
    
}
