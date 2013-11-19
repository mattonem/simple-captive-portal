#!/bin/sh
. ../conf.ini
while read user mac time
do 
    if [ "$user" != "" ]; then
	now=$(date +%s)
	delta=$(($now-$time))
	if [ "$delta" -gt "14400" ]; then
	        $BASE_PATH/utils/rmaccess.sh $mac
	fi
    fi
done < $BASE_PATH/access
sudo conntrack -D