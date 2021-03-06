#!/bin/sh
. ../conf.ini
line=`sudo iptables -v -n -L --line-numbers -t mangle | grep "MAC $1"| head -n 1 | sed -e 's/\s.*$//'`
while [ "$line" != "" ]; do
    sudo iptables -D internet $line -t mangle
    line=`sudo iptables -v -n -L --line-numbers -t mangle | grep "MAC $1"| head -n 1 | sed -e 's/\s.*$//'`
done
sed -i "/$1/d" $BASE_PATH/utils/access
exit 0