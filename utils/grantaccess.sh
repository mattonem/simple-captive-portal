#!/bin/sh
. ../conf.ini
sudo iptables -I internet 1 -t mangle -m mac --mac-source $1 -j RETURN
echo -e "$2\t$1\t$(date +%s)" >> $BASE_PATH/access
echo -e "$2\t$1\t$(date +%a-%d-%m-%Y//%Hh%M)" >> $BASE_PATH/access.log
exit 0