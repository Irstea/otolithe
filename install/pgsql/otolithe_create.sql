create schema if not exists otolithe;

set search_path = otolithe, public;


CREATE SEQUENCE "espece_espece_id_seq";

CREATE TABLE "espece" (
                "espece_id" INTEGER NOT NULL DEFAULT nextval('"espece_espece_id_seq"'),
                "nom_id" VARCHAR NOT NULL,
                "nom_fr" VARCHAR,
                CONSTRAINT "espece_pkey" PRIMARY KEY ("espece_id")
);
COMMENT ON TABLE "espece" IS 'Liste des especes';


ALTER SEQUENCE "espece_espece_id_seq" OWNED BY "espece"."espece_id";

CREATE SEQUENCE "experimentation_exp_id_seq";

CREATE TABLE "experimentation" (
                "exp_id" INTEGER DEFAULT nextval('experimentation_exp_id_seq'::regclass) NOT NULL ,
                "exp_nom" VARCHAR NOT NULL,
                "exp_description" VARCHAR,
                "exp_debut" DATE,
                "exp_fin" DATE,
                CONSTRAINT "pk_experimentation" PRIMARY KEY ("exp_id")
);
COMMENT ON TABLE "experimentation" IS 'Experimentation a laquelle est rattache le poisson';


ALTER SEQUENCE "experimentation_exp_id_seq" OWNED BY "experimentation"."exp_id";

CREATE SEQUENCE "final_stripe_final_stripe_id_seq";

CREATE TABLE "final_stripe" (
                "final_stripe_id" INTEGER NOT NULL DEFAULT nextval('"final_stripe_final_stripe_id_seq"'),
                "final_stripe_code" VARCHAR NOT NULL,
                "final_stripe_libelle" VARCHAR NOT NULL,
                CONSTRAINT "final_stripe_pk" PRIMARY KEY ("final_stripe_id")
);
COMMENT ON TABLE "final_stripe" IS 'Natures de la strie finale';
COMMENT ON COLUMN "final_stripe"."final_stripe_code" IS 'Code utilisé';


ALTER SEQUENCE "final_stripe_final_stripe_id_seq" OWNED BY "final_stripe"."final_stripe_id";

CREATE SEQUENCE "individu_individu_id_seq";

CREATE TABLE "individu" (
                "individu_id" INTEGER DEFAULT nextval('individu_individu_id_seq'::regclass) NOT NULL,
                "espece_id" INTEGER NOT NULL,
                "peche_id" INTEGER,
                "sexe_id" INTEGER,
                "codeindividu" VARCHAR,
                "poids" DOUBLE PRECISION,
                "remarque" VARCHAR,
                "parasite" VARCHAR,
                "age" INTEGER,
                "longueur" DOUBLE PRECISION,
                "tag" VARCHAR,
                CONSTRAINT "pk_individu" PRIMARY KEY ("individu_id")
);


ALTER SEQUENCE "individu_individu_id_seq" OWNED BY "individu"."individu_id";

CREATE TABLE "individu_experimentation" (
                "individu_id" INTEGER NOT NULL,
                "exp_id" INTEGER NOT NULL,
                CONSTRAINT "individu_experimentation_pk" PRIMARY KEY ("individu_id", "exp_id")
);


CREATE SEQUENCE "lecteur_lecteur_id_seq";

CREATE TABLE "lecteur" (
                "lecteur_id" INTEGER DEFAULT nextval('lecteur_lecteur_id_seq'::regclass) NOT NULL ,
                "login" VARCHAR NOT NULL,
                "lecteur_nom" VARCHAR,
                "lecteur_prenom" VARCHAR,
                CONSTRAINT "pk_lecteur" PRIMARY KEY ("lecteur_id")
);
COMMENT ON TABLE "lecteur" IS 'personne realisant la lecture d''une photo';


ALTER SEQUENCE "lecteur_lecteur_id_seq" OWNED BY "lecteur"."lecteur_id";

CREATE TABLE "lecteur_experimentation" (
                "lecteur_id" INTEGER NOT NULL,
                "exp_id" INTEGER NOT NULL,
                CONSTRAINT "lecteur_experimentation_pk" PRIMARY KEY ("lecteur_id", "exp_id")
);
COMMENT ON TABLE "lecteur_experimentation" IS 'Table des experimentations autorisees pour un lecteur';


CREATE TABLE "lumieretype" (
                "lumieretype_id" INTEGER NOT NULL,
                "lumieretype_libelle" VARCHAR NOT NULL,
                CONSTRAINT "pk_lumieretype" PRIMARY KEY ("lumieretype_id")
);


CREATE SEQUENCE "peche_peche_id_seq";

CREATE TABLE "peche" (
                "peche_id" INTEGER DEFAULT nextval('peche_peche_id_seq'::regclass) NOT NULL,
                "site" VARCHAR,
                "zonesite" VARCHAR,
                "peche_date" TIMESTAMP,
                "campagne" VARCHAR,
                "peche_engin" VARCHAR,
                "personne" VARCHAR,
                "operateur" VARCHAR,
                CONSTRAINT "pk_sitepeche" PRIMARY KEY ("peche_id")
);
COMMENT ON TABLE "peche" IS 'Date de peche et lieu de capture';


ALTER SEQUENCE "peche_peche_id_seq" OWNED BY "peche"."peche_id";

CREATE SEQUENCE "photo_photo_id_seq";

CREATE TABLE "photo" (
                "photo_id" INTEGER DEFAULT nextval('photo_photo_id_seq'::regclass) NOT NULL,
                "piece_id" INTEGER NOT NULL,
                "lumieretype_id" INTEGER,
                "photo_nom" VARCHAR,
                "description" VARCHAR,
                "photo_filename" VARCHAR,
                "photo_date" TIMESTAMP,
                "color" VARCHAR,
                "grossissement" INTEGER,
                "repere" DOUBLE PRECISION,
                "photo_data" BYTEA,
                "photo_thumbnail" BYTEA,
                "uri" VARCHAR,
                "long_reference" DOUBLE PRECISION,
                "photo_height" INTEGER,
                "photo_width" INTEGER,
                "long_ref_pixel" INTEGER,
                CONSTRAINT "pk_photo" PRIMARY KEY ("photo_id")
);
COMMENT ON TABLE "photo" IS 'photos associees a une piece';
COMMENT ON COLUMN "photo"."photo_height" IS 'Hauteur de la photo originale';
COMMENT ON COLUMN "photo"."photo_width" IS 'Largeur de la photo originale';
COMMENT ON COLUMN "photo"."long_ref_pixel" IS 'Longueur de reference en pixels - valeur par defaut pour photolecture, si non lu';


ALTER SEQUENCE "photo_photo_id_seq" OWNED BY "photo"."photo_id";

CREATE SEQUENCE "photolecture_photolecture_id_seq";

CREATE TABLE "photolecture" (
                "photolecture_id" INTEGER DEFAULT nextval('photolecture_photolecture_id_seq'::regclass) NOT NULL ,
                "photo_id" INTEGER NOT NULL,
                "lecteur_id" INTEGER NOT NULL,
                "final_stripe_id" INTEGER,
                "centre" VARCHAR,
                "bordure" varchar,
                "points" geometry,
                "points_ref_lecture" geometry,
                "photolecture_date" TIMESTAMP NOT NULL,
                "long_ref_mesuree" DOUBLE PRECISION,
                "photolecture_height" INTEGER,
                "photolecture_width" INTEGER,
                "long_totale_lue" DOUBLE PRECISION,
                "long_totale_reel" DOUBLE PRECISION,
                "rayon_point_initial" REAL,
                "read_fiability" REAL,
                "consensual_reading" SMALLINT,
                "annee_naissance" INTEGER,
                "commentaire" varchar,
                CONSTRAINT "pk_photolecture" PRIMARY KEY ("photolecture_id"),
                CONSTRAINT enforce_dims_points CHECK (public.st_ndims(points) = 2),
                CONSTRAINT enforce_dims_points_ref_lecture CHECK (public.st_ndims(points_ref_lecture) = 2),
                CONSTRAINT enforce_geotype_points CHECK ((public.geometrytype(points) = 'MULTIPOINT'::text) OR (points IS NULL)),
                CONSTRAINT enforce_geotype_points_ref_lecture CHECK ((public.geometrytype(points_ref_lecture) = 'MULTIPOINT'::text) OR (points_ref_lecture IS NULL))
);
COMMENT ON TABLE "photolecture" IS 'Lecture realisee par une personne';
COMMENT ON COLUMN "photolecture"."points_ref_lecture" IS 'Emplacement des points utilises pour lire la longueur de reference';
COMMENT ON COLUMN "photolecture"."photolecture_height" IS 'Hauteur de la photo utilisee pour la lecture';
COMMENT ON COLUMN "photolecture"."photolecture_width" IS 'Largeur de la photo affichee pour realiser la lecture';
COMMENT ON COLUMN "photolecture"."long_totale_lue" IS 'Somme des segments entre chacun des points';
COMMENT ON COLUMN "photolecture"."long_totale_reel" IS 'Longueur totale réelle calculée pour le lecteur
(long_reference / long_ref_mesuree * long_totale_lue)';
COMMENT ON COLUMN "photolecture"."read_fiability" IS 'Fiabilité de la lecture';
COMMENT ON COLUMN "photolecture"."consensual_reading" IS '1 si lecture consensuelle';
COMMENT ON COLUMN "photolecture"."annee_naissance" IS 'Année de naissance estimée';
COMMENT ON COLUMN photolecture.commentaire IS 'Commentaire sur la lecture';


ALTER SEQUENCE "photolecture_photolecture_id_seq" OWNED BY "photolecture"."photolecture_id";

CREATE SEQUENCE "piece_piece_id_seq";

CREATE TABLE "piece" (
                "piece_id" INTEGER DEFAULT nextval('piece_piece_id_seq'::regclass) NOT NULL ,
                "individu_id" INTEGER NOT NULL,
                "piecetype_id" INTEGER NOT NULL,
                "traitementpiece_id" INTEGER,
                "piececode" VARCHAR(255),
                CONSTRAINT "pk_piece" PRIMARY KEY ("piece_id")
);
COMMENT ON TABLE "piece" IS 'Pieces analysees';


ALTER SEQUENCE "piece_piece_id_seq" OWNED BY "piece"."piece_id";

CREATE SEQUENCE "piecetype_piecetype_id_seq";

CREATE TABLE "piecetype" (
                "piecetype_id" INTEGER DEFAULT nextval('piecetype_piecetype_id_seq'::regclass) NOT NULL ,
                "piecetype_libelle" VARCHAR NOT NULL,
                CONSTRAINT "pk_piecetype" PRIMARY KEY ("piecetype_id")
);
COMMENT ON TABLE "piecetype" IS 'Type de piece';


ALTER SEQUENCE "piecetype_piecetype_id_seq" OWNED BY "piecetype"."piecetype_id";

CREATE TABLE "sexe" (
                "sexe_id" INTEGER NOT NULL,
                "sexe_libelle" VARCHAR NOT NULL,
                "sexe_libellecourt" VARCHAR NOT NULL,
                CONSTRAINT "pk_sexe" PRIMARY KEY ("sexe_id")
);


CREATE SEQUENCE "traitementpiece_traitementpiece_id_seq";

CREATE TABLE "traitementpiece" (
                "traitementpiece_id" INTEGER DEFAULT nextval('traitementpiece_traitementpiece_id_seq'::regclass) NOT NULL ,
                "traitementpiece_libelle" VARCHAR NOT NULL,
                CONSTRAINT "pk_traitementpiece" PRIMARY KEY ("traitementpiece_id")
);


ALTER SEQUENCE "traitementpiece_traitementpiece_id_seq" OWNED BY "traitementpiece"."traitementpiece_id";

ALTER TABLE "individu" ADD CONSTRAINT "espece_individu_fk"
FOREIGN KEY ("espece_id")
REFERENCES "espece" ("espece_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "individu_experimentation" ADD CONSTRAINT "experimentation_individu_experimentation_fk"
FOREIGN KEY ("exp_id")
REFERENCES "experimentation" ("exp_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "lecteur_experimentation" ADD CONSTRAINT "experimentation_lecteur_experimentation_fk"
FOREIGN KEY ("exp_id")
REFERENCES "experimentation" ("exp_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "photolecture" ADD CONSTRAINT "final_stripe_photolecture_fk"
FOREIGN KEY ("final_stripe_id")
REFERENCES "final_stripe" ("final_stripe_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "individu_experimentation" ADD CONSTRAINT "individu_individu_experimentation_fk"
FOREIGN KEY ("individu_id")
REFERENCES "individu" ("individu_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "piece" ADD CONSTRAINT "individu_piece_fk"
FOREIGN KEY ("individu_id")
REFERENCES "individu" ("individu_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "lecteur_experimentation" ADD CONSTRAINT "lecteur_lecteur_experimentation_fk"
FOREIGN KEY ("lecteur_id")
REFERENCES "lecteur" ("lecteur_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "photolecture" ADD CONSTRAINT "fk_photolecture_lecteur"
FOREIGN KEY ("lecteur_id")
REFERENCES "lecteur" ("lecteur_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "photo" ADD CONSTRAINT "fk_photo_lumieretype"
FOREIGN KEY ("lumieretype_id")
REFERENCES "lumieretype" ("lumieretype_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "individu" ADD CONSTRAINT "peche_individu_fk"
FOREIGN KEY ("peche_id")
REFERENCES "peche" ("peche_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "photolecture" ADD CONSTRAINT "fk_photolecture_photo"
FOREIGN KEY ("photo_id")
REFERENCES "photo" ("photo_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "photo" ADD CONSTRAINT "fk_photo_piece"
FOREIGN KEY ("piece_id")
REFERENCES "piece" ("piece_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "piece" ADD CONSTRAINT "fk_piece_piecetype"
FOREIGN KEY ("piecetype_id")
REFERENCES "piecetype" ("piecetype_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "individu" ADD CONSTRAINT "sexe_individu_fk"
FOREIGN KEY ("sexe_id")
REFERENCES "sexe" ("sexe_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE "piece" ADD CONSTRAINT "fk_piece_traitement"
FOREIGN KEY ("traitementpiece_id")
REFERENCES "traitementpiece" ("traitementpiece_id")
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

/*
 * Ajout des tables generiques
 */
 CREATE TABLE dbparam
(
   dbparam_id     integer   NOT NULL,
   dbparam_name   varchar   NOT NULL,
   dbparam_value  varchar
);

ALTER TABLE dbparam
   ADD CONSTRAINT dbparam_pk
   PRIMARY KEY (dbparam_id);

COMMENT ON TABLE dbparam IS 'Table des parametres associes de maniere intrinseque a l''instance';
COMMENT ON COLUMN dbparam.dbparam_name IS 'Nom du parametre';
COMMENT ON COLUMN dbparam.dbparam_value IS 'Valeur du paramètre';

CREATE TABLE dbversion
(
   dbversion_id      serial      NOT NULL,
   dbversion_number  varchar     NOT NULL,
   dbversion_date    timestamp   NOT NULL
);

-- Column dbversion_id is associated with sequence dbversion_dbversion_id_seq

ALTER TABLE dbversion
   ADD CONSTRAINT dbversion_pk
   PRIMARY KEY (dbversion_id);

COMMENT ON TABLE dbversion IS 'Table des versions de la base de donnees';
COMMENT ON COLUMN dbversion.dbversion_number IS 'Numero de la version';
COMMENT ON COLUMN dbversion.dbversion_date IS 'Date de la version';

/*
 * Ajout des libelles par defaut
 */
 INSERT INTO dbparam
(
  dbparam_id,
  dbparam_name,
  dbparam_value
)
VALUES
(
  1,
  'APPLI_title',
  'otolithe'
);

INSERT INTO final_stripe
  (final_stripe_id, final_stripe_code, final_stripe_libelle)
VALUES
  (1, 'SH', 'Strie hyaline'),
  (2, 'SO', 'Strie obscure'),
  (3, 'ND', 'non déterminée')
;

INSERT INTO lumieretype
  (lumieretype_id, lumieretype_libelle)
VALUES
  (1, 'Réfléchie'),
  (2, 'transmise')
  ;
INSERT INTO traitementpiece
  (traitementpiece_id, traitementpiece_libelle)
VALUES
  (1, 'polishing'),
  (2, 'grinding,polishing'),
  (3, 'grinding,polishing,staining'),
  (4, 'burning,cracking,grinding,polishing'),
  (6, 'burning,cracking'),
  (5, 'cracking,grinding,polishing'),
  (9, 'not recorded')
  ;
  
INSERT INTO espece
  (espece_id, nom_id, nom_fr)
VALUES
  (118, 'NoName', NULL),
  (71, 'Enophrys bubalis', 'chabot buffle'),
  (68, 'Echiichthys vipera', 'Petite vive'),
  (11, 'Alosa alosa, Alosa fallax', 'Aloses vraie et feinte'),
  (295, 'Abramis brama, Blicca bjoerkna', 'Brèmes'),
  (22, 'Atherina sp.', ' '),
  (45, 'Clupea sp.', ' '),
  (187, 'Sprattus sp.', ' '),
  (2, 'Abramis sp.', 'Brèmes d''eau douce nca'),
  (26, 'Barbus sp.', ' '),
  (37, 'Carassius sp.', ' '),
  (59, 'Cyprinus sp.', ' '),
  (141, 'Phoxinus sp.', ' '),
  (196, 'Tinca sp.', ' '),
  (77, 'Gambusia sp.', ' '),
  (40, 'Chelon sp.', ' '),
  (100, 'Lepomis sp.', ' '),
  (19, 'Argyrosomus sp.', ' '),
  (143, 'Platichthys flesus flesus', ' '),
  (144, 'Platichthys flesus italicus', ' '),
  (145, 'Platichthys flesus luscus', ' '),
  (146, 'Platichthys sp.', ' '),
  (148, 'Pleuronectes sp.', ' '),
  (157, 'Psetta sp.', ' '),
  (122, 'Osmerus mordax dentex', ' '),
  (123, 'Osmerus mordax mordax', ' '),
  (124, 'Osmerus sp.', ' '),
  (49, 'Cottus sp.', ' '),
  (175, 'Scyliorhinus canicula', 'Petite roussette'),
  (179, 'Silurus sp.', ' '),
  (86, 'Hippocampus ingens', ' '),
  (88, 'Hippocampus reidi', ' '),
  (98, 'Lampetra sp.', ' '),
  (136, 'Petromyzon sp.', ' '),
  (176, 'Scyliorhinus stellaris', 'Grande roussette'),
  (134, 'Petromyzon marinus', 'Lamproie marine'),
  (96, 'Lampetra fluviatilis', 'Lamproie de rivière'),
  (204, 'Trisopterus minutus', 'Capelan de Méditerranée'),
  (160, 'Raja naevus', 'Raie fleurie'),
  (161, 'Raja undulata', 'Raie brunette'),
  (61, 'Dasyatis sp.', 'Pastenagues nca'),
  (5, 'Acipenser sturio', 'Esturgeon commun'),
  (6, 'Acipenseridae', 'Esturgeons nca'),
  (44, 'Clupea harengus', 'Hareng de l''Atlantique'),
  (10, 'Alosa alosa', 'Alose vraie (=Grande alose)'),
  (286, 'Telestes souffia', 'Blageon'),
  (12, 'Alosa fallax', 'Alose feinte'),
  (13, 'Alosa sp.', 'Aloses nca'),
  (169, 'Sardina pilchardus', 'Sardine commune'),
  (188, 'Sprattus sprattus', 'Sprat'),
  (69, 'Engraulis encrasicolus', 'Anchois'),
  (70, 'Engraulis sp.', 'Anchois nca'),
  (165, 'Salmo salar', 'Saumon de l''Atlantique'),
  (167, 'Salmo trutta', 'Truite de mer'),
  (166, 'Salmo sp.', 'Truites nca'),
  (121, 'Osmerus mordax', 'Eperlan arc-en-ciel'),
  (125, 'Osmerus sp., Hypomesus sp.', 'Eperlans nca'),
  (73, 'Esox lucius', 'Brochet du Nord'),
  (58, 'Cyprinus carpio', 'Carpe commune'),
  (197, 'Tinca tinca', 'Tanche'),
  (9, 'Alburnus alburnus', 'Ablette'),
  (25, 'Barbus barbus', 'Barbeau fluviatile'),
  (41, 'Chondrostoma nasus', 'Nase commun'),
  (36, 'Carassius carassius', 'Carassin(=Cyprin)'),
  (163, 'Rutilus rutilus', 'Gardon'),
  (164, 'Rutilus sp.', 'Gardons nca'),
  (178, 'Silurus glanis', 'Silure glane'),
  (94, 'Ictalurus sp.', 'Barbottes nca'),
  (15, 'Anguilla anguilla', 'Anguille d''Europe'),
  (16, 'Anguilla sp.', 'Anguilles nca'),
  (47, 'Conger conger', 'Congre d''Europe'),
  (27, 'Belone belone', 'Orphie'),
  (28, 'Belone sp.', ' '),
  (74, 'Gadus morhua', 'Morue de l''Atlantique'),
  (149, 'Pollachius pollachius', 'Lieu jaune'),
  (203, 'Trisopterus luscus', 'Tacaud commun'),
  (107, 'Merlangius merlangus', 'Merlan'),
  (79, 'Gasterosteus sp.', 'Epinoches'),
  (89, 'Hippocampus sp.', ' '),
  (111, 'Mugil liza', 'Mulet lebranche'),
  (112, 'Mugil sp.', ' '),
  (104, 'Liza ramada', 'Mulet porc'),
  (105, 'Liza sp.', ' '),
  (113, 'Mugilidae', 'Mulets nca'),
  (64, 'Dicentrarchus sp.', 'Bars nca'),
  (189, 'Stizostedion lucioperca', 'Sandre'),
  (190, 'Stizostedion sp.', 'Sandres nca'),
  (199, 'Trachurus trachurus', 'Chinchard d''Europe'),
  (206, 'Umbrina cirrosa', 'Ombrine côtière'),
  (205, 'Umbrina canariensis', 'Ombrine bronze'),
  (55, 'Umbrina sp.', NULL),
  (18, 'Argyrosomus regius', 'Maigre commun'),
  (66, 'Diplodus sargus', 'Sar commun'),
  (186, 'Spondyliosoma cantharus', 'Dorade grise'),
  (185, 'Sparus aurata', 'Dorade royale'),
  (30, 'Boops boops', 'Bogue'),
  (115, 'Mullus surmuletus', 'Rouget de roche'),
  (114, 'Mullus sp.', 'Rougets nca'),
  (95, 'Labrus bergylta', 'Vieille commune'),
  (14, 'Ammodytes tobianus', 'Equille'),
  (81, 'Gobius niger', 'Gobie noir'),
  (171, 'Scomber scombrus', 'Maquereau commun'),
  (201, 'Trigla sp.', 'Grondins nca'),
  (147, 'Pleuronectes platessa', 'Plie d''Europe'),
  (142, 'Platichthys flesus', 'Flet d''Europe'),
  (182, 'Solea solea', 'Sole commune'),
  (180, 'Solea lascaris', 'Sole-pole'),
  (183, 'Solea sp.', ' '),
  (173, 'Scophthalmus rhombus', 'Barbue'),
  (156, 'Psetta maxima', 'Turbot'),
  (106, 'Lophius piscatorius', 'Baudroie commune'),
  (129, 'Palaemon serratus', 'Bouquet commun'),
  (131, 'Palaemonidae', 'Crevettes d''eau douce nca'),
  (50, 'Crangon crangon', 'Crevette grise'),
  (51, 'Crangon sp.', 'Crevettes crangon nca'),
  (154, 'Procambarus clarkii', 'Ecrevisse rouge de marais'),
  (155, 'Procambarus sp.', ' '),
  (38, 'Carcinus maenas', 'Crabe vert'),
  (126, 'Pachygrapsus transversus', 'Anglette africaine'),
  (72, 'Eriocheir sinensis', 'Crabe chinois'),
  (177, 'Sepia officinalis', 'Seiche commune'),
  (7, 'Acipenseriformes', ' '),
  (174, 'Scophthalmus sp.', ' '),
  (318, 'Loligo sp.', 'Calmars nca'),
  (297, 'Clupeidae', 'Harengs, sardines nca'),
  (300, 'Sciaena umbra', 'Corb commun'),
  (302, 'Palaemon macrodactylus', 'Bouquet migrateur'),
  (266, 'Myxine glutinosa', 'Myxine'),
  (255, 'Liza saliens', 'Mulet sauteur'),
  (293, 'Zoarces viviparus', 'Loquette d''Europe'),
  (232, 'Galeus melastomus', 'Chien espagnol'),
  (248, 'Leuciscus leuciscus', 'Vandoise'),
  (265, 'Mustelus mustelus', 'Emissole lisse'),
  (280, 'Squalus acanthias', 'Aiguillat commun'),
  (274, 'Raja brachyura', 'Raie lisse'),
  (301, 'Sardinella aurita', 'Allache'),
  (269, 'Oncorhynchus mykiss', 'Truite arc-en-ciel'),
  (287, 'Thymallus thymallus', 'Ombre commun'),
  (261, 'Molva molva', 'Lingue'),
  (257, 'Melanogrammus aeglefinus', 'Eglefin'),
  (276, 'Raniceps raninus', 'Trident'),
  (272, 'Pollachius virens', 'Lieu noir'),
  (231, 'Gaidropsarus vulgaris', 'Motelle commune'),
  (290, 'Trisopterus esmarkii', 'Tacaud norvégien'),
  (259, 'Micromesistius poutassou', 'Merlan bleu'),
  (292, 'Zeus faber', 'Saint Pierre'),
  (225, 'Diplodus annularis', 'Sparaillon commun'),
  (268, 'Oblada melanura', 'Oblade'),
  (263, 'Mullus barbatus', 'Rouget de vase'),
  (241, 'Labrus merula', 'Merle'),
  (288, 'Trachinus draco', 'Grande vive'),
  (289, 'Trigla lyra', 'Grondin lyre'),
  (229, 'Eutrigla gurnardus', 'Grondin gris'),
  (224, 'Cyclopterus lumpus', 'Lompe'),
  (250, 'Limanda limanda', 'Limande'),
  (260, 'Microstomus kitt', 'Limande sole'),
  (245, 'Lepidorhombus whiffiagonis', 'Cardine franche'),
  (328, 'Penaeus japonicus', 'Crevette kuruma'),
  (326, 'Palaemonetes varians', 'Bouquet atlantique des canaux'),
  (325, 'Palaemon elegans', 'Bouquet flaque'),
  (130, 'Palaemon sp.', NULL),
  (336, 'Processa edulis', 'Guernade nica'),
  (311, 'Dromia personata', 'Crabe dormeur'),
  (308, 'Cancer pagurus', 'Tourteau'),
  (327, 'Panopeus africanus', 'Crabe caillou africain'),
  (335, 'Portumnus latipes', 'Etrille elegante'),
  (322, 'Necora puber', 'Etrille commune'),
  (315, 'Liocarcinus depurator', 'Etrille pattes bleues'),
  (320, 'Loligo vulgaris', 'Encornet'),
  (304, 'Alloteuthis subulata', 'Casseron commun'),
  (340, 'Sepiola atlantica', 'Sépiole grandes oreilles'),
  (317, 'Loliginidae', 'Calmars côtiers nca'),
  (309, 'Carcinus aestuarii', 'Crabe vert de la Méditerranée'),
  (275, 'Raja microocellata', 'Raie mélée'),
  (264, 'Mustelus asterias', 'Emissole tachetée'),
  (262, 'Mugil cephalus', 'Mulet à grosse tête'),
  (254, 'Lithognathus mormyrus', 'Marbré'),
  (247, 'Leuciscus idus', 'Ide mélanote'),
  (230, 'Gaidropsarus mediterraneus', 'Motelle de Méditerranée'),
  (227, 'Enchelyopus cimbrius', 'Motelle à quatre barbillons'),
  (226, 'Diplodus cervinus', 'Sar à grosses lèvres'),
  (213, 'Arnoglossus laterna', 'Arnoglosse de Méditerranée'),
  (198, 'Torpedo marmorata', 'Torpille marbrée'),
  (159, 'Raja clavata', 'Raie bouclée'),
  (132, 'Perca fluviatilis', 'Perche européenne'),
  (120, 'Osmerus eperlanus', 'Eperlan européen'),
  (119, 'Orconectes limosus', 'Ecrevisse américaine'),
  (108, 'Merluccius merluccius', 'Merlu européen'),
  (103, 'Liza aurata', 'Mulet doré'),
  (93, 'Ictalurus punctatus', 'Barbue d''Amérique'),
  (83, 'Gymnocephalus cernuus', 'Grémille'),
  (78, 'Gasterosteus aculeatus', 'Epinoche à trois épines'),
  (75, 'Galeorhinus galeus', 'Requin-hâ'),
  (67, 'Diplodus vulgaris', 'Sar à tête noire'),
  (65, 'Dicologlossa cuneata', 'Cèteau'),
  (63, 'Dicentrarchus punctatus', 'Bar tacheté'),
  (62, 'Dicentrarchus labrax', 'Bar européen'),
  (53, 'Crassostrea gigas', 'Huître creuse du Pacifique'),
  (42, 'Ciliata mustela', 'Motelle à cinq barbillons'),
  (35, 'Carassius auratus', 'Poisson rouge(=Cyprin doré)'),
  (20, 'Atherina boyeri', 'Joêl'),
  (3, 'Acipenser baerii', 'Esturgeon de Sibérie'),
  (23, 'Atherinidae', 'Athérinidés nca'),
  (56, 'Cyprinidae', 'Cyprinidés nca'),
  (57, 'Cypriniformes', ' '),
  (128, 'Palaemon longirostris, P. serratus', 'crevettes blanche et rose'),
  (135, 'Petromyzon marinus, Lampetra fluviatilis', 'lamproie marine et lamproie de rivière'),
  (138, 'Petromyzontidae', 'Lamproies nca'),
  (137, 'Petromyzontiformes', ' '),
  (153, 'Pomatoschistus sp.', ' '),
  (168, 'Salmonidae', ' '),
  (202, 'Triglidae', 'Grondins, cavillones nca'),
  (211, 'Ammodytes semisquamatus', 'Lançon aiguille'),
  (52, 'Crangonidae', 'Crevettes crangonidés nca'),
  (239, 'Hippocampus guttulatus', 'Cheval marin'),
  (249, 'Leuroraja naevus', 'Raie fleurie'),
  (333, 'Pleuronectidae', 'Plies nca'),
  (29, 'Blicca bjoerkna', 'Brème bordelière'),
  (214, 'Arnoglossus thori', 'Arnoglosse tacheté'),
  (8, 'Agonus cataphractus', 'Souris de mer'),
  (24, 'Barbatula barbatula', 'Loche franche'),
  (31, 'Buglossidium luteum', 'Petite sole jaune'),
  (32, 'Callionymus phaeton', 'Callionyme paille-en-queue'),
  (33, 'Callionymus risso', 'Callionyme bélène'),
  (34, 'Callionymus sp.', 'Callionymes'),
  (46, 'Cobitis taenia', 'Loche de rivière'),
  (54, 'Ctenolabrus rupestris', 'Rouquié'),
  (60, 'Dasyatis pastinaca', 'Pastenague'),
  (76, 'Gambusia affinis', 'Gambusie'),
  (80, 'Gobio gobio', 'Goujon'),
  (82, 'Gobiusculus flavescens', 'Gobie nageur'),
  (85, 'Hippocampus hippocampus', 'Hippocampe à museau court'),
  (84, 'Hippocampus erectus', 'Hippocampe rayé'),
  (87, 'Hippocampus ramulosus', 'Hippocampe moucheté'),
  (91, 'Hyperoplus lanceolatus', 'Lançon commun'),
  (92, 'Ictalurus melas', 'Poisson chat'),
  (97, 'Lampetra planeri', 'Lamproie de Planer'),
  (102, 'Leuciscus cephalus', 'Chevaine'),
  (101, 'Leucaspius delineatus', 'Able de Heckel'),
  (109, 'Micropterus salmoides', 'Black bass'),
  (110, 'Misgurnus fossilis', 'Loche d''étang'),
  (116, 'Myoxocephalus scorpius', 'Chaboisseau à épines courtes'),
  (117, 'Nerophis ophidion', 'Nérophis tête bleue'),
  (139, 'Pholis gunnellus', 'Gonelle'),
  (140, 'Phoxinus phoxinus', 'Arlequin'),
  (151, 'Pomatoschistus minutus', 'Gobie buhotte'),
  (150, 'Pomatoschistus microps', 'Gobie tacheté'),
  (152, 'Pomatoschistus pictus', 'Gobie varié'),
  (158, 'Pungitius pungitius', 'Epinochette'),
  (172, 'Scophthalmus maximus', 'Turbot'),
  (181, 'Solea senegalensis', 'Sole sénégalaise'),
  (191, 'Symphodus melops', 'Crénilabre melops'),
  (192, 'Symphodus roissali', 'Crénilabre langaneu'),
  (193, 'Syngnathus acus', 'Syngnathe aiguille'),
  (294, 'Zosterisessor ophiocephalus', 'Gobie lotte'),
  (194, 'Syngnathus rostellatus', 'Syngnathe de Duméril'),
  (195, 'Syngnathus sp.', 'Syngnathes'),
  (200, 'Trigla lucerna', 'Grondin perlon'),
  (207, 'Pseudorasbora parva', 'Pseudorasbora'),
  (208, 'Callionymus lyra', 'Callionyme lyre'),
  (209, 'Alburnoides bipunctatus', 'Spirlin'),
  (210, 'Ammodytes marinus', 'Lançon équille'),
  (212, 'Aphia minuta', 'Nonnat'),
  (216, 'Balistes carolinensis', 'Baliste'),
  (218, 'Callionymus reticulatus', 'Callionyme réticulé'),
  (215, 'Aspitrigla cuculus', 'Grondin rouge'),
  (220, 'Centrolabrus exoletus', 'Petite vieille'),
  (221, 'Ciliata septentrionalis', 'Motelle à moustaches'),
  (222, 'Coris julis', 'Girelle'),
  (219, 'Carassius gibelio', 'Carassin argenté'),
  (223, 'Crystallogobius linearis', 'Gobie cristal'),
  (228, 'Entelurus aequoreus', 'Entélure'),
  (233, 'Gobius cobitis', 'Gobie céphalote'),
  (234, 'Gobius cruentatus', 'Gobie ensanglanté'),
  (236, 'Gobius paganellus', 'Gobie paganel'),
  (237, 'Gobius roulei', 'Gobie paganel gros oeil'),
  (235, 'Gobius geniporus', 'Gobie à joues poreuses'),
  (240, 'Hippoglossoides platessoides', 'Balai de l''Atlantique'),
  (242, 'Labrus mixtus', 'Coquette'),
  (244, 'Lepadogaster lepadogaster', 'Gluette barbier'),
  (243, 'Lepadogaster candolii', 'Gluette petite queue'),
  (246, 'Lesueurigobius friesii', 'Gobie raôlet'),
  (251, 'Liparis liparis', 'Limace de mer'),
  (252, 'Liparis montagui', 'Limace anicotte'),
  (256, 'Maurolicus muelleri', 'Brossé améthyste'),
  (267, 'Nerophis lumbriciformis', 'Nérophis petit nez'),
  (277, 'Rhodeus amarus', 'Bouvière'),
  (279, 'Spinachia spinachia', 'Epinoche de mer'),
  (282, 'Syngnathus abaster', 'Syngnathe gorge claire'),
  (284, 'Syngnathus typhle', 'Siphonostome'),
  (217, 'Blennius fluviatilis', 'Blennie fluviatile'),
  (253, 'Lipophrys pholis', 'Blennie mordocet'),
  (271, 'Parablennius sanguinolentus', 'Baveuse'),
  (270, 'Parablennius gattorugine', 'Blennie cabot'),
  (258, 'Micrenophrys lilljeborgi', 'Chabot têtu'),
  (329, 'Penaeus kerathurus', 'Caramote'),
  (310, 'Dromia sp.', '"Dormeur"'),
  (283, 'Syngnathus taenionotus', 'Syngnathe taenionotus'),
  (291, 'Zeugopterus punctatus', 'Targeur'),
  (306, 'Atyaephyra desmaresti,Palemon varians', 'crevettes divers'),
  (285, 'Taurulus bubalis', 'Chabot buffle'),
  (312, 'Galathea strigosa', 'Galathée striée'),
  (307, 'Bivalves', 'bivalves'),
  (316, 'Liocarcinus holsatus', '"Etrille"'),
  (313, 'Gammaridae', 'Gammares'),
  (323, 'Pachygrapsus marmoratus', 'Grapse marbré'),
  (314, 'Goneplax rhomboides', '"crabe"'),
  (321, 'Macropodia sp.', '"Macropodia"'),
  (319, 'Macoma balthica', 'Telline de la Baltique'),
  (330, 'Pilumnus hirtellus', 'Crabe rouge poilu'),
  (332, 'Planes minutus', '"crabe"'),
  (331, 'Pisidia longicornis', '"crabe"'),
  (334, 'Porcellana platycheles', '"crabe"'),
  (337, 'Salmo trutta trutta', 'Truite de mer brune'),
  (338, 'Salmo trutta fario', 'Truite fario'),
  (341, 'Sepiola sp.', 'Sépioles'),
  (339, 'Sepia sp.', 'Seiches'),
  (324, 'Pachygrapsus sp.', '"crabe"'),
  (305, 'Atelecyclus rotundatus', '"crabe"'),
  (303, 'Alloteuthis sp.', '"calmar"'),
  (184, 'Solea vulgaris', 'Sole commune'),
  (48, 'Cottus gobio', 'Chabot'),
  (43, 'Ciliata sp.', 'Motelle'),
  (39, 'Chelon labrosus', 'Mulet lippu'),
  (21, 'Atherina presbyter', 'Prêtre'),
  (17, 'Anguillidae', 'Anguilles'),
  (4, 'Acipenser sp.', 'Esturgeons'),
  (162, 'Rhodeus sericeus', 'Bouvière'),
  (299, 'Gobiidae', 'Gobidés'),
  (343, 'Aphanius fasciatus', 'Aphanius de Corse'),
  (298, 'Gadidae', 'Gadidés'),
  (278, 'Salaria pavo', 'Blennie paon'),
  (344, 'Microchirus variegatus', 'Sole perdrix'),
  (342, 'Zebrus zebrus', 'Gobie zébré'),
  (346, 'Pomatoschistus marmoratus', 'Gobie marbré'),
  (273, 'Pomatoschistus lozanoi', 'Gobie rouillé'),
  (501, 'Sarpa salpa', 'Saupe'),
  (170, 'Scardinius erythrophthalmus', 'Rotengle'),
  (127, 'Palaemon longirostris', 'crevette blanche'),
  (345, 'Palaemon adspersus', NULL),
  (99, 'Lepomis gibbosus', 'Perche soleil'),
  (90, 'Hippocampus zosterae', 'Hippocampe Atlantique ouest'),
  (500, 'Rajelle fyllae', 'Raie ronde'),
  (347, 'Symphodus cinereus', 'Crénilabre balafré'),
  (348, 'Symphodus tinca', 'Crénilabre paon'),
  (296, 'Syngnathidae', 'Syngnathes'),
  (502, 'Meduse sp.', 'Meduse'),
  (1, 'Abramis brama', 'Brème d''eau douce')
;
select setval('espece_espece_id_seq', (select max(espece_id) from espece));

insert into piecetype (piecetype_libelle)
values ('Otolithe');

INSERT INTO sexe
  (sexe_id, sexe_libelle, sexe_libellecourt)
VALUES
  (1, 'Mâle', 'M'),
  (2, 'Femelle', 'F'),
  (3, 'Juvénile', 'JUV'),
  (4, 'Indifférencié', 'IND')
;

-- Ajouts lies a la version 2.2

-- object: metadatatype | type: TABLE --
-- DROP TABLE IF EXISTS metadatatype CASCADE;
CREATE TABLE metadatatype (
	metadatatype_id integer NOT NULL GENERATED BY DEFAULT AS IDENTITY ,
	metadatatype_name varchar NOT NULL,
	metadatatype_comment varchar,
	metadatatype_description bytea,
	is_array boolean DEFAULT 'f',
	metadatatype_schema json,
	CONSTRAINT metadatatype_pk PRIMARY KEY (metadatatype_id)

);
-- ddl-end --
COMMENT ON COLUMN metadatatype.metadatatype_name IS 'Nom du type de métadonnées';
-- ddl-end --
COMMENT ON COLUMN metadatatype.metadatatype_comment IS 'Description du type de métadonnées';
-- ddl-end --
COMMENT ON COLUMN metadatatype.metadatatype_description IS 'Description externe du jeu de métadonnées (fichier PDF attaché, par exemple)';
-- ddl-end --
COMMENT ON COLUMN metadatatype.is_array IS 'Définit si les données sont sous forme de tableau ou uniques';
-- ddl-end --
COMMENT ON COLUMN metadatatype.metadatatype_schema IS 'Description JSON au format AlpacaJS du type de métadonnées';
-- ddl-end --

-- object: piecemetadata | type: TABLE --
-- DROP TABLE IF EXISTS piecemetadata CASCADE;
CREATE TABLE piecemetadata (
	piecemetadata_id integer NOT NULL GENERATED BY DEFAULT AS IDENTITY ,
	piece_id integer NOT NULL,
	metadatatype_id integer NOT NULL,
	metadata json,
	piecemetadata_date timestamp,
	piecemetadata_comment varchar,
	CONSTRAINT piecemetadata_pk PRIMARY KEY (metadatapiece_id)

);
-- ddl-end --
COMMENT ON TABLE piecemetadata IS 'Métadonnées rattachées à une pièce calcifiée';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.metadata IS 'Valeurs associées, au format Json';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.piecemetadata_date IS 'Date d''acquisition des informations';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.piecemetadata_comment IS 'Commentaires libres';
-- ddl-end --

-- [ Created foreign keys ] --
-- object: piece_fk | type: CONSTRAINT --
-- ALTER TABLE piecemetadata DROP CONSTRAINT IF EXISTS piece_fk CASCADE;
ALTER TABLE piecemetadata ADD CONSTRAINT piece_fk FOREIGN KEY (piece_id)
REFERENCES piece (piece_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: metadatatype_fk | type: CONSTRAINT --
-- ALTER TABLE piecemetadata DROP CONSTRAINT IF EXISTS metadatatype_fk CASCADE;
ALTER TABLE piecemetadata ADD CONSTRAINT metadatatype_fk FOREIGN KEY (metadatatype_id)
REFERENCES metadatatype (metadatatype_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --
/*
 * Fin de script
  * Mise a jour du numero de version
 */
insert into dbversion ("dbversion_number", "dbversion_date")
values 
('2.2','2019-01-07');

