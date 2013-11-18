#!/bin/bash
sudo iptables -I internet 1 -t mangle -m mac --mac-source $1 -j RETURN
echo -e "$2\t$1\t$(date +%s)" >> /home/portal/access
echo -e "$2\t$1\t$(date +%a-%d-%m-%Y//%Hh%M)" >> /home/portal/access.log
exit 0