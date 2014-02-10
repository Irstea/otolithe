ALTER TABLE thalassotoque.otolithe.photo ADD COLUMN long_ref_pixel INTEGER;

comment on column otolithe.photo.long_ref_pixel is 'Longueur de reference en pixels - valeur par defaut pour photolecture, si non lu';
