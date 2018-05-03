# DMT Script - For a world more anarchical and less hierarchical. #

---

## Description ##

DMT is free and is supposed to be used in a *nix environment. It requires a basic server with nginx and PHP and Swift wrapper as a basic e-mail sending.

DMT sends a "check-in" e-mail to a configured e-mail address at a specified interval, with a link to click to reset a counter.  The counter is incremented by 1 with each call of the script (which should mean once daily).  When clicked, the counter resets to 0.

Once a specified number of days have passed without a check-in, the check-in e-mails are suppressed and the system begins sending messages to designated recipients.

E-mails are in plain text format.  No special databases are required.

---

## License ##

It's free to use and free to redistribute.

---

## Installation ##

To install DMT, unzip the distribution to a folder on your web server and run the `start.sh`. Have sure the folder `data/` exists and has the appropriate permissions to be readable by your web server.

---

## Configuration ##

All configuration variables is with `globals.php` file. This is the only file most users will need to edit. There is the configuration values:

`baseFolder`:     The full path to the installation directory.

`dataFile`:       The full path and filename of the `daynum.dat` file.

`footerFile`:     The full path and filename of the `footer.txt` file.

`tokenFile`:      The full path and filename of the `token.dat` file.

`checkInterval`:  The interval at which check-in e-mails should be sent.  Most users will want to set this at around 5 to 7 days.

`sendAfter`:      The number of days to wait for check-in before releasing messages to recipients.  Can be anything greater than `checkInterval`, but ideally should be 3 to 4 times the `checkInterval` value to avoid unintentional misfires.
                  
`webPath`:        The full web address that corresponds to the location where DMT is installed.

`ownerMail`:      The e-mail address to which check-in messages should go.

`mailFrom`:       The `From:` address for all DMT e-mails.

`subjectPrefix`:  The prefix for the `Subject:` line of all messages.

---

## Message Folder Structure ##

The messages must be organized into folders by recipient e-mail address, and then by sending day. The sending day is the number of days beyond the sendAfter value in `globals.php`.

A file called `data/your@email/0/message.txt` will be sent to your@email on the `sendAfter` date.

A file called `data/your@email/7/message.txt` will be sent to your@email 7 days after the `sendAfter` date.

There is no limit for files to be created under the numbered folder.

The numbered folders have to be named as a base 10 integer value.

---

## How to use DMT? ##

Create a folder called `data/` and another folder inside data and name it with your own e-mail address, then run the script `run.php`.  After your test is done, remember to delete your test folder, and reset both the `daynum.dat` and `token.dat` files to their initial values of `0` by running the `start.sh` script.

---

## Security Considerations ##

Encrypt the message contents as an ASCII-armored GnuPG file, using a command:

    /usr/bin/gpg -r user@domain.tld --armor --encrypt message.txt

If you are using Apache you may want to secure the `checkin.php` file using `.htaccess` restrictions which require authentication against an `.htpasswd` file.  Check the `.htaccess` file included in this distribution.

---


This script is based on PHP Dead Man's Script (PHP-DMS)
version 1.1  
Released on 04-Jan-2014  
<http://scrow.sdf.org/php-dms/>  


SCP
	copy the entire folde Download located in your local machine to the remote server.
		scp -v -r ~/Downloads root@192.168.1.3:/root/Downloads
