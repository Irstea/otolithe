# otolithe
Otolith is an application which allows you to place points referenced XY on photos to calculate specific indicators. It was designed specifically to analyze specific parts of fish, such as otoliths (ear bones), but can also be used to treat scaly, or possibly also of fin rays.

The code of version 2.0 has been desposited from Agence pour la Protection des Programmes under the number IDDN.FR.001.440010.000.S.C.2018.000.20900

For install this software:
- install a linux server (Ubuntu or Debian)
- download install/deploy_new_instance.sh
- verify the content of the script, particulary the variable phpinifile (version of php). It must be 7.2 or above.
- execute this script : it will install all necessary packages, create the database, etc.
- edit the file /etc/apache2/sites-available/otolithe.conf and adapt it to your configuration
- reload apache server

For upgrade:
- backup your database
- if  the database is in the same server than the application, go to the folder https://github.com/Irstea/otolithe/install and download with wget the script corresponding to your version (example: upgrade-2.2-2.3.0.sh to upgrade from version 2.2. to version 2.3.0)
- execute this script.
- if your database and your application is not in the same server, adapt the script.

A manual of installation and usage is available in french at https://github.com/Irstea/otolithe/raw/master/database/documentation/otolithe_documentation.pdf
