;
; *WARNING* 
;
; DO NOT PUT THIS FILE IN YOUR WEBROOT DIRECTORY. 
;
; *WARNING*
;
; Anyone can view your database password if you do!
;
debug 			= FALSE

;
;Database
;
db_type 		= "postgres7"
db_host			= "guzzi"
db_user			= "thalassotoque_gacl"
db_password		= "eng4iech2I"
db_name			= "thalassotoque"
db_table_prefix		= "gacl"

;
;Caching
;
caching			= FALSE
force_cache_expire	= TRUE
cache_dir		= "/tmp/phpgacl_cache"
cache_expire_time	= 600

;
;Admin interface
;
items_per_page 		= 100
max_select_box_items 	= 100
max_search_return_items = 200

;NO Trailing slashes
smarty_dir 		= "smarty/libs"
smarty_template_dir 	= "templates"
smarty_compile_dir 	= "templates_c"

