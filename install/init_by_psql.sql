/*
 * OTOLITHE - 2018-0/-17
 * Script de creation des tables destinees a recevoir les donnees de l'application
 * database creation script
 * 
 * version minimale de Postgresql : 9.4. / Minimal release of postgresql: 9.4
 * 
 * Schemas par defaut : col pour les donnees, et gacl pour les droits. 
 * Default schemas : col for data, gacl for right management
 * Si vous voulez utiliser d'autres schemas, modifiez les scripts :
 * If you want use others schemas, change these scripts:
 * gacl_create_2.0.sql et otolithe_create_2.0.sql 
 * Execution de ce script en ligne de commande, en etant connecte root :
 * at prompt, you cas execute this script as root:
 * su postgres -c "psql -f init_by_psql.sql"
 * 
 * dans la configuration de postgresql : / postgresql configuration:
 * /etc/postgresql/version/main/pg_hba.conf
 * inserez les lignes suivantes (connexion avec uniquement le compte collec en local) :
 * insert theses lines (connection only with the account collec on local server):
 * host    collec             collec             127.0.0.1/32            md5
 * host    all            collec                  0.0.0.0/0               reject
 */
 
 /*
  * Creation du compte de connexion et de la base de donnees
  * creation of connection account
  */
CREATE USER otolithe WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
 PASSWORD 'otolithePassword'  
;

/*
 * Database creation
 */
create database otolithe owner otolithe;
\c "dbname=otolithe"
create extension postgis schema public;

/*
 * connexion a la base otolithe, avec l'utilisateur otolithe, en localhost,
 * depuis psql
 * Connection to collec database with user otolithe on localhost server
 */
\c "dbname=otolithe user=otolithe password=otolithePassword host=localhost"

/*
 * Creation des tables dans le schema gacl
 * Tables creation in schema gacl
 */
\ir pgsql/gacl_create-2.0.sql

/*
 * Creation des tables dans le schema col
 * Tables creation in schema col
 */
\ir pgsql/otolithe_create-2.0.sql
