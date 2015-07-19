# diskperformance
Web interface to test performance disk (hdparm, dd)

Dependances : 
-------------
sudo, hdparm, dd


Install :
---------
clone the repo into your www directory
chown www-data:www-data diskperformance/log (change if www-data is not your apache user)
create a file ; /etc/sudoers.d/diskperformance and put it this line :
www-data ALL = NOPASSWD: /sbin/hdparm -t *