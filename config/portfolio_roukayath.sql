

CREATE DATABASE IF NOT EXISTS `portfolio_roukayath`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `portfolio_roukayath`;

-- ------------------------------------------------------------
--  TABLE : contacts
--  Stocke les messages reçus via le formulaire de contact
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contacts` (
  `id`         INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `nom`        VARCHAR(100)     NOT NULL,
  `email`      VARCHAR(150)     NOT NULL,
  `sujet`      VARCHAR(200)     NOT NULL,
  `message`    TEXT             NOT NULL,
  `ip`         VARCHAR(45)      DEFAULT NULL COMMENT 'IP de l\'expéditeur',
  `lu`         TINYINT(1)       NOT NULL DEFAULT 0 COMMENT '0=non lu, 1=lu',
  `cree_le`    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_lu`      (`lu`),
  INDEX `idx_cree_le` (`cree_le`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Messages reçus via le formulaire de contact';


-- ------------------------------------------------------------
--  TABLE : articles
--  Stocke les articles du blog
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
  `id`           INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `titre`        VARCHAR(255)     NOT NULL,
  `slug`         VARCHAR(255)     NOT NULL UNIQUE COMMENT 'URL SEO-friendly',
  `extrait`      VARCHAR(500)     DEFAULT NULL COMMENT 'Résumé court affiché en liste',
  `contenu`      LONGTEXT         NOT NULL,
  `image`        VARCHAR(255)     DEFAULT NULL COMMENT 'Chemin relatif : assets/img/blog/...',
  `categorie`    VARCHAR(80)      DEFAULT 'Général',
  `tags`         VARCHAR(300)     DEFAULT NULL COMMENT 'Tags séparés par virgule',
  `statut`       ENUM('brouillon','publié') NOT NULL DEFAULT 'brouillon',
  `vues`         INT UNSIGNED     NOT NULL DEFAULT 0,
  `cree_le`      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mis_a_jour`   DATETIME         DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_statut`    (`statut`),
  INDEX `idx_slug`      (`slug`),
  INDEX `idx_categorie` (`categorie`),
  INDEX `idx_cree_le`   (`cree_le`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Articles du blog';


-- ------------------------------------------------------------
--  DONNÉES DE TEST — Articles (optionnel, à supprimer en prod)
-- ------------------------------------------------------------
INSERT INTO `articles`
  (`titre`, `slug`, `extrait`, `contenu`, `categorie`, `tags`, `statut`)
VALUES
(
  'Comment j\'ai appris Laravel en autonomie pendant mon stage',
  'apprendre-laravel-autonomie-stage',
  'Retour d\'expérience sur l\'apprentissage de Laravel sans formation préalable, directement en contexte professionnel chez SolDigit.',
  '<p>Quand j\'ai débuté mon stage chez SolDigit en 2024, Laravel n\'était pas encore dans ma boîte à outils. Pourtant, l\'équipe travaillait exclusivement avec ce framework...</p><p>Voici comment j\'ai procédé pour maîtriser Laravel en quelques semaines...</p>',
  'Retour d\'expérience',
  'Laravel,PHP,Stage,Apprentissage',
  'publié'
),
(
  'Les bases du design UI/UX avec Figma pour développeurs',
  'design-ui-ux-figma-developpeurs',
  'Un développeur qui maîtrise Figma, c\'est un atout rare. Voici les notions essentielles pour passer de l\'idée à la maquette.',
  '<p>Beaucoup de développeurs négligent la phase de design. Pourtant, une bonne maquette Figma avant de coder fait gagner un temps précieux...</p>',
  'Design',
  'Figma,UI/UX,Design,Maquette',
  'publié'
),
(
  'PHP OOP : les concepts essentiels à maîtriser en 2025',
  'php-oop-concepts-essentiels-2025',
  'La programmation orientée objet en PHP reste incontournable. Tour d\'horizon des concepts clés : classes, héritage, interfaces, traits.',
  '<p>La POO en PHP est la base de frameworks comme Laravel ou Symfony. Voici les concepts que tout développeur PHP doit maîtriser...</p>',
  'Tutoriel',
  'PHP,POO,OOP,Développement',
  'publié'
);