<?php
/**
 * functions.php:
 * 
 * Contains assorted application functions.
 **/
require_once 'globals.php';


function sendMsg($toAddress,$msgFile) {
	/**
	* sendMsg:
	*
	* Sends $msgFile to $toAddress
	**/

	// Load the contents of $msgFile into $msgText
    $msgText = file_get_contents($msgFile);

	// If the defined footerFile exists, append it to $msgText
    if (file_exists(globals::footerFile)) {
        $msgText = $msgText.file_get_contents(globals::footerFile);
    };

	// Set up the headers
    $subject = globals::subjectPrefix.basename($msgFile);
    $fromAddress = 'From: '.globals::mailFrom;

	// Send the message
    #mail($toAddress,$subject,$msgText,$fromAddress);



	//---- Sendmail using SwiftMailer class ----//
	require_once '/var/www/DMT/vendor/autoload.php';
	// Create the Transport
	$transport = (new Swift_SmtpTransport(globals::smtpServer, globals::smtpPort, 'ssl'))->setUsername(globals::smtpUser)->setPassword(globals::smtpPasswd);

	// Create the Mailer using your created Transport
	$mailer = new Swift_Mailer($transport);

	// Create a message
	$message = (new Swift_Message('DMS Check-In Required'))->setFrom([globals::mailFrom => 'DMT'])->setTo([globals::ownerMail => 'FAPC'])->setBody($msgText);
	#echo "<pre>"; var_dump($message);

	// Send the message
	#$result = $mailer->send($message);
	#echo "<pre>"; var_dump($result);
	if ($mailer->send($message)) {
	    echo 'Mail sent successfully.';
	} else {
	    echo 'error: check your configuration.';
	}
	//---- Sendmail using SwiftMailer class ----//



}; // end function sendMsg


function getDay() {
	/**
	 * getDay:
	 * 
	 * Reads the day number from the daynum.dat file and increments by 1.
	 **/

	// Safety check - see if the file exists
        if (file_exists(globals::dataFile)) {
		// File exists, read it
                $dataFile=file(globals::dataFile);
                $dayNum=$dataFile[0];
        } else {
		// File does not exist, default to 0
		// We will create the file in writeDay()
                $dayNum = 0;
        }; // end safety check evaluation

	// return dayNum incremented by 1
        return (intval($dayNum,10)+1);
}; // end function getDay


function writeDay($dayNum) {
	/**
	* writeDay:
	* 
	* Writes the new $dayNum to the daynums.dat data file
	**/
	$fp = fopen(globals::dataFile,"w");
	fputs($fp,$dayNum);
	fclose($fp);
}; // end function writeDay


function getToken() {
	/**
	 * getToken:
	 * 
	 * Retrieves the current $token from tokens.dat
	 **/

	// Safety check - see if the file exists
        if (file_exists(globals::tokenFile)) {
		// File exists, read it
        $token = file(globals::tokenFile);
	} else {
		// Does not exist, use a default value
		$token['0'] = 0;
	}; // end sanity check evaluation

	// return the $token value
    return(intval($token['0'],10));
}; // end function getToken


function randomizeToken() {
	/**
	 * randomizeToken:
	 * 
	 * Create a new random token and place it in the token file.
	 **/

        $fp=fopen(globals::tokenFile,'w');
        fputs($fp,rand(1048576,134217728));
        fclose($fp);
}; // end function randomizeToken


function resetDayNum() {
	/**
	 * resetDayNum:
	 * 
	 * Reset daynum.dat back to default of 0
	 **/
        $fp=fopen(globals::dataFile,'w');
        fputs($fp,'0');
	fclose($fp);
}; // end function resetDayNum
?>