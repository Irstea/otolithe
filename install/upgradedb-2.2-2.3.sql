\c "dbname=otolithe"
CREATE EXTENSION pgcrypto
WITH SCHEMA public;

\c "dbname=otolithe user=otolithe password=otolithePassword host=localhost"

\ir pgsql/alter-2.2-2.3.sql