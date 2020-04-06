-- Diff code generated with pgModeler (PostgreSQL Database Modeler)
-- pgModeler version: 0.9.2
-- Diff date: 2020-04-02 15:14:50
-- Source model: ifremer
-- Database: ifremer
-- PostgreSQL version: 9.6

-- [ Diff summary ]
-- Dropped objects: 10
-- Created objects: 9
-- Changed objects: 15
-- Truncated tables: 0

SET search_path=public,pg_catalog,gacl,otolithe;
-- ddl-end --


-- [ Dropped objects ] --
DROP TABLE IF EXISTS gacl.login_oldpassword CASCADE;
-- ddl-end --


-- [ Created objects ] --

-- object: uuid | type: COLUMN --
-- ALTER TABLE otolithe.individu DROP COLUMN IF EXISTS uuid CASCADE;
ALTER TABLE otolithe.individu ADD COLUMN uuid uuid DEFAULT gen_random_uuid(),
add column wgs84_x double precision,
add column wgs84_y double precision;
COMMENT ON COLUMN otolithe.individu.wgs84_x IS E'Longitude of the capture, in wgs84';
-- ddl-end --
COMMENT ON COLUMN otolithe.individu.wgs84_y IS E'Latitude of the capture, in wgs84';
-- ddl-end --
ALTER table otolithe.piece add column uuid uuid default gen_random_uuid();

COMMENT ON COLUMN otolithe.photolecture.commentaire IS E'Commentaire sur la lecture';
-- ddl-end --


-- [ Created constraints ] --
-- object: logingestion_pk | type: CONSTRAINT --
-- ALTER TABLE gacl.logingestion DROP CONSTRAINT IF EXISTS logingestion_pk CASCADE;
ALTER TABLE gacl.logingestion ADD CONSTRAINT logingestion_pk PRIMARY KEY (id);
-- ddl-end --



comment on column otolithe.individu.wgs84_x is 'Longitude of the capture, in wgs84';
comment on column otolithe.individu.wgs84_y is 'Latitude of the capture, in wgs84';

INSERT INTO otolithe.dbversion (dbversion_number, dbversion_date) VALUES (E'2.3', E'2020-04-06');
