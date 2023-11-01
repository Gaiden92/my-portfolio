<?php
//Configuration email et prenom expediteur
$email_expediteur = 'samy_fouchal@sami-fouchal.fr';
$prenom_expediteur = 'contact sami-fouchal.fr';

//Destinataire email
$destinataire = "samy_fouchal@hotmail.fr";

//copie
$copie = 'non';

// Messages de confirmation du mail
$message_envoye = "<p>Votre message nous est bien parvenu !</p>";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

//Traitement du formulaire
if(!isset($_POST['envoi'])){
    
	// formulaire non envoyé
	echo '<p>'.$message_erreur_formulaire.'</p>'."\n";
}
    else{
        function rec($text){
           $text = htmlspecialchars(trim($text), ENT_QUOTES); 
                if(1 === stripslashes($text)){
            $text = stripslashes($text);
                }
            $text = nl2br($text);
            return $text;
            };

           function isEmail($email){
            $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
            return (($value === 0) || ($value === false)) ? false : true;
           }


        $nom = (isset($_POST["nom"]) ? rec($_POST["nom"]) : '');
        $email = (isset($_POST['email']) ? rec($_POST["email"]) : '');
        $objet = (isset($_POST['objet']) ? rec($_POST['objet']) : '');
        $message = (isset($_POST["message"]) ? rec($_POST["message"]) : '');

        // Vérification variables et l'email
        if(($nom != '') && ($email != '') && ($objet != '') && ($message != '')){
                // les 4 variables sont remplies, on génère puis envoie le mail
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'From:'.$nom_expediteur.' <'.$email_expediteur.'>' . "\r\n" .
                    'Reply-To:'.$email. "\r\n" .
                    'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
                    'Content-Disposition: inline'. "\r\n" .
                    'Content-Transfer-Encoding: 7bit'." \r\n" .
                    'X-Mailer:PHP/'.phpversion();
            if($copie = 'oui'){
                $cible = $destinataire . ";" . $email;
            } else {
                $cible = $destinataire;
                };

        //remplacement caractére spéciaux 
        $caracteres_speciaux     = array('&#039;', '&#8217;', '&quot;', '<br>', '<br />', '&lt;', '&gt;', '&amp;', '…',   '&rsquo;', '&lsquo;');
		$caracteres_remplacement = array("'",      "'",        '"',      '',    '',       '<',    '>',    '&',     '...', '>>',      '<<'     );
 
		$objet = html_entity_decode($objet);
		$objet = str_replace($caracteres_speciaux, $caracteres_remplacement, $objet);
        
        $message = html_entity_decode($message);
        $message = str_replace($caracteres_speciaux, $caracteres_remplacement, $message);

        //Envoie du mail
        $cible = str_replace(',', ';', $cible); // antibug : j'ai vu plein de forums où ce script était mis, les gens ne font pas attention à ce détail parfois
        $num_emails = 0;
        
        $tmp = explode(';', $cible);
        foreach($tmp as $email_destinataire){
            if (mail($email_destinataire, $objet, $message, $headers))
				$num_emails++;
            }
            if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
		    {
			echo '<p>'.$message_envoye.'</p>';
		    } else {
			echo '<p>'.$message_non_envoye.'</p>';
		    };

        } else {
            $champ_vide = "Un des champs n'a pas était complété. Merci de remplir tous les champs.";
                // une des 3 variables (ou plus) est vide ...
            echo '<p class="messagevide">' . $champ_vide . ' <a href="https://www.sami-fouchal.fr">Retour au formulaire</a></p>'."\n";
            };
        

};
?>