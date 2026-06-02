<?php
// Insert articles avec meilleure gestion UTF-8
require_once 'config/db.php';

$db = getDB();

// Article 1
$art1 = [
  'titre' => 'Comment j\'ai appris Laravel en autonomie pendant mon stage',
  'slug' => 'apprendre-laravel-autonomie-stage',
  'extrait' => 'Retour d\'expérience sur l\'apprentissage de Laravel sans formation préalable, directement en contexte pr
  ofessionnel chez SolDigit.',
  'categorie' => 'Retour d\'expérience',
  'tags' => 'Laravel,PHP,Stage,Apprentissage',
  'contenu' => '<h2>Introduction</h2>
<p>Quand j\'ai débute mon stage chez SolDigit en 2025, Laravel n\'était pas encore dans ma boîte à outils. Pourtant, l\'équipe travaillait exclusivement avec ce framework depuis plusieurs années. J\'ai dû apprendre vite pour être productive dès les premières semaines.</p>
<p>Voici comment j\'ai procédé pour maîtriser Laravel sans formation préalable, directement en contexte professionnel.</p>

<h2>1. Comprendre l\'architecture MVC</h2>
<p>La première chose à saisir avec Laravel est son architecture : <strong>Model-View-Controller</strong>. Ce pattern isole la logique métier (Model), la présentation (View), et la coordination (Controller).</p>
<p>J\'ai passé une journée à lire la documentation Laravel sur ce sujet, puis j\'ai épluché le code existant de l\'équipe pour voir comment les trois couches interagissaient.</p>
<ul>
<li><strong>Models</strong> : Ils représentent les tables de la base de données</li>
<li><strong>Controllers</strong> : Ils réceptionnent les requêtes et orchestrent le rendu</li>
<li><strong>Views</strong> : Fichiers Blade qui génèrent le HTML</li>
</ul>
<p>Comprendre cette séparation m\'a permis de naviguer rapidement dans les projets existants.</p>

<h2>2. Maîtriser Eloquent (l\'ORM de Laravel)</h2>
<p>Eloquent est l\'ORM Laravel qui simplifie les requêtes à la base de données. Au lieu d\'écrire du SQL brut, on utilise une syntaxe élégante en PHP :</p>
<pre><code>// Plutôt que SELECT * FROM users WHERE id = 1
$user = User::find(1);

// Relation inverse et requêtes complexes
$posts = $user->posts()->where(\'published\', 1)->get();</code></pre>
<p>J\'ai créé des exemples simples pour chaque type de requête (CRUD, relations, agrégations) et je les ai testés en local avant de les intégrer dans les vrais projets.</p>

<h2>3. Apprendre les routes et le middleware</h2>
<p>Les routes Laravel définissent comment mapper les URLs aux contrôleurs. Le middleware filtre les requêtes avant qu\'elles n\'atteignent l\'application (authentification, CORS, etc.).</p>
<blockquote>
<p>Une bonne maîtrise du routing et du middleware est cruciale pour sécuriser une application.</p>
</blockquote>
<p>L\'équipe m\'a montré comment :</p>
<ul>
<li>Grouper les routes par ressource</li>
<li>Appliquer des middlewares personnalisés</li>
<li>Valider les entrées utilisateur</li>
</ul>

<h2>4. Pratiquer immédiatement sur de vrais projets</h2>
<p>La théorie c\'est bien, mais rien ne remplace la pratique. Dès la deuxième semaine, j\'ai reçu ma première tâche : corriger un bug dans une requête Eloquent mal optimisée.</p>
<p>Cette immersion m\'a forcé à :</p>
<ul>
<li>Déboguer du code que je ne connaissais pas</li>
<li>Comprendre les performances (N+1 queries, indexation)</li>
<li>Collaborer avec l\'équipe pour valider mes solutions</li>
</ul>

<h2>5. Consulter la documentation activement</h2>
<p>La documentation Laravel est excellente. J\'ai mis en place un système simple :</p>
<ul>
<li>Chaque jour, j\'apprenais un nouveau concept en lisant la doc</li>
<li>Je créais un fichier de notes avec les pièges à éviter</li>
<li>Je posais des questions aux collègues pour clarifier ce que je ne comprenais pas</li>
</ul>

<h2>Conclusion</h2>
<p>Trois mois après mon arrivée, j\'étais capable de développer des fonctionnalités complètes en autonomie. La clé a été la combinaison de :</p>
<ul>
<li> Étude structurée des concepts fondamentaux</li>
<li> Pratique immédiate sur de vrais projets</li>
<li> Collaboration avec une équipe bienveillante</li>
<li> Documentation maîtrisée</li>
</ul>
<p>Si vous êtes en position similaire, n\'hésitez pas : plongez dans le code, posez des questions, et célébrez vos premiers commits ! 🚀</p>'
];

// Article 2
$art2 = [
  'titre' => 'Les bases du design UI/UX avec Figma pour développeurs',
  'slug' => 'design-ui-ux-figma-developpeurs',
  'extrait' => 'Un développeur qui maîtrise Figma, c\'est un atout rare. Voici les notions essentielles pour passer de l\'idée à la maquette.',
  'categorie' => 'Design',
  'tags' => 'Figma,UI/UX,Design,Maquette',
  'contenu' => '<h2>Pourquoi un développeur doit apprendre Figma</h2>
<p>Beaucoup de développeurs considèrent le design comme un domaine extérieur à leurs compétences. C\'est une erreur. Maîtriser Figma en tant que développeur web, c\'est :</p>
<ul>
<li> <strong>Économiser du temps</strong> : Vous n\'attendez plus les maquettes, vous les créez vous-même</li>
<li> <strong>Mieux communiquer</strong> avec les designers : Vous comprenez leur langage</li>
<li> <strong>Construire des produits meilleurs</strong> : Vous pensez UX dès la conception, pas après</li>
<li> <strong>Augmenter votre valeur</strong> : Fullstack design + dev = profil rare et précieux</li>
</ul>

<h2>1. Les bases de Figma</h2>
<p>Figma est un outil de design collaboratif dans le cloud. Pas besoin d\'installer quoi que ce soit, c\'est basé sur le web.</p>

<h3>L\'interface</h3>
<p>Quand vous ouvrez un fichier Figma, vous avez :</p>
<ul>
<li><strong>Le canvas central</strong> : Où vous créez</li>
<li><strong>La barre d\'outils gauche</strong> : Rectangle, cercle, texte, image, etc.</li>
<li><strong>Le panneau droit</strong> : Propriétés de l\'élément sélectionné</li>
<li><strong>L\'arborescence pages/frames</strong> : Votre organisation</li>
</ul>

<h3>Les concepts clés</h3>
<p>Il faut comprendre quelques termes essentiels :</p>
<ul>
<li><strong>Frames</strong> : Des rectangles qui représentent des pages ou sections (responsive design)</li>
<li><strong>Components</strong> : Des éléments réutilisables (boutons, cartes, etc.) comme des composants React</li>
<li><strong>Constraints</strong> : Règles de redimensionnement intelligent</li>
<li><strong>Prototypes</strong> : Interactions et transitions interactive</li>
<li><strong>Design tokens</strong> : Couleurs, typographie, espaces centralisés</li>
</ul>

<h2>2. Les principes du design UI/UX</h2>

<h3>L\'hiérarchie visuelle</h3>
<p>Pas tout sur une page n\'a la même importance. Utilisez :</p>
<ul>
<li><strong>Taille</strong> : Plus grand = plus important</li>
<li><strong>Contraste</strong> : Les éléments sombres sur fond clair ressortent</li>
<li><strong>Couleur</strong> : Attirez l\'attention sur l\'élément clé</li>
<li><strong>Proximité</strong> : Groupez les éléments connexes</li>
</ul>

<h3>La cohérence</h3>
<p>Tous les boutons doivent avoir la même apparence et comportement. Tous les titres doivent utiliser la même police. Créez un <strong>design system</strong> : un ensemble de règles de style réutilisables.</p>

<h3>L\'accessibilité</h3>
<p>Pensez à :</p>
<ul>
<li>Le contraste des couleurs (au moins 4.5:1 pour le texte)</li>
<li>Les espacements clairs (les gens lisent mal sur mobile)</li>
<li>Les images avec du texte alternatif</li>
<li>Les interactions au clavier et au toucher</li>
</ul>

<h2>3. Workflow : De Figma au code</h2>

<h3>Étape 1 : Créer les wireframes</h3>
<p>Commencez par des rectangles simples (wireframe). Ne vous perdez pas dans les couleurs encore.</p>

<h3>Étape 2 : Ajouter la typographie et les couleurs</h3>
<p>Une fois que la structure est claire, appliquez les styles : polices, tailles, couleurs.</p>

<h3>Étape 3 : Créer des components</h3>
<p>Convertissez les éléments répétitifs en components Figma. Cela facilite les mises à jour massives.</p>

<h3>Étape 4 : Exporter les assets</h3>
<p>Figma vous permet d\'exporter les éléments au format PNG, SVG, etc. pour les utiliser dans votre code.</p>

<h3>Étape 5 : Convertir en HTML/CSS</h3>
<p>Enfin, traduisez votre design en code :</p>
<ul>
<li>Les frames deviennent des sections ou divs</li>
<li>Les components deviennent des classes CSS ou composants web</li>
<li>Les spacing/padding se convertissent directement en CSS</li>
</ul>

<h2>4. Un exemple concret : Une carte produit</h2>
<p>Voici comment je procède pour une carte produit :</p>

<h3>Dans Figma</h3>
<ol>
<li>Créer un component ProductCard (400x500px pour desktop)</li>
<li>Ajouter une image en haut (16:9)</li>
<li>Un titre au-dessous</li>
<li>Un prix souligné</li>
<li>Un bouton d\'action</li>
<li>Ajouter des hover states (ombres, changement d\'opacité)</li>
</ol>

<h3>En HTML/CSS</h3>
<pre><code>&lt;div class="product-card"&gt;
  &lt;img src="product.jpg" alt="Produit" class="product-img" /&gt;
  &lt;h3&gt;Nom du produit&lt;/h3&gt;
  &lt;p class="price"&gt;99€&lt;/p&gt;
  &lt;button class="btn-primary"&gt;Ajouter&lt;/button&gt;
&lt;/div&gt;</code></pre>

<p>Et les styles se font naturellement :</p>
<ul>
<li>Largeur 400px</li>
<li>Bordure légère</li>
<li>Ombres au survol</li>
<li>Transition douce sur les hover</li>
</ul>

<h2>5. Outils complémentaires</h2>
<p>Pour aller plus loin :</p>
<ul>
<li><strong>Penpot</strong> : L\'alternative open-source à Figma</li>
<li><strong>Framer</strong> : Pour les prototypes interactifs avancés</li>
<li><strong>Webflow</strong> : Designer web sans code, mais utile pour comprendre le responsive</li>
</ul>

<h2>Conclusion</h2>
<p>Apprendre Figma ne signifie pas devenir designer. Cela signifie devenir un développeur plus complet, capable de :</p>
<ul>
<li>✓ Maîtriser les principes UI/UX fondamentaux</li>
<li>✓ Créer rapidement des maquettes pour vos projets</li>
<li>✓ Dialoguer efficacement avec les designers</li>
<li>✓ Coder des interfaces qui ressemblent VRAIMENT à des designs professionnels</li>
</ul>
<p>Investissez quelques heures dans Figma : ce sera l\'une de vos meilleures décisions en tant que développeur. </p>'
];

// Article 3
$art3 = [
  'titre' => 'PHP OOP : les concepts essentiels à maîtriser en 2024',
  'slug' => 'php-oop-concepts-essentiels-2024',
  'extrait' => 'La programmation orientée objet en PHP reste incontournable. Tour d\'horizon des concepts clés : classes, héritage, interfaces, traits.',
  'categorie' => 'Tutoriel',
  'tags' => 'PHP,POO,OOP,Développement',
  'contenu' => '<h2>Pourquoi la POO en PHP est essentielle</h2>
<p>PHP OOP (Programmation Orientée Objet) n\'est pas une option : c\'est la base de tous les frameworks modernes (Laravel, Symfony, Zend). Si vous voulez développer des projets sérieux, vous devez maîtriser ces concepts.</p>
<p>Cet article vous présente les piliers de la POO en PHP avec des exemples concrets.</p>

<h2>1. Classes et Objets</h2>
<p>Une classe est un plan (blueprint) pour créer des objets.</p>

<h3>Syntaxe basique</h3>
<pre><code>class Utilisateur {
  private string $nom;
  private string $email;

  public function __construct(string $nom, string $email) {
    $this->nom = $nom;
    $this->email = $email;
  }

  public function getNom(): string {
    return $this->nom;
  }
}

// Création d\'un objet
$user = new Utilisateur("Alice", "alice@example.com");
echo $user->getNom(); // Alice</code></pre>

<h3>Les modificateurs d\'accès</h3>
<ul>
<li><strong>public</strong> : Accessible de partout (dangereux, à éviter généralement)</li>
<li><strong>private</strong> : Accessible uniquement dans la classe (recommandé)</li>
<li><strong>protected</strong> : Accessible dans la classe et ses enfants (pour l\'héritage)</li>
</ul>

<h2>2. L\'héritage</h2>
<p>L\'héritage permet à une classe d\'étendre une autre. Réutilisez le code et évitez la duplication.</p>

<pre><code>class Personne {
  protected string $nom;
  protected string $email;

  public function __construct(string $nom, string $email) {
    $this->nom = $nom;
    $this->email = $email;
  }

  public function afficher() {
    return "{$this->nom} ({$this->email})";
  }
}

// Développeur hérite de Personne
class Developpeur extends Personne {
  private string $langage;

  public function __construct(string $nom, string $email, string $langage) {
    parent::__construct($nom, $email);
    $this->langage = $langage;
  }

  public function afficher() {
    return parent::afficher() . " - Spécialité : {$this->langage}";
  }
}

$dev = new Developpeur("Bob", "bob@dev.com", "Laravel");
echo $dev->afficher();</code></pre>

<h2>3. Les Interfaces</h2>
<p>Une interface définit un contrat : "Toute classe qui implémente cette interface DOIT avoir ces méthodes".</p>

<pre><code>interface Payable {
  public function payer(float $montant): bool;
  public function remboursement(float $montant): bool;
}

class CarteBancaire implements Payable {
  public function payer(float $montant): bool {
    echo "Paiement de {$montant}€ par carte";
    return true;
  }

  public function remboursement(float $montant): bool {
    echo "Remboursement de {$montant}€ sur la carte";
    return true;
  }
}

class PayPal implements Payable {
  public function payer(float $montant): bool {
    echo "Paiement de {$montant}€ via PayPal";
    return true;
  }

  public function remboursement(float $montant): bool {
    echo "Remboursement de {$montant}€ via PayPal";
    return true;
  }
}

// Fonction générique qui fonctionne avec n\'importe quelle implémentation de Payable
function traiterCommande(Payable $methode) {
  $methode->payer(50);
}</code></pre>

<blockquote>
<p>Les interfaces forcent la cohérence : si vous oubliez une méthode, PHP lève une erreur immédiatement.</p>
</blockquote>

<h2>4. Les Traits</h2>
<p>Les traits sont des regroupements de méthodes qu\'on peut réutiliser dans plusieurs classes. C\'est utile quand l\'héritage n\'est pas la bonne solution.</p>

<pre><code>trait Auditable {
  protected array $logs = [];

  public function log(string $action) {
    $this->logs[] = [
      \'action\' => $action,
      \'timestamp\' => date(\'Y-m-d H:i:s\')
    ];
  }

  public function getLogs() {
    return $this->logs;
  }
}

class Article {
  use Auditable; // On utilise le trait

  private string $titre;

  public function __construct(string $titre) {
    $this->titre = $titre;
    $this->log("Article créé");
  }
}

$article = new Article("Mon article");
$article->log("Article modifié");
print_r($article->getLogs());</code></pre>

<h2>5. Les Propriétés et Méthodes statiques</h2>
<p>Les éléments statiques appartiennent à la classe, pas aux objets.</p>

<pre><code>class Config {
  public static string $appName = "Portfolio";
  private static int $versionMajeure = 1;

  public static function getVersion(): string {
    return "v" . self::$versionMajeure . ".0";
  }
}

echo Config::$appName; // Portfolio
echo Config::getVersion(); // v1.0

// Pas besoin de créer un objet pour accéder à des membres statiques</code></pre>

<h2>6. L\'encapsulation et les getters/setters</h2>
<p>Protégez vos données en utilisant des getters et setters pour valider les entrées.</p>

<pre><code>class User {
  private string $email;

  public function setEmail(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new InvalidArgumentException("Email invalide");
    }
    $this->email = $email;
  }

  public function getEmail(): string {
    return $this->email;
  }
}

$user = new User();
$user->setEmail("valide@example.com"); // OK
// $user->setEmail("invalide"); // Exception levée</code></pre>

<h2>7. Les namespaces</h2>
<p>Les namespaces évitent les conflits de noms entre classes.</p>

<pre><code>// Dans le fichier App/User.php
namespace App;

class User { }

// Dans le fichier Admin/User.php
namespace Admin;

class User { }

// Vous pouvez utiliser les deux sans conflit
$appUser = new App\\User();
$adminUser = new Admin\\User();</code></pre>

<h2>8. L\'autoloading avec Composer</h2>
<p>Composer gère l\'autoloading pour vous. Vous n\'avez plus besoin d\'inclure chaque fichier manuellement.</p>

<p>Exemple de composer.json :</p>
<pre><code>{
  "autoload": {
    "psr-4": {
      "App\\\\": "src/",
      "Admin\\\\": "admin/"
    }
  }
}</code></pre>

<p>Après avoir exécuté composer install, vos classes se chargent automatiquement.</p>

<h2>9. Bonnes pratiques</h2>
<ul>
<li><strong>Principe de responsabilité unique (SRP)</strong> : Une classe = une seule responsabilité</li>
<li><strong>Injection de dépendances</strong> : Passez les dépendances en paramètre plutôt que de les créer dans la classe</li>
<li><strong>Type hints</strong> : Spécifiez toujours les types (string, int, array, etc.)</li>
<li><strong>Documentation</strong> : Utilisez les docblocks pour documenter votre code</li>
</ul>

<h2>Conclusion</h2>
<p>La POO en PHP est puissante quand elle est bien utilisée. Les concepts clés à retenir :</p>
<ul>
<li>✓ <strong>Classes</strong> : Plans pour créer des objets</li>
<li>✓ <strong>Héritage</strong> : Réutilisez le code</li>
<li>✓ <strong>Interfaces</strong> : Imposez un contrat</li>
<li>✓ <strong>Traits</strong> : Partagez des fonctionnalités entre classes</li>
<li>✓ <strong>Encapsulation</strong> : Protégez vos données</li>
<li>✓ <strong>Namespaces</strong> : Organisez votre code</li>
</ul>
<p>Maîtriser ces concepts vous permettra de coder comme les pros et d\'utiliser les frameworks modernes sans passer par des "copy-paste" incompréhensibles. 💪</p>'
];

// Insérer les articles
$articles = [$art1, $art2, $art3];

try {
  foreach ($articles as $art) {
    $sql = "INSERT INTO articles 
            (titre, slug, extrait, contenu, categorie, tags, statut) 
            VALUES (:titre, :slug, :extrait, :contenu, :categorie, :tags, :statut)
            ON DUPLICATE KEY UPDATE 
              titre = VALUES(titre),
              extrait = VALUES(extrait),
              contenu = VALUES(contenu),
              categorie = VALUES(categorie),
              tags = VALUES(tags),
              statut = VALUES(statut)";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':titre' => $art['titre'],
      ':slug' => $art['slug'],
      ':extrait' => $art['extrait'],
      ':contenu' => $art['contenu'],
      ':categorie' => $art['categorie'],
      ':tags' => $art['tags'],
      ':statut' => 'publié'
    ]);
    
    echo "✓ Article inséré ou mis à jour : " . $art['titre'] . "\n";
  }
  
  echo "\n✅ Tous les articles ont été créés/mis à jour avec succès !\n";
  
  // Vérifier
  $result = $db->query("SELECT id, titre, LENGTH(contenu) as longueur FROM articles");
  $rows = $result->fetchAll();
  
  echo "\nVérification :\n";
  foreach ($rows as $row) {
    echo "- ID {$row['id']}: {$row['titre']} ({$row['longueur']} caractères)\n";
  }
  
} catch (Exception $e) {
  echo "❌ Erreur : " . $e->getMessage() . "\n";
}
?>
