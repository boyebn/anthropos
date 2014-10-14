<?php
	
	##### Mail functions #####
	
	function sendLostPasswordEmail($username, $email, $newpassword)
	{
		$message = "
		Du er registrert med et nytt passord i studentmedienes medlemsdatabase.
		
		Ny registrert informasjon:
		
		Brukernavn: $username
		Passord: $newpassword
		
		For å endre passord, logg inn med informasjonen over på www.bruker.smint.no
		
		Vet du ikke hva dette er, eller hvorfor du får den, vennligst ta kontakt med bruker@studentmediene.no så raskt som mulig.
		
		Vennlig hilse,
		IT-Drift
		Studentmediene i Trondheim
		";
		
		if (sendMail($email, "Ditt passord har blitt tilbakestilt.", $message, "bruker@studentmediene.no"))
		{
			return true;
		} else
		{
			return false;
		}
	}
	
	function sendMail($to, $subject, $message, $from)
	{
		$from_header = "From: $from";
		
		if (mail($to, $subject, $message, $from_header))
		{
			return true;
		} else
		{
			return false;
		}
	}
	
?>