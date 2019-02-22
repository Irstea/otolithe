#!/bin/bash
# upgrade an instance 2.2.2 to 2.2.3
OLDVERSION=otolithe-2.2
VERSION=otolithe-2.2.1
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
if [ -e otolithe/param/otolithe ]
then
cp otolithe/param/otolithe* $VERSION/param/
chown www-data $VERSION/param/otolithe
fi

#replacement of symbolic link
rm -f otolithe
ln -s $VERSION otolithe

chmod 750 /var/www/html/otolithe

# assign rights to new folder
mkdir $VERSION/display/templates_c
chmod -R 750 $VERSION
chgrp -R www-data $VERSION

# update rights to specific software folders
chmod -R 770 $VERSION/display/templates_c
chmod -R 770 $VERSION/temp

echo "Upgrade completed. Check, in the messages, if unexpected behavior occurred during the process" 
fi
fi
