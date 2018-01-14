# Dumbluck

Dumb luck trying with bitcoin private keys and wallet addresses generation.

The Script is designed to randomly generate Bitcoin private keys and test corresponding wallets for any balance.
Actually, anyone running rigs and mining farms can install the script for possible bonus discovery of a non-empty wallet.

It is necessary to note, that generating an address doesn't touch the network at all. You'd only be wasting your CPU resources and disk space. 
Also, a collision is highly unlikely. 
Keys are 256 bit in length and are hashed in a 160 bit address.(2^160th power). 
Divide it by the world population and you have about 215,000,000,000,000,000,000,000,000,000,000,000,000 addresses per capita.(2.15 x 10^38)
However, there is still a miserable chance of winning the lottery - miracle does happen sometimes!

Dependencies: 
- PHP enabled webserver;
- BitWasp\Bitcoin library;
- http://Blockchain.info/address/... engine availability for checking balances.

Donations welcomed: 1PfWcDasQY8yzLfQwW31y2ZJxXv22rYCvZ
