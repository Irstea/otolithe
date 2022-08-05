#!/bin/bash
# upgrade an instance 2.2.2 to 2.2.3
OLDVERSION=otolithe-2.3.0
VERSION=otolithe-2.4.0
echo "This script will install the release $VERSION"
echo "have you a backup of your database and a copy of param/param.inc.php?"
echo "Is your actual version of otolithe is $OLDVERSION ?"
echo "Is your actual version is in the folder /var/www/otolithe/$OLDVERSION, and the symbolic link otolithe point to $OLDVERSION?"
read -p "Do you want to continue [Y/n]?" answer
if [[ $answer = "y"  ||  $answer = "Y"  ||   -z $answer ]];
then
cd /var/www/html/otolithe
rm -f *zip
# download last code
echo "download software"
wget https://github.com/Irstea/otolithe/archive/master.zip
read -p "Ok to install this release [Y/n]?" answer

if [[  $answer = "y"  ||  $answer = "Y"  ||   -z $answer ]];
then

unzip master.zip
mv otolithe-master/ $VERSION

# copy of last param into the new code
cp otolithe/param/param.inc.php $VERSION/param/
chgrp www-data $VERSION/param/param.inc.php

# keys for tokens
if [ -e otolithe/param/id_otolithe ]
then
cp otolithe/param/id_otolithe* $VERSION/param/
chown www-data $VERSION/param/id_otolithe
fi

#replacement of symbolic link
rm -f otolithe
ln -s $VERSION otolithe

# upgrade database
echo "update database"
chmod 755 /var/www/html/otolithe
cd otolithe/install
su postgres -c "psql -f upgradedb-2.3-2.4.sql"
cd ../..
chmod 750 /var/www/html/otolithe

# assign rights to new folder
mkdir $VERSION/display/templates_c
mkdir img/
chmod -R 750 $VERSION
chgrp -R www-data $VERSION

# update rights to specific software folders
chmod -R 770 $VERSION/display/templates_c
chmod -R 770 $VERSION/img
# update php.ini file
PHPVER=`php -v|head -n 1|cut -c 5-7`
PHPINIFILE="/etc/php/$PHPVER/apache2/php.ini"
sed -i "s/; max_input_vars = .*/max_input_vars=$max_input_vars/" $PHPINIFILE
systemctl restart apache2
PHPOLDVERSION=`php -v|grep ^PHP|cut -d " " -f 2|cut -d "." -f 1-2`
echo "Your version of PHP is $PHPOLDVERSION. If it < 7.4, you must upgrade it with the script:"
echo "./php_upgrade.sh"

echo "Upgrade completed. Check, in the messages, if unexpected behavior occurred during the process"
fi
fi
