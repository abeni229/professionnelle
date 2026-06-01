<?php
/**
 * functions.php — Fonctions utilitaires partagées
 * Portfolio — Roukayath Gazaliou
 */

require_once __DIR__ . '/../config/db.php';

/* ============================================================
   SÉCURITÉ
   ============================================================ */

/**
 * Échappe une valeur pour l'affichage HTML
 */
function e(string $val): string {
    return htmlspecialchars($val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Génère un token CSRF et le stocke en session
 */
function csrfToken(): string {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie le token CSRF — arrête si invalide
 */
function verifyCsrf(string $token): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        die('Requête invalide.');
    }
    // Régénérer le token après usage
    unset($_SESSION['csrf_token']);
}

/**
 * Nettoie et valide une chaîne
 */
function clean(string $val): string {
    return trim(strip_tags($val));
}

/* ============================================================
   CONTACTS
   ============================================================ */

/**
 * Insère un message de contact en BDD
 * Retourne true si succès, false sinon
 */
function saveContact(string $nom, string $email, string $sujet, string $message): bool {
    try {
        $db  = getDB();
        $ip  = $_SERVER['REMOTE_ADDR'] ?? null;
        $sql = 'INSERT INTO contacts (nom, email, sujet, message, ip)
                VALUES (:nom, :email, :sujet, :message, :ip)';
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nom'     => clean($nom),
            ':email'   => clean($email),
            ':sujet'   => clean($sujet),
            ':message' => clean($message),
            ':ip'      => $ip,
        ]);
    } catch (PDOException $e) {
        error_log('saveContact error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Récupère tous les messages de contact (admin)
 */
function getContacts(bool $nonLusSeulement = false): array {
    $db  = getDB();
    $sql = 'SELECT * FROM contacts';
    if ($nonLusSeulement) $sql .= ' WHERE lu = 0';
    $sql .= ' ORDER BY cree_le DESC';
    return $db->query($sql)->fetchAll();
}

/* ============================================================
   ARTICLES / BLOG
   ============================================================ */

/**
 * Récupère tous les articles publiés
 */
function getArticles(int $limit = 0, string $categorie = ''): array {
    $db     = getDB();
    $params = [];
    $sql    = 'SELECT id, titre, slug, extrait, image, categorie, tags, vues, cree_le
               FROM articles
               WHERE statut = "publié"';

    if ($categorie !== '') {
        $sql .= ' AND categorie = :categorie';
        $params[':categorie'] = $categorie;
    }

    $sql .= ' ORDER BY cree_le DESC';

    if ($limit > 0) {
        $sql .= ' LIMIT ' . (int)$limit;
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Récupère un article par son slug
 */
function getArticleBySlug(string $slug): ?array {
    $db   = getDB();
    $stmt = $db->prepare(
        'SELECT * FROM articles WHERE slug = :slug AND statut = "publié" LIMIT 1'
    );
    $stmt->execute([':slug' => $slug]);
    $article = $stmt->fetch();
    return $article ?: null;
}

/**
 * Incrémente le compteur de vues d'un article
 */
function incrementVues(int $id): void {
    try {
        $db = getDB();
        $db->prepare('UPDATE articles SET vues = vues + 1 WHERE id = :id')
           ->execute([':id' => $id]);
    } catch (PDOException $e) {
        error_log('incrementVues error: ' . $e->getMessage());
    }
}

/**
 * Récupère les catégories uniques d'articles publiés
 */
function getCategories(): array {
    $db = getDB();
    return $db->query(
        'SELECT DISTINCT categorie FROM articles WHERE statut = "publié" ORDER BY categorie'
    )->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Formate une date en français
 */
function formatDate(string $date): string {
    $mois = [
        1=>'janvier',2=>'février',3=>'mars',4=>'avril',
        5=>'mai',6=>'juin',7=>'juillet',8=>'août',
        9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre'
    ];
    $ts = strtotime($date);
    return date('j', $ts) . ' ' . $mois[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

/**
 * Génère un slug depuis un titre
 */
function slugify(string $text): string {
    $text = mb_strtolower($text, 'UTF-8');
    $text = str_replace(
        ['é','è','ê','ë','à','â','ä','ô','ö','ù','û','ü','ç','î','ï'],
        ['e','e','e','e','a','a','a','o','o','u','u','u','c','i','i'],
        $text
    );
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', trim($text));
    return $text;
}

/**
 * Tronque un texte à N caractères
 */
function truncate(string $text, int $max = 150): string {
    if (mb_strlen($text) <= $max) return $text;
    return mb_substr($text, 0, $max) . '…';
}

/**
 * Retourne le temps relatif (ex: "il y a 3 jours")
 */
function timeAgo(string $date): string {
    $diff = time() - strtotime($date);
    if ($diff < 60)     return 'il y a quelques secondes';
    if ($diff < 3600)   return 'il y a ' . floor($diff/60) . ' min';
    if ($diff < 86400)  return 'il y a ' . floor($diff/3600) . ' h';
    if ($diff < 604800) return 'il y a ' . floor($diff/86400) . ' jour' . (floor($diff/86400)>1?'s':'');
    return formatDate($date);
}