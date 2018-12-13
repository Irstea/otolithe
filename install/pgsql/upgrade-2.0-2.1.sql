set search_path = gacl;
insert into aclaco (aclaco_id, aclappli_id, aco) 
values 
(5, 1, 'lecture');

set search_path = otolithe;
alter table photolecture add column commentaire varchar, 
add column remarkable_points json;
comment on column photolecture.commentaire is 'Commentaires de lecture';
COMMENT ON COLUMN otolithe.photolecture.remarkable_points IS 'Liste des points remarquables identifiés sur la photo';

