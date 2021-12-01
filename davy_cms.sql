-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 nov. 2021 à 22:50
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `davy_cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `titre_info` varchar(255) NOT NULL,
  `description_info` text NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `box` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `map` text NOT NULL,
  `etat` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `description`, `photo`, `titre_info`, `description_info`, `categorie`, `box`, `adresse`, `map`, `etat`, `membre_id`) VALUES
(1, 'Jaipur Café', 'Vous allez adorer ce décor indien aux couleurs rouge et rose. Dans une atmosphère bollywoodienne au plein cœur de Paris, vous trouverez une grande variété d\'épices relevant parfaitement les plats proposés. Les mets vous seront servis avec le sourire et l\'amabilité bien connus de l\'Inde. Vous allez apprécier le son du sitar pour une soirée suivant les traditions indiennes !', 'jaipur-cafe.jpg', 'Programme', 'Un menu \"Jaipur\" par personne (cocktail + entrée + pain traditionnel + plat + dessert)', 'Restaurant', 'Gastronomie', '15-17 Rue des Messageries, 75010 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10496.219863931889!2d2.3494165!3d48.8762287!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x88458fe40042b5b3!2sJaipur%20Caf%C3%A9%20%7C%20Restaurant%20Indien!5e0!3m2!1sfr!2sfr!4v1619457668212!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(2, 'La Marée', 'Situé pas très loin des Champs-Élysées, le restaurant La Marée vous fera découvrir une cuisine de poissons raffinée et savoureuse. Vous allez tomber sous le charme par des produits de la mer changeant au rythme des saisons. Avec sa cave d\'exception, La Marée séduit les passionnés de cuisine française dans une magnifique association plats et vins.', 'la-maree.jpg', 'Programme', 'Un menu \"La Marée\" par personne (apéritif + entrée + plat ou apéritif + plat + dessert)', 'Restaurant', 'Gastronomie', '1 Rue Daru, 75008 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10496.007828873993!2d2.300502211556192!3d48.87723923487808!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f9553967db5%3A0xad108e1a23bf6391!2s1%20Rue%20Daru%2C%2075008%20Paris!5e0!3m2!1sfr!2sfr!4v1622317782797!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(3, 'La Coupole', 'La Coupole est un restaurant unique avec sa décoration. Il est le symbole de l’art de vivre à la Française. Dans un espace original, il propose de partager de nouveaux moments de convivialité à tout moment de la journée, en mélangeant un lieu extraordinaire avec un service attentionné. Le chef a composé la carte autour des recettes plus contemporaines et de grands classiques de Brasserie.', 'la-coupole.jpg', 'Programme', 'Un menu \"Coupole\" par personne (entrée + plat + café + eau + vin ou plat + dessert + café + eau + vin)', 'Restaurant', 'Gastronomie', '102 Boulevard du Montparnasse, 75014 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.835981666417!2d2.325959351580363!3d48.84226717918424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671cec4369a6b%3A0x8fa64702fc94b419!2s102%20Boulevard%20du%20Montparnasse%2C%2075014%20Paris!5e0!3m2!1sfr!2sfr!4v1622331887548!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(4, 'Cèdres du Liban', 'Venez à l\'un des plus anciens restaurants libanais du 15e arrondissement de Paris. Depuis 40 ans, il propose de délicieux plats familiaux, traditionnels et authentiques, qui ravissent tous les gourmets. Laissez-vous attirer par la décoration pittoresque typique de la Méditerranée : murs de pierres blanches, arcades, fresques et peintures de peintres libanais sur les murs.', 'cedres-du-liban.jpg', 'Programme', 'Un repas par personne (apéritif + entrée + plat)', 'Restaurant', 'Gastronomie', '5 Avenue du Maine, 75015 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d168145.04205593644!2d2.2135148661069635!3d48.81498057076378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67032d0a5dc39%3A0x9cea77a4b54565bf!2sRestaurant%20Libanais%20Les%20C%C3%A8dres%20du%20Liban!5e0!3m2!1sfr!2sfr!4v1622331970915!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(5, 'Gourmands Disent', 'Situé dans le 15e arrondissement, Les Gourmands Disent vous offre bien des surprises ! Aux fourneaux, le chef renoue habilement avec les classiques de la cuisine française. Explorez des recettes délicieuses et créatives dans un environnement confortable et relaxant. Le meilleur, c\'est que tout ici est frais et fait maison. Alors qu\'est-ce que tu en penses ?', 'gourmands-disent.jpg', 'Programme', 'Un repas par personne (entrée + plat + vin ou plat + dessert + vin)', 'Restaurant', 'Gastronomie', '235 bis Rue St Charles, 75015 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d168145.6113224339!2d2.212827886459619!3d48.8148108445379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x949d7ddaee8ddfb1!2sRestaurant%20Les%20gourmands%20disent!5e0!3m2!1sfr!2sfr!4v1622332043637!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(6, 'Jodhpur Palace', 'Embarquez pour un voyage gourmand plein de saveurs. M. Baldev a une décoration traditionnelle et exquise au centre du 12ème arrondissement de Paris et est fier de recevoir ses invités au Jodhpur Palace. Vous pourrez déguster la cuisine de Jodhpur, du nom de la ville du nord de l\'Inde. A travers les gourmandises méticuleusement présentées, une véritable illumination gourmande vous attend.', 'jodhpur-palace.jpg', 'Programme', 'Un menu par personne (entrée + plat + dessert + vin)', 'Restaurant', 'Gastronomie', '42 Allée Vivaldi, 75012 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.8451882399236!2d2.38969221785419!3d48.84209157677732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6726ce9084499%3A0x480345aec38e45e5!2sJodhpur%20Palace!5e0!3m2!1sfr!2sfr!4v1622332141730!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(7, 'Bon Spa Thaï', 'Envie de vous évader ? Passez les portes de l\'exotique Bon Spa Thaï dans le deuxième arrondissement de Paris. Dans une atmosphère douce et apaisante, l\'équipe professionnelle vous servira avec ses connaissances professionnelles. Plongez-vous dans les bienfaits d\'un massage inspiré des méthodes traditionnelles thaïlandaises et profitez d\'un moment zen...', 'bon-spa-thai.jpg', 'Programme', 'Un massage aux huiles chaudes \"100% Bio\" en duo - 30 min', 'Spa', 'Bien-être', '27 Rue Saint-Sauveur, 75002 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d84015.28735525419!2d2.3206685754758274!3d48.84909996207779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xce5b08defe8f1258!2sBon%20Spa%20Thai%20-%20Paris%202%C3%A8me!5e0!3m2!1sfr!2sfr!4v1622332561827!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(8, 'Lôk Siam Spa Alésia', 'Au centre de Paris, imaginez un endroit calme et apaisant où vous pourrez profiter des bienfaits de la thérapie traditionnelle thaïlandaise. Lôk Siam Spa vous invite à plonger dans un univers empreint de tradition et de savoir-faire millénaire, où votre santé sera la priorité absolue. Repos exotique, à la recherche d\'une profonde tranquillité', 'lok-siam-spa-alesia.jpg', 'Programme', 'Un modelage thaï traditionnel - 30 min', 'Spa', 'Bien-être', '93 -95 Avenue du Général Leclerc, 75014 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.6751821773837!2d2.3245192515798796!3d48.82625867918262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671ae2884e277%3A0xb4ec1158ea854957!2sLok%20Siam%20Spa%20Al%C3%A9sia!5e0!3m2!1sfr!2sfr!4v1622332476272!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(9, 'Spa Thaï Luxe Versailles', 'Le massage thaï traditionnel est né il y a plus de 2500 ans et trouve son origine dans les traditions de la Chine et de l\'Inde. Au Spa Thaï Luxe Versailles à Paris, profitez de ses bienfaits entre les mains de masseurs formés dans une école de massage médical et traditionnel à Bangkok. Embarquez pour un doux voyage sensoriel dans une décoration zen et colorée !', 'spa-thai-luxe versailles.jpg', 'Programme', 'Une séance de réflexologie plantaire - 30 min', 'Spa', 'Bien-être', '254 Rue de la Croix Nivert, 75015 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.2682648619184!2d2.287657751580142!3d48.834021479183626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6717194c9c67b%3A0xb0d8ef424d79c04f!2sSPA%20THA%C3%8F%20LUXE%20PORTE%20DE%20VERSAILLES%20Massage%20Tha%C3%AF%20Paris!5e0!3m2!1sfr!2sfr!4v1622332604295!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(10, 'Aime Thaï Spa', 'Il existe des lieux où le corps peut être rempli de bonheur et l\'esprit peut être rempli de paix : Aime Thaï Spa est l\'un d\'entre eux. Dans le 11e arrondissement du centre de Paris, ouvrez la porte de ce petit paradis, oubliez la pression de la ville, et ressourcez-vous sereinement. Vous pourrez profiter d\'un soin de qualité, vous détendre sereinement, relâcher vos tensions et votre respiration... ', 'aime-thai-spa.jpg', 'Programme', 'Un modelage aux huiles chaudes - 30 min', 'Spa', 'Bien-être', '84 Rue de la Folie Méricourt, 75011 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12485.256897938907!2d2.3668791815304115!3d48.86389378560524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66de2dab01595%3A0xdd41203a269daf59!2sAIME%20THAI%20SPA!5e0!3m2!1sfr!2sfr!4v1622332689588!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(11, 'Sunso Sun & Beauty Lounge', 'Sunso Sun & Beauty Lounge a conçu le salon, et ses matériaux soulignent le confort de la cabine. Le slogan est simple : bronzer, maigrir, rajeunir ! L\'équipe du salon vous apportera des solutions spécifiques dans de nombreux domaines, comme l\'épilation classique ou longue durée, les soins anti-âge, l\'amincissement ou le bronzage avec ou sans UV. Détendez-vous à Paris.', 'sunso-sun.jpg', 'Programme', 'Un forfait d’une valeur de 85€ à choisir dans toute la gamme de soins et services : bronzage, épilation, amincissement, soin anti-âge...', 'Spa', 'Bien-être', 'Paris (75)', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167818.24823680703!2d2.2069777982120997!3d48.85899999147505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1619914509922!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(12, 'Zzz Zen Bar', 'L\'art de la sieste... Le Zzz Zen Nap Bar est dédié à l\'art de vivre urbain : massages du sommeil et assis, fauteuils en apesanteur et autres thérapies de relaxation entre deux rendez-vous vous permettront de vous ressourcer à chaque heure de votre 200 ans. Situé sur le pittoresque col de Choiseul à Paris, ne manquez pas le détour.', 'zzz-zen-bar.jpg', 'Programme', '- Une sieste \"Royale\" en duo - 45 min<br>\r\n- Un fish spa (nettoyage, bain de poissons, crème) - 20 min<br>', 'Spa', 'Bien-être', '29 Passage Choiseul, 75002 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20998.171018521694!2d2.3179806024338925!3d48.862569834790975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e3abe5acba9%3A0x813cd72767d47851!2sZZZen%20-%20Bar%20%C3%A0%20Sieste!5e0!3m2!1sfr!2sfr!4v1622332908149!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(13, 'L\'Aquarium de Paris', 'Au plus profond des reliefs surplombant les jardins du Trocadéro à Paris, plongez au centre d\'un monde aquatique fascinant de 10 000 poissons, invertébrés et 25 requins. Dans la pataugeoire, les enfants pourront approcher et toucher les poissons d\'eau douce. Passez une journée en famille, vous pourrez profiter de nombreuses activités interactives et intéressantes.', 'aquarium-de-paris.jpg', 'Programme', '1 entrée', 'Aquarium', 'Loisirs', '5 Avenue Albert de Mun, 75016 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.789935159372!2d2.2888019515809463!3d48.862215979186196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fe33c3187e5%3A0xf88aec5c3eb444e8!2sAquarium%20de%20Paris!5e0!3m2!1sfr!2sfr!4v1622332960174!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(14, 'Ballon de Paris', 'Vous voulez monter dans le ciel ? Visiter Paris comme jamais ? Envolez-vous sur cet énorme ballon captif ! Depuis son installation dans le parc André Citroën en 1999, la montgolfière parisienne peut contenir jusqu\'à 30 personnes et se situe à 150 mètres du sol. Là, profitez d\'une vue panoramique unique sur la capitale. Sur le point de décoller !', 'ballon-de-paris.jpg', 'Programme', '- 8 à 10 minutes de vol en ballon captif<br>\r\n- 2 cadeaux souvenirs<br>', 'Vol en ballon', 'Loisirs', 'Parc André Citroën, 75015 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.860607284895!2d2.2720295515803666!3d48.84179747918435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67bb16b32d3ab%3A0xde3ffa13390d9af6!2sBallon%20de%20Paris!5e0!3m2!1sfr!2sfr!4v1622333033872!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(15, 'Poterie et Compagnie', 'Vivez les bienfaits des activités artisanales au cœur de Paris avec Poterie et Compagnie. Dans un environnement lumineux et chaleureux, sous la direction de potiers expérimentés et passionnés, vous apprendrez les techniques nécessaires à la fabrication de véritables produits en terre cuite. Une activité ludique et relaxante qui vous aidera à éveiller votre sensibilité artistique.', 'poterie-et-compagnie.jpg', 'Programme', 'Un cours particulier de poterie - 60 min', 'Poterie', 'Loisirs', '3 Cité Riverin, 75010 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5248.737845855353!2d2.3540375680098844!3d48.87024324913082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0e14a2e093%3A0xfb3a7d1724784e13!2sPoterie%20Et%20Compagnie!5e0!3m2!1sfr!2sfr!4v1622333118391!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(16, 'Cultur\'in the City', 'Au début, il y a eu Benjamin, puis l\'acteur, producteur et passionné par le jeu d\'acteur. En 2014, il lance sa propre startup avec un objectif : démocratiser le plus grand nombre et rendre la culture accessible. Aujourd\'hui, il est devenu Cultur\'In The City, il vous a concocté un coffret cadeau, vous permettant de profiter du plus beau spectacle.', 'culturin-the-city.jpg', 'Programme', 'Une carte quatre places de spectacle \"Découverte\" Cultur\'in the City pour une ou deux personnes valable un an.', 'Spectacle', 'Loisirs', 'Paris (75)', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167818.24823680703!2d2.2069777982120997!3d48.85899999147505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1619914509922!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(17, 'Marin d\'eau douce', 'Découvrez la magnifique ville de Paris autrement ! Marin d\'eau frais vous propose un bateau électrique sans permis et facile à conduire qui vous permet de faire une balade unique sur le canal de l\'Ourcq à Paris. A la barre du navire, vous vous détendrez et découvrirez Paris comme jamais auparavant. Des bateaux de croisière sympathiques et respectueux de l\'environnement.', 'marin-deau-douce.jpg', 'Programme', '- 30 minutes de navigation sur un bateau électrique sur le Bassin de la Villette<br>\r\n- 1 bouteille de rosé<br>', 'Bateau', 'Loisirs', '37 Quai de la Seine, 75019 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.5568270552517!2d2.3712967515816255!3d48.885724379188474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66dd762f89e41%3A0x531e92a962cb374f!2sMarin%20D\'Eau%20Douce!5e0!3m2!1sfr!2sfr!4v1622333275515!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(18, 'Cirque Bormann Moreno', 'Le Cirque Bormann Moreno met à votre disposition le dernier programme \"Nouvelle Expérience\" à Paris, où vous pourrez apprécier trapézistes, jongleurs, funambules, clowns, mais surtout, afin de faire plaisir aux petits et aux grands, des animaux : zèbres, dromadaire, chameau, cheval ou tigre. Un atelier cirque est proposé 30 minutes avant chaque représentation.', 'cirque-bormann-moreno.jpg', 'Programme', 'Une place en \"Balcons\"', 'Cirque', 'Loisirs', '5 Rue Lucien Bossoutrot, 75015 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.078864234347!2d2.268622451580236!3d48.83763437918389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5fd343b7f1a1b%3A0x4c1a08a23120100f!2sCirque%20Bormann-Moreno!5e0!3m2!1sfr!2sfr!4v1622333542219!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(19, 'Freedom Organisations', 'L\'entreprise est spécialisé dans le transport de personnes à moto. Fred vous fera découvrir sa moto Goldwing GL1800 aux sièges chauffants, les grands monuments historiques de la capitale, les ruelles typiques et autres lieux insolites.', 'freedom-organisations.jpg', 'Programme', '1 heure de visite de Paris en Taxi Moto', 'Visite', 'Aventure', 'Paris (8ème)', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167818.24823680703!2d2.2069777982120997!3d48.85899999147505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1619914509922!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(20, 'Dream On Board', 'Prenons un cabriolet Ferrari ou un cabriolet Lamborghini pour 20 minutes de plaisir intense sur les Champs Elysées. Vous vous souviendrez toujours de la mélodie magique de votre voiture de course légendaire ! Les cheveux au vent, vous pouvez simplement vous considérer comme une star au style bling-bling.', 'dream-on-board.jpg', 'Programme', '20 minutes de pilotage à bord de Lamborghini Gallardo Spyder, Ferrari F430 Spider ou Ferrari California (également une cabriolet) sur les Champs-Élysées', 'Pilotage', 'Aventure', 'Place de Varsovie, 75116 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35316.813806700346!2d2.238292695708543!3d48.859394729159526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67326b4ce3217%3A0x39cb5424c2e34105!2sDream%20on%20Board!5e0!3m2!1sfr!2sfr!4v1622333635561!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(21, 'OldTimers Paris', 'Explorez Paris dans un authentique tracteur Citroën ! De la Tour Eiffel aux Champs-Elysées, de Montmartre aux ruelles de Saint-Germain-des-Prés, il y a trop de lieux à voir et à admirer dans notre surnom de \"Ville Lumière\". Un souhait particulier ? Vous avez juste besoin de demander! La façon originale et unique de découvrir la capitale. En chemin !', 'oldtimers-paris.jpg', 'Programme', '1 heure de balade personnalisée \"Découverte de Paris\" en Citroën Traction', 'Balade', 'Aventure', '61 Rue Lamarck, 75018 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49953.772782182576!2d2.313449010401877!3d48.851120584346255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbff48edb16d87d1b!2sOldTimersParis.com%20%3A%20Vintage%20Car%20Tours%20of%20Paris%20by%20Citroen%20Traction%20%26%20Mariages%20en%20Voiture%20de%20Collection!5e0!3m2!1sfr!2sfr!4v1622333689277!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(22, 'Parisi Tour', 'La capitale mythique de Paris étonne toujours par son architecture et son patrimoine culturel hors du commun. Pour ajouter au charme de cette découverte, Parisi Tour vous emmènera à bord d\'une 2CV (la voiture française la plus emblématique) pour faire le tour de la Ville Lumière accompagné d\'un chauffeur-guide haut en couleur.', 'parisi-tour.jpg', 'Programme', 'Un tour \"Paris ! Paris !\" : 45 minutes de découverte de Paris - 45 min', 'Découverte', 'Aventure', '20 Avenue de Versailles, 75016 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.4078965766435!2d2.2744015515805804!3d48.85043177918505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670077deb808d%3A0x9291b1b34d99be9c!2sParisitour%20-%20Paris%20en%202CV!5e0!3m2!1sfr!2sfr!4v1622333732271!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(23, 'Marin d\'eau douce', 'Découvrez la magnifique ville de Paris autrement ! Marin d\'eau frais vous propose un bateau électrique sans permis et facile à conduire qui vous permet de faire une balade unique sur le canal de l\'Ourcq à Paris. A la barre du navire, vous vous détendrez et découvrirez Paris comme jamais auparavant. Des bateaux de croisière sympathiques et respectueux de l\'environnement.', 'marin-deau-douce.jpg', 'Programme', '- 1 bouteille de champagne\r\n- 1 heure de navigation sur un bateau électrique sur le bassin de la Villette', 'Bateau', 'Aventure', '37 Quai de la Seine, 75019 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.5568270552517!2d2.3712967515816255!3d48.885724379188474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66dd762f89e41%3A0x531e92a962cb374f!2sMarin%20D\'Eau%20Douce!5e0!3m2!1sfr!2sfr!4v1622333275515!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1),
(24, 'VR & CO', 'VR & Co est un espace de 140 mètres carrés situé au centre de Paris, dédié aux différentes formes de réalité virtuelle. Une personne ou une équipe pour vivre une sensation très particulière : exploration, escalade, escape game, course, jeux de tir, plongée sous-marine ou survol de Paris... Il y a toujours de quoi surprendre et satisfaire tout le monde !', 'vr-co.jpg', 'Programme', '40 minutes d\'expériences en réalité virtuelle (sans limite du nombre de jeux) accompagnés d\'un Game Master', 'Virtuelle', 'Aventure', '49 Boulevard Saint-Michel, 75005 Paris', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.5056237565154!2d2.339643951580548!3d48.84856797918496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671c7ac90a593%3A0xf4e4e4259d7f2d6d!2sVR%20%26%20Co%20-%20Salle%20de%20R%C3%A9alit%C3%A9%20Virtuelle%20Paris!5e0!3m2!1sfr!2sfr!4v1622333778218!5m2!1sfr!2sfr\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mdpoublier`
--

CREATE TABLE `mdpoublier` (
  `id_mdpoublier` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `statut` int(5) NOT NULL,
  `email_validation` varchar(255) NOT NULL,
  `limit_connexion` int(11) NOT NULL,
  `limit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom`, `prenom`, `email`, `mdp`, `statut`, `email_validation`, `limit_connexion`, `limit_date`) VALUES
(1, 'Chen', 'Davy', 'chendavyweb@gmail.com', '$2y$10$PJa9QxOUnhVHXBO0xrMgpu1Uz0Qg5uOPsquKOftJ/iKgK09nphI9u', 0, '1', 0, '2021-05-12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `mdpoublier`
--
ALTER TABLE `mdpoublier`
  ADD PRIMARY KEY (`id_mdpoublier`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `mdpoublier`
--
ALTER TABLE `mdpoublier`
  MODIFY `id_mdpoublier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
