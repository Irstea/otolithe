set search_path = gacl;
insert into aclaco (aclaco_id, aclappli_id, aco) 
values 
(5, 1, 'lecture');

set search_path = otolithe;
alter table photolecture add column commentaire varchar;
comment on column photolecture.commentaire is 'Commentaires de lecture';
