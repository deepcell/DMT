<?php
/**
 * Contains global variables for reference throughout the system.
 *
 * See the README file for configuration information.
 **/
error_reporting(E_ALL);
class globals {

	const baseFolder    = '/var/www/DMT';
	const dataFile      = '/var/www/DMT/daynum.dat';
	const footerFile    = '/var/www/DMT/footer.txt';
	const tokenFile     = '/var/www/DMT/token.dat';
	const checkInterval = 1;                           # The interval at which check-in e-mails should be sent. Most users will want to set this at around 5 to 7 days.
	const sendAfter     = 1;                           # The number of days to wait for check-in before releasing messages to recipients. 
													   # Need to be greater than `checkInterval`, ideally 3 to 4 times the `checkInterval` value to avoid unintentional misfires.
	const webPath       = 'https://<SERVER>/DMT';      # The full URL that corresponds to the location where DMT is installed.
	const ownerMail     = 'user@domain.com';           # The e-mail address to which check-in messages should go.
	const mailFrom      = 'deepcell@gmail.com';        # The `From:` address for all DMT e-mails.
	const subjectPrefix = 'DMT-Notification: ';        # The prefix for the `Subject:` line of all messages.

	// SMTP config - use your credentials here
	const smtpServer    = 'smtp.gmail.com';
	const smtpPort      = 465;                         # gmail uses port 465 with ssl.
	const smtpUser      = 'deepcell@gmail.com';
	const smtpPasswd    = '';
}
?>
