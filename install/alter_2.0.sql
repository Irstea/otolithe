set search_path = gacl;

drop table gaclacl cascade;
drop table gaclaco cascade;
drop table gaclaro cascade;
drop table gaclaxo cascade;
drop table gaclphpgacl cascade;
drop table gaclacl_sections cascade;
drop table gaclaco_map cascade;
drop table gaclaco_sections cascade;
drop table gaclaro_groups cascade;
drop table gaclaro_groups_map cascade;
drop table gaclaro_map cascade;
drop table gaclaro_sections cascade;
drop table gaclaxo_groups cascade;
drop table gaclaxo_groups_map cascade;
drop table gaclaxo_map cascade;
drop table gaclaxo_sections cascade;
drop table gaclgroups_aro_map cascade;
drop table gaclgroups_axo_map cascade;
drop sequence gaclacl_seq;
drop sequence gaclaco_sections_seq;
drop sequence gaclaco_seq;
drop sequence gaclaro_groups_id_seq;
drop sequence gaclaro_sections_seq;
drop sequence gaclaro_seq;

alter table log add column ipaddress varchar;

set search_path=otolithe;
CREATE SEQUENCE "dbversion_dbversion_id_seq";

CREATE TABLE "dbversion" (
                "dbversion_id" INTEGER NOT NULL DEFAULT nextval('"dbversion_dbversion_id_seq"'),
                "dbversion_number" VARCHAR NOT NULL,
                "dbversion_date" TIMESTAMP NOT NULL,
                CONSTRAINT "dbversion_pk" PRIMARY KEY ("dbversion_id")
);
COMMENT ON TABLE "dbversion" IS 'Table des versions de la base de donnees';
COMMENT ON COLUMN "dbversion"."dbversion_number" IS 'Numero de la version';
COMMENT ON COLUMN "dbversion"."dbversion_date" IS 'Date de la version';


ALTER SEQUENCE "dbversion_dbversion_id_seq" OWNED BY "dbversion"."dbversion_id";

/*
 * Creation de la table de saisie des parametres locaux aux donnees
 */
CREATE TABLE "dbparam" (
                "dbparam_id" INTEGER NOT NULL,
                "dbparam_name" VARCHAR NOT NULL,
                "dbparam_value" VARCHAR,
                CONSTRAINT "dbparam_pk" PRIMARY KEY ("dbparam_id")
);
COMMENT ON TABLE "dbparam" IS 'Table des parametres associes de maniere intrinseque a l''instance';
COMMENT ON COLUMN "dbparam"."dbparam_name" IS 'Nom du parametre';
COMMENT ON COLUMN "dbparam"."dbparam_value" IS 'Valeur du paramètre';

insert into dbparam(dbparam_id, dbparam_name) values (1, 'APPLI_title');

create sequence seq_espece_espece_id owned by espece.espece_id;
alter table espece alter column espece_id  set default nextval ('seq_espece_espece_id' ::regclass) ;
select setval('seq_espece_espece_id', (select max(espece_id) from espece));

insert into dbversion (dbversion_number, dbversion_date)
values ('2.0', '2018-08-17');
