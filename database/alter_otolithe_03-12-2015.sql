set search_path = otolithe;




CREATE SEQUENCE diadanalyse.otolithe.final_stripe_final_stripe_id_seq;

CREATE TABLE diadanalyse.otolithe.final_stripe (
                final_stripe_id INTEGER NOT NULL DEFAULT nextval('diadanalyse.otolithe.final_stripe_final_stripe_id_seq'),
                final_stripe_code VARCHAR NOT NULL,
                final_stripe_libelle VARCHAR NOT NULL,
                CONSTRAINT final_stripe_pk PRIMARY KEY (final_stripe_id)
);
COMMENT ON TABLE diadanalyse.otolithe.final_stripe IS 'Natures de la strie finale';
COMMENT ON COLUMN diadanalyse.otolithe.final_stripe.final_stripe_code IS 'Code utilisé';


ALTER SEQUENCE diadanalyse.otolithe.final_stripe_final_stripe_id_seq OWNED BY diadanalyse.otolithe.final_stripe.final_stripe_id;


ALTER TABLE diadanalyse.otolithe.photolecture ADD COLUMN annee_naissance INTEGER;

ALTER TABLE diadanalyse.otolithe.photolecture ADD COLUMN consensual_reading SMALLINT;

ALTER TABLE diadanalyse.otolithe.photolecture ADD COLUMN final_stripe_id INTEGER;

ALTER TABLE diadanalyse.otolithe.photolecture ADD COLUMN read_fiability REAL;

ALTER TABLE diadanalyse.otolithe.photolecture ADD CONSTRAINT final_stripe_photolecture_fk
FOREIGN KEY (final_stripe_id)
REFERENCES diadanalyse.otolithe.final_stripe (final_stripe_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

comment on column otolithe.photolecture.annee_naissance is 'Année de naissance estimée';
comment on column otolithe.photolecture.consensual_reading is '1 si lecture consensuelle';

comment on column otolithe.photolecture.read_fiability is 'Fiabilité de la lecture';
		
insert into otolithe.final_stripe (final_stripe_code, final_stripe_libelle)
values
('SH', 'Strie hyaline'),
('SO', 'Strie obscure'),
('ND', 'non déterminée');

