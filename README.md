# otolithe
Otolith is an application which allows you to place points referenced XY on photos to calculate specific indicators. It was designed specifically to analyze specific parts of fish, such as otoliths (ear bones), but can also be used to treat scaly, or possibly also of fin rays.

The code of version 2.0 has been desposited from Agence pour la Protection des Programmes under the number IDDN.FR.001.440010.000.S.C.2018.000.20900

For install this software:
- install a linux server (Ubuntu or Debian)
- download install/deploy_new_instance.sh
- verify the content of the script, particulary the variable phpinifile (version of php). It may be 7.2 for Ubuntu 18.04.
- execute this script : it will install all necessary packages, create the database, etc.
- edit the file /etc/apache2/sites-available/otolithe.conf and adapt it to your configuration
- reload apache server
