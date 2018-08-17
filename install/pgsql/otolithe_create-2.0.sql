
set search_path = otolithe;


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
                "centre" VARCHAR(50),
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
  
/*
 * Fin de script
  * Mise a jour du numero de version
 */
 insert into dbversion (dbversion_number, dbversion_date)
 values
 ('2.0','2018-08-17')
 ;
