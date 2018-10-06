-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 28 sep. 2018 à 20:03
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jobtruck`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `surname`, `email`, `phone`, `quality`, `description`, `logo`, `created_at`) VALUES
(4, 'Rémi', 'Chevalier', 'r.chevalier@free.fr', '0675498632', 'partenaire_economique', 'DRH SysTeck', '2fec8aa9b90b555f428656ec282ddfad.png', '2018-09-27 18:24:02'),
(5, 'AFPA', 'Centre de formation', 'afpa@afpa.fr', '0675498458', 'centre_formation', 'Le marché du travail évolue, nous vous formons pour trouver de nouvelles opportunités !', 'cf0b5d413923437373f41f1d47c17832.png', '2018-09-27 18:26:15'),
(6, 'Pôle', 'emploi', 'pole@emploi.fr', '0675447558', 'pouvoirs_publics', 'Vous êtes demandeur d\'emploi, en recherche de formation, prenez contact avec nous.', '12c09827e2887124983359281ab2d759.png', '2018-09-27 18:27:59');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `complement1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `address`, `description`, `date`, `longitude`, `latitude`, `complement1`, `complement2`, `city`, `postal_code`) VALUES
(1, '1 rue marc donadile', 'Rencontre  avec nos partenaires de l\'AFPA et Pôle-emploi autour de l\'économie portuaire de Marseille.', '2018-10-07 11:00:00', '5.43000000', '43.34600000', 'Bâtiment B', NULL, 'Marseille', '13014'),
(2, '2 Rue Marc Donadille', 'TEST', '2019-01-01 10:00:00', '5.43105820', '43.34392080', NULL, NULL, 'Marseille', '13013');

-- --------------------------------------------------------

--
-- Structure de la table `events_contact`
--

DROP TABLE IF EXISTS `events_contact`;
CREATE TABLE IF NOT EXISTS `events_contact` (
  `events_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`events_id`,`contact_id`),
  KEY `IDX_1A039F229D6A1065` (`events_id`),
  KEY `IDX_1A039F22E7A1254A` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events_contact`
--

INSERT INTO `events_contact` (`events_id`, `contact_id`) VALUES
(1, 4),
(1, 5),
(1, 6),
(2, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `validity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `contact`, `logo`, `created_at`, `validity`) VALUES
(1, 'Technicien de maintenance - Carrefour', 'Avec 242 magasins en France les hypermarchés du Groupe Carrefour proposent un assortiment de références de produits alimentaires et non alimentaires pour tous les goûts et tous les budgets. Acteur du dynamisme économique local, Carrefour offre à chacun(e) une chance de trouver un emploi près de chez lui/elle, partout en France.\r\n\r\nCarrefour recherche pour son hypermarché un(e) :\r\n\r\nTechnicien(ne) de maintenance\r\n\r\n\r\nVotre Profil :\r\n\r\n    Vous êtes électrotechnicien titulaire d\'un CAP minimum ou vous avez une expérience de 2 ans minimum dans le domaine\r\n    Vous avez des connaissances en électricité, mécanique, frigorifique, pneumatique et la pratique des techniques en peinture, carrelage, plomberie, maçonnerie.\r\n    L’habilitation HOB0 est souhaitée.\r\n\r\n\r\nVos missions :\r\n\r\n    Assurer le bon fonctionnement des équipements\r\n    Réaliser la maintenance préventive et corrective des machines en effectuant des essais obligatoires de contrôle (prévoir des astreintes)\r\n    Détecter les risques et analyser les anomalies \r\n\r\n\r\nLes avantages Carrefour :\r\n\r\n    Une rémunération sur 13,5 mois après un an d\'ancienneté\r\n    Intéressement + participation\r\n    Mutuelle/prévoyance\r\n    Offres CE\r\n    6 semaines de Congés Payés\r\n    10 % de remise sur achat\r\n    Des perspectives d’évolution pour grandir\r\n\r\n\r\nMerci de joindre un CV et une lettre de motivation à votre candidature.\r\n\r\nRetrouvez les témoignages de nos collaborateur(trice)s qui vous parlent de leur métier sur notre site.', 'recrutement@carrefour.fr', 'bf37a0257acccf9cc1c8eece0d5c4a38.jpeg', '2018-09-25 15:21:47', 6),
(2, 'Directeur Qualité - Haribo', 'Rattaché(e) au Directeur Industriel, votre rôle consiste à définir et animer la politique qualité de Haribo France. Vous définissez les responsabilités, les missions et les objectifs de votre équipe (15 personnes).\r\n\r\nVos principales missions consistent à :\r\n\r\n    Animer la politique Qualité, \r\n\r\n    Etre garant en matière de sécurité alimentaire : \r\n\r\n    Organiser la formation du personnel aux normes QHSA,\r\n    Garantir le respect des exigences définies en matière d’hygiène et de sécurité des aliments,\r\n    Analyser les risques, mettre à jour les plans HACCP et les actions associées,\r\n    Rédiger et assurer le suivi des procédures et instructions nécessaires à la mise en œuvre et au suivi de la démarche HACCP,\r\n    Planifier et organiser les audits FSSC 22000 et assurer leur suivi jusqu’à l’application des actions sur le terrain,\r\n    Stopper toute production en cas de non-respect de la sécurité des aliments,\r\n    Gérer les crises.\r\n\r\n    Superviser les activités de Contrôle Qualité du Laboratoire : assurer le contrôle à réception des matières premières et emballage, des produits finis suivant plan de contrôle défini, et décider de leur libération ou blocage suivant leur conformité aux spécifications qualité. \r\n\r\n    Assurer le suivi des réclamations consommateurs, le suivi des constats d’anomalies et de non-conformité, procéder aux enquêtes éventuelles, coordonner les actions correctives, vérifier leur application et leur efficacité : pour la production sur le site, auprès des fournisseurs et des partenaires Interco, \r\n\r\n    Assurer les relations avec les prestataires extérieurs (DGCCRF, Douanes …), \r\n\r\n    Participer aux audits fournisseurs en liaison avec le Service Achats, \r\n\r\n    Participer aux équipes projet en tant que représentant de la fonction qualité. \r\n\r\nProfil recherché :\r\n\r\nIssu(e) d’une formation scientifique BAC + 5, vous avec une expérience de 10-15 ans en management qualité, ainsi qu’une expérience opérationnelle en production dans le domaine d’agro-alimentaire. Vous avez managé de projet et des équipes.\r\n\r\nVous êtes organisé, rigoureux et vous avez de bonnes aptitudes à communiquer. Vous savez gérer les aléas : vous savez analyser et prendre du recul. Vous savez fédérer les équipes.\r\n\r\nAnglais et/ou Allemand courant indispensables.\r\n\r\nPoste basé à Marseille, déplacement réguliers à Uzès à prévoir.\r\n\r\nPoste en CDI, à pourvoir ASAP', 'recrutement@haribo.fr', '5c81d2d3842090f453c40d4513ed29fe.png', '2018-09-26 07:08:51', 6),
(3, 'Technicien en Maintenance - Heineken', 'Au sein de l\'équipe maintenance et en lien direct avec la production, vous assurez les interventions de maintenance complexes en prenant les initiatives nécessaires en toute autonomie.\r\n\r\n    Doté(e) d\'excellentes compétences techniques, vous êtes en charge de la maintenance préventive et corrective des installations sur les secteurs fabrication et conditionnement du site dans le respect des exigences coûts/délais et sécurité/qualité/environnement.\r\n\r\n\r\n    Formé(e) à l\'utilisation des outils du Lean Management, vous pilotez et animez des équipes d\'amélioration.\r\n\r\nProfil\r\n\r\nLicence professionnelle ou à minima formation BTS/DUT (électrotechnique, maintenance industrielle, mécanique et/ou automatismes industriels …).\r\nUne expérience significative d\'au moins 5 ans dans un environnement industriel sur un poste similaire est souhaitée.\r\n\r\nUltra-innovants, nous saurons mettre en valeur vos compétences dans une ambiance de travail agréable avec des objectifs variés, une rémunération et des avantages attractifs !\r\nSi vous correspondez à ce profil, suivez votre instinct,\r\nRejoignez l\'aventure HEINEKEN !', 'recrutement@Heineken.fr', 'cb18a40b61b4209a736f81b4090dd8e6.jpeg', '2018-09-25 16:10:41', 6),
(4, 'Hôtesse / Hôte de Caisse - Leclerc', 'L\'Hôte (Hôtesse) de Caisse :\r\n\r\n    Assure l\'encaissement des ventes dans le respect des procédures et du Règlement Intérieur\r\n    Enregistre les achats des clients dans le respect des modalités d\'utilisation du matériel de caisse\r\n    Signale les erreurs de codification et de prix qu\'il/elle détecte\r\n    Vérifie qu\'aucun article n\'a été laissé par le client dans le caddie\r\n    Perçoit le montant des achats des clients\r\n    Vérifie la validité du mode de paiement\r\n    Assure les opérations d\'ouverture et fermeture de caisse ainsi que les prélèvements\r\n    Accueille les clients avec toute la courtoisie adéquate\r\n    Informe les clients des divers systèmes de paiement, des sacs consignés et de la carte fidélité E.Leclerc\r\n    Assure la propreté et le maintien en parfait état du poste de...', 'recrutement@Leclerc.fr', 'c569d3a774aa82048cc5fcbc89194aa4.jpeg', '2018-09-25 16:12:42', 6),
(5, 'Préparateur de commandes - Auchan Retail France', 'Et si VOTRE aventure commençait avec NOUS ?\r\n\r\nMais NOUS c\'est qui ? Hyper, super, proximité, drive et e-commerce, tout ce petit monde c\'est Auchan Retail France : des formats au service d\'un client omnicanal, attentif à son environnement et à son bien-être.\r\n\r\nCe qui nous guide avant tout, c\'est d\'être au service d\'une marque unique, connectée et responsable pour satisfaire quotidiennement nos clients. Wouaouh ! Ça, c\'est posé !\r\n\r\nEt chez Chronodrive, en tant que pionnier du drive alimentaire, il faut qu\'on reste au top ! Nous recherchons donc des collaborateurs pour chouchouter les commandes... et les clients ! Et ça tombe bien : nous recherchons un Préparateur de commandes H/F !\r\n\r\nEn détails, ça donne quoi ?\r\n\r\n    Vous élaborez : les commandes, comme dans Top Chef ! Vous préparez les commandes de vos clients aux petits oignons, vous les livrez et les renseignez en magasin, le tout saupoudré de sourire ! Pour cela, vous connaissez les opérations commerciales sur le bout des doigts :)\r\n\r\n    Vous ressentez : un amour fou pour vos clients ! La recette miracle que vous appliquez tous les jours : une commande bien préparée = un client satisfait ! Vous vous assurez que chaque client repart de nos quais avec la banane, vous colorez son quotidien tout en veillant à toujours respecter nos engagements service clients.\r\n\r\n    Vous réceptionnez : les produits, pardi ! Il faut faire tourner le magasin, en prenant soin de nos produits ! Vous contrôlez la qualité des produits réceptionnés, vous rangez la marchandise dans les rayons afin de faciliter la préparation de commande et vous gérerez également les stocks. Une vraie mission à 360° ! \r\n\r\n    Vous participez : à la vie du magasin, grâce à un esprit d\'équipe et de proximité avec vos collègues, votre manager, et les équipes du magasin de façon plus générale. Chacun chez nous a son rôle à jouer pour contribuer à la réussite du commerce de demain.\r\n\r\nChouette, non ? Alors si vous vous reconnaissez dans ce portrait, et que vous êtes dynamique et rigoureux(se), que vous avez une bonne connaissance produit et un esprit de service développé, que vous aimez le travail en équipe et souhaitez travailler dans une ambiance chaleureuse, alors n\'hésitez pas... Rejoignez-nous !\r\n\r\nEt l\'aventure ne s\'arrêtera peut-être pas là ! Demain, vous pourrez envisager d\'évoluer sur un autre métier, dans votre magasin ou ailleurs... L\'avenir, nous le construirons ensemble !\r\n\r\nDe notre côté, nous nous ferons un plaisir de vous former à votre nouveau métier et aux outils du quotidien, pour votre prise de poste mais également ensuite tout au long de votre parcours de carrière.\r\n\r\nAlors, génial non ? Nous nous sommes trouvés !', 'recrutement@Auchan.fr', 'ba554396c77b45e42d34716dfaa711f7.png', '2018-09-25 16:05:01', 6),
(6, 'Monteur / Monteuse d\'installation en télécommunications - Orange', 'MISSION :\r\nRéparation et installation de ligne téléphonique et ADSL\r\n\r\nPROFIL RECHERCHE :\r\nConnaissance du réseau télécom orange obligatoire et confirmé\r\nExpérimenté\r\nRigoureux et professionnel\r\n\r\nBesoin en:\r\nTechnicien en boucle local (réparation) & Technicien en ligne terminale (Installation)\r\n\r\nCompétences requises ou optionnelles : Permis B (voiture)', 'recrutement@orange.fr', '1627e31937793a94a5dac4f1770988ac.png', '2018-09-25 16:07:52', 6);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180926152041');

-- --------------------------------------------------------

--
-- Structure de la table `testimony`
--

DROP TABLE IF EXISTS `testimony`;
CREATE TABLE IF NOT EXISTS `testimony` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `testimony`
--

INSERT INTO `testimony` (`id`, `name`, `lastname`, `description`, `photo`) VALUES
(6, 'Nadia', 'Ouissa', 'Les évènements et conseils de l\'association mon permit de retrouver confiance en moi. Je travail aujourd\'hui dans une entreprise à taille humain en tant que chargé de communication.', 'b4a81889915c0d40ae818f8d75af9cb7.jpeg'),
(7, 'Thomas', 'Bloom', 'Issu d\'un quartier éloigné de toute forme de transport en commun et sans voiture, le déplacement sur des lieux de candidatures était problématique. Grâce aux minibus du JobTruck je peux me déplacer à mes entretients d\'embauche.', 'e076ce810a1aa94beff2b41078b5762e.jpeg'),
(8, 'Léa', 'Vecchini', 'Après 2 ans de petit boulot, l\'association JobTruck m\'a permit d\'avoir un contact avec la société Panzani, où j\'opère comme opératrice.', '70faa5fcfa6f0d1ceb7cc2f402b3a8af.jpeg'),
(9, 'Louise', 'Coulon', 'Sans diplôme ni emploi, j\'ai participé à un évènement de l\'association Jobtruck sur conseille d\'une amis. Une rencontre avec un centre de formation m\'a permit de passer un CAP petite enfance et décrocher mon premier emploi.', '47435db4a4029f3b217ebddbcd15c547.jpeg'),
(10, 'Mousa', 'Ngali', 'Après plusieurs contrat dans le BTP, j\'ai décider de suivre une formation et de lancer par la suite ma propre entreprise. Le réseau et les conseils fournit par l\'association m\'apporte une grande visibilité sur mon projet professionnel.', '7f436b1ed360ef35501ec8871516bd83.jpeg'),
(11, 'Amandine', 'Dupont', 'J\'ai eu la chance de rencontrer une DRH lors d\'un évènement JobTruck qui m\'a permit d\'accéder à un entretien, puis un emploi chez Séphora comme conseillère clientèle en boutique.', '623907d00f8d080cff116f9ed8896c9f.jpeg'),
(12, 'Vincent', 'Maison', 'Lors d\'un évènement, j\'ai rencontré le patron d\'une entreprise local de transport qui ne trouvait pas de chauffeur poids lourd. Suite à notre rencontre l\'entreprise ma proposé financé mon permit poids lourd pour avoir l\'emploi !', 'ce9adb0f99c40c64812354f8f3d1f521.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7A1254A` (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `contact_id`, `username`, `email`, `password`, `avatar`, `created_at`, `date_last_login`, `roles`) VALUES
(1, NULL, 'admin', 'admin@test.fr', '$2y$13$IYn5LYdApdEmRYTUoqoRz.QpYiu9svptruVulutJwmhRapDX2cQYC', '3d82728f0c790c62840f627e410ff947.jpeg', '2018-09-26 16:07:20', NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events_contact`
--
ALTER TABLE `events_contact`
  ADD CONSTRAINT `FK_1A039F229D6A1065` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1A039F22E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
