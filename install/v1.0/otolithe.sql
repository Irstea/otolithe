
/* Code generated for Postgre_8_2_4 */


 CREATE SCHEMA otolithe;

set search_path = public,otolithe;

	
CREATE TABLE otolithe.piece(
piece_id integer NOT NULL,
individu_id integer NOT NULL,
piecetype_id integer NOT NULL,
piececode varchar(255),
traitement_id integer
) ;


CREATE SEQUENCE otolithe.SEQ_piece_piece_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.piece.piece_id	
;
ALTER TABLE otolithe.piece ALTER COLUMN piece_id SET DEFAULT nextval('otolithe.SEQ_piece_piece_id');




ALTER TABLE otolithe.piece ADD CONSTRAINT PK_piece PRIMARY KEY (piece_id);

	
	
 

	
CREATE TABLE otolithe.piecetype(
piecetype_id integer NOT NULL,
piecetype_libelle varchar(255) NOT NULL
) ;


CREATE SEQUENCE otolithe.SEQ_piecetype_piecetype_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.piecetype.piecetype_id	
;
ALTER TABLE otolithe.piecetype ALTER COLUMN piecetype_id SET DEFAULT nextval('otolithe.SEQ_piecetype_piecetype_id');




ALTER TABLE otolithe.piecetype ADD CONSTRAINT PK_piecetype PRIMARY KEY (piecetype_id);

	
	
 

	
CREATE TABLE otolithe.photo(
photo_id integer NOT NULL,
piece_id integer NOT NULL,
photo_nom varchar(255),
description varchar(255),
photo_filename varchar(512),
photo_date date,
color varchar(2),
lumieretype_id integer,
grossissement integer,
repere float,
photo_data bytea,
photo_thumbnail bytea,
uri varchar(512)
) ;


CREATE SEQUENCE otolithe.SEQ_photo_photo_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.photo.photo_id	
;
ALTER TABLE otolithe.photo ALTER COLUMN photo_id SET DEFAULT nextval('otolithe.SEQ_photo_photo_id');




ALTER TABLE otolithe.photo ADD CONSTRAINT PK_photo PRIMARY KEY (photo_id);

	
	
 

	
CREATE TABLE otolithe.lumieretype(
lumieretype_id integer NOT NULL,
lumieretype_libelle varchar(255) NOT NULL
) ;


ALTER TABLE otolithe.lumieretype ADD CONSTRAINT PK_lumieretype PRIMARY KEY (lumieretype_id);

	
	
 

	
CREATE TABLE otolithe.photolecture(
photolecture_id integer NOT NULL,
photo_id integer NOT NULL,
lecteur_id integer NOT NULL,
centre varchar(50),
bordure varchar(50)
) ;


CREATE SEQUENCE otolithe.SEQ_photolecture_photolecture_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.photolecture.photolecture_id	
;
ALTER TABLE otolithe.photolecture ALTER COLUMN photolecture_id SET DEFAULT nextval('otolithe.SEQ_photolecture_photolecture_id');

ALTER TABLE otolithe.photolecture ADD CONSTRAINT PK_photolecture PRIMARY KEY (photolecture_id);

SELECT AddGeometryColumn('otolithe', 'photolecture','points',-1,'MULTIPOINT',2);

SELECT Populate_Geometry_Columns('otolithe.photolecture'::regclass);	
 

	
CREATE TABLE otolithe.traitement(
traitement_id integer NOT NULL,
traitement_libelle varchar(255) NOT NULL
) ;


CREATE SEQUENCE otolithe.SEQ_traitement_traitement_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.traitement.traitement_id	
;
ALTER TABLE otolithe.traitement ALTER COLUMN traitement_id SET DEFAULT nextval('otolithe.SEQ_traitement_traitement_id');




ALTER TABLE otolithe.traitement ADD CONSTRAINT PK_traitement PRIMARY KEY (traitement_id);

	
	
 

	
CREATE TABLE otolithe.lecteur(
lecteur_id integer NOT NULL,
login varchar(100),
lecteur_nom varchar(50),
lecteur_prenom varchar(50)
) ;


CREATE SEQUENCE otolithe.SEQ_lecteur_lecteur_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 1
	NO CYCLE
	OWNED BY otolithe.lecteur.lecteur_id	
;
ALTER TABLE otolithe.lecteur ALTER COLUMN lecteur_id SET DEFAULT nextval('otolithe.SEQ_lecteur_lecteur_id');




ALTER TABLE otolithe.lecteur ADD CONSTRAINT PK_lecteur PRIMARY KEY (lecteur_id);

	


/* Code generated for Postgre_8_2_4 */


 

	
CREATE TABLE public.individu(
individu_id integer NOT NULL,
espece_id integer,
peche_id integer,
sexe_id integer,
codeindividu varchar(100),
taille float,
poids float,
remarque varchar(255),
parasite varchar(255),
age integer,
pectorale_gauche float,
diam_occ_h float,
diam_occ_v float,
ht_mm integer
) ;


CREATE SEQUENCE public.SEQ_individu_individu_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 1500
	NO CYCLE
	OWNED BY public.individu.individu_id	
;
ALTER TABLE public.individu ALTER COLUMN individu_id SET DEFAULT nextval('public.SEQ_individu_individu_id');




ALTER TABLE public.individu ADD CONSTRAINT PK_individu PRIMARY KEY (individu_id);

	
	
 

	
CREATE TABLE public.peche(
peche_id integer NOT NULL,
site varchar(100),
zonesite varchar(100),
peche_date timestamp(0) ,
campagne varchar(100),
peche_engin varchar(100),
personne varchar(100),
operateur varchar(100)
) ;


CREATE SEQUENCE public.SEQ_peche_peche_id
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 999999
	START WITH 300
	NO CYCLE
	OWNED BY public.peche.peche_id	
;
ALTER TABLE public.peche ALTER COLUMN peche_id SET DEFAULT nextval('public.SEQ_peche_peche_id');




ALTER TABLE public.peche ADD CONSTRAINT PK_sitepeche PRIMARY KEY (peche_id);

	
	
 

	
CREATE TABLE public.sexe(
sexe_id integer NOT NULL,
sexe_libelle varchar(255) NOT NULL,
sexe_libellecourt varchar(255) NOT NULL
) ;


ALTER TABLE public.sexe ADD CONSTRAINT PK_sexe PRIMARY KEY (sexe_id);

	
	
 

	
CREATE TABLE public.espece(
espece_id integer NOT NULL,
nom_id varchar(100) NOT NULL,
nom_vern varchar(100),
nom_fr varchar(100),
nom_eng varchar(100),
nom_esp varchar(100),
auteur varchar(100),
philum varchar(100),
subphilum varchar(100),
classe varchar(100),
ordre varchar(100),
famille varchar(100),
genre varchar(100),
code_asfis varchar(100),
taxocode varchar(100),
code_rubin varchar(100),
code_perso varchar(8)
) ;


ALTER TABLE public.espece ADD CONSTRAINT espece_pkey PRIMARY KEY (espece_id);

ALTER TABLE  public.espece ADD CONSTRAINT espece_nom_id_key UNIQUE (nom_id);

	
	


 

 
CREATE INDEX idx_codepoisson ON public.individu (codeindividu);
	



	

ALTER TABLE otolithe.piece ADD CONSTRAINT fk_piece_individu FOREIGN KEY (individu_id)
 REFERENCES public.individu(individu_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE otolithe.piece ADD CONSTRAINT fk_piece_piecetype FOREIGN KEY (piecetype_id)
 REFERENCES otolithe.piecetype(piecetype_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE otolithe.piece ADD CONSTRAINT fk_piece_traitement FOREIGN KEY (traitement_id)
 REFERENCES otolithe.traitement(traitement_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;



ALTER TABLE otolithe.photo ADD CONSTRAINT fk_photo_piece FOREIGN KEY (piece_id)
 REFERENCES otolithe.piece(piece_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE otolithe.photo ADD CONSTRAINT fk_photo_lumieretype FOREIGN KEY (lumieretype_id)
 REFERENCES otolithe.lumieretype(lumieretype_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;



ALTER TABLE otolithe.photolecture ADD CONSTRAINT fk_photolecture_photo FOREIGN KEY (photo_id)
 REFERENCES otolithe.photo(photo_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE otolithe.photolecture ADD CONSTRAINT fk_photolecture_lecteur FOREIGN KEY (lecteur_id)
 REFERENCES otolithe.lecteur(lecteur_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;








	

ALTER TABLE public.individu ADD CONSTRAINT fk_individu_sitepeche FOREIGN KEY (peche_id)
 REFERENCES public.peche(peche_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE public.individu ADD CONSTRAINT fk_individu_sexe FOREIGN KEY (sexe_id)
 REFERENCES public.sexe(sexe_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE public.individu ADD CONSTRAINT fk_individu_espece FOREIGN KEY (espece_id)
 REFERENCES public.espece(espece_id) MATCH SIMPLE ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;























ALTER ROLE otolithe SET SEARCH_PATH=otolithe,public;







ALTER ROLE thalassotoque_otolithe_g SET SEARCH_PATH=otolithe,public;





	