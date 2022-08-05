drop table if exists login_oldpassword cascade;

alter table gacl.acllogin add column totp_key varchar;
COMMENT ON COLUMN gacl.acllogin.totp_key IS E'TOTP secret key for the user';
CREATE UNIQUE INDEX acllogin_login_idx ON gacl.acllogin
	USING btree
	(
	  login
	);
create sequence otolithe.dbparam_dbparam_id_seq;
select setval( 'otolithe.dbparam_dbparam_id_seq', (select max(dbparam_id) from otolithe.dbparam));
alter table otolithe.dbparam alter column dbparam_id set default nextval('otolithe.dbparam_dbparam_id_seq');
insert into otolithe.dbparam (dbparam_name, dbparam_value) values ('otp_issuer', 'otolithe');

insert into otolithe.dbversion (dbversion_number, dbversion_date) values ('2.4', '2022-08-05');
