#!/bin/sh
. ../conf.ini
while read user mac time
do 
    if [ "$user" != "" ]; then
	now=$(date +%s)
	delta=$(($now-$time))
	if [ "$delta" -gt "14400" ]; then
	        /home/portal/rmaccess.sh $mac
		fi
    fi
done < /home/portal/access
sudo conntrack -D