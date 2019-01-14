-- Diff code generated with pgModeler (PostgreSQL Database Modeler)
-- pgModeler version: 0.9.2-alpha1
-- Diff date: 2018-12-20 17:28:13
-- Source model: otolithe
-- Database: otolithe
-- PostgreSQL version: 11.0

-- [ Diff summary ]
-- Dropped objects: 0
-- Created objects: 5
-- Changed objects: 2
-- Truncated tables: 0

SET search_path=otolithe,public;
-- ddl-end --


-- object: metadatatype | type: TABLE --
-- DROP TABLE IF EXISTS metadatatype CASCADE;
create sequence metadatatype_metadatatype_id_seq;

CREATE TABLE metadatatype (
	metadatatype_id integer DEFAULT nextval('metadatatype_metadatatype_id_seq'::regclass) NOT NULL,
	metadatatype_name varchar NOT NULL,
	metadatatype_comment varchar,
	metadatatype_description bytea,
	is_array boolean DEFAULT 'f',
	metadatatype_schema json,
	CONSTRAINT metadatatype_pk PRIMARY KEY (metadatatype_id)

);

ALTER SEQUENCE "metadatatype_metadatatype_id_seq" OWNED BY "metadatatype"."metadatatype_id";

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
create sequence piecemetadata_piecemetadata_id_seq;

CREATE TABLE piecemetadata (
	piecemetadata_id integer DEFAULT nextval('piecemetadata_piecemetadata_id_seq'::regclass) NOT NULL,
	piece_id integer NOT NULL,
	metadatatype_id integer NOT NULL,
	metadata json,
	piecemetadata_date timestamp,
	piecemetadata_comment varchar,
	CONSTRAINT piecemetadata_pk PRIMARY KEY (piecemetadata_id)

);

alter sequence "piecemetadata_piecemetadata_id_seq" OWNED BY piecemetadata.piecemetadata_id;
-- ddl-end --
COMMENT ON TABLE piecemetadata IS 'Métadonnées rattachées à une pièce calcifiée';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.metadata IS 'Valeurs associées, au format Json';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.piecemetadata_date IS 'Date d''acquisition des informations';
-- ddl-end --
COMMENT ON COLUMN piecemetadata.piecemetadata_comment IS 'Commentaires libres';
-- ddl-end --

alter table photolecture add column commentaire varchar;
COMMENT ON COLUMN photolecture.commentaire IS 'Commentaire sur la lecture';
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

insert into dbversion ("dbversion_number", "dbversion_date")
values 
('2.2','2019-01-07');
