<?php
require('recaptcha-master/src/autoload.php');

/* ReCaptch Secret */
//$recaptchaSecret = '<!-- Put Your reCaptcha Secret Key -->';
//LOCAL
//$recaptchaSecret = '6LdMY7QdAAAAAPO5_eeI3Gp9r2Z_URSaLaOK-HtO';
//clave sitio web - 6LdMY7QdAAAAAJZymZiZjADP0PA01Wp4w1dO4Ybe
//clave secreta - 6LdMY7QdAAAAAPO5_eeI3Gp9r2Z_URSaLaOK-HtO
//HEROKU
$recaptchaSecret = '6LdUZ7QdAAAAAJ94hDQ7FAvZ9RCw4QdOYyl7JUL6';
//clave sitio web - 6LdUZ7QdAAAAALxSRLxUnaYlJ-epveqQNyKdug1a
//clave secreta - 6LdUZ7QdAAAAAJ94hDQ7FAvZ9RCw4QdOYyl7JUL6

//FOR TEST PURPOSE
//Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
//Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe

$dzEmailTo 		= "fide94@gmail.com";   /* Receiver Email Address */
$dzEmailFrom    = "La Posta";

function pr($value)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}

try {
    if (!empty($_POST)) {

        /* validate the ReCaptcha, if something is wrong, we throw an Exception,
			i.e. code stops executing and goes to catch() block */
        
        if (!isset($_POST['g-recaptcha-response'])) {
            $dzRes['status'] = 0;
			$dzRes['msg'] = 'ReCaptcha is not set.';
			echo json_encode($dzRes);
			exit;
        }

        /* do not forget to enter your secret key from https://www.google.com/recaptcha/admin */
        
        $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
        
        /* we validate the ReCaptcha field together with the user's IP address */
        
        $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if (!$response->isSuccess()) {
            $dzRes['status'] = 0;
			$dzRes['msg'] = 'ReCaptcha was not validated.';
			echo json_encode($dzRes);
			exit;
        }
        
		#### Contact Form Script ####
		if($_POST['dzToDo'] == 'Contact')
		{
			$dzName = trim(strip_tags($_POST['dzName']));
			$dzEmail = trim(strip_tags($_POST['dzEmail']));
			$dzMessage = strip_tags($_POST['dzMessage']);	
			$dzRes = "";
			if (!filter_var($dzEmail, FILTER_VALIDATE_EMAIL)) 
			{
				$dzRes['status'] = 0;
				$dzRes['msg'] = 'Wrong Email Format.';
			}
			$dzMailSubject = 'La Posta|Formulario de contacto: Alguien lo contacto desde la página web';
			$dzMailMessage	= 	"
								Una persona quiere contactarlo: <br><br>
								Name: $dzName<br/>
								Email: $dzEmail<br/>
								Message: $dzMessage<br/>
								";
								
			$dzOtherField = "";
			if(!empty($_POST['dzOther']))
			{
				$dzOther = $_POST['dzOther'];
				$message = "";
				foreach($dzOther as $key => $value)
				{
					$fieldName = ucfirst(str_replace('_',' ',$key));
					$fieldValue = ucfirst(str_replace('_',' ',$value));
					$dzOtherField .= $fieldName." : ".$fieldValue."<br>";
				}
			}
			$dzMailMessage .= $dzOtherField; 
								
			$dzEmailHeader  	= "MIME-Version: 1.0\r\n";
			$dzEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
			$dzEmailHeader 		.= "From:$dzEmailFrom <$dzEmail>";
			$dzEmailHeader 		.= "Reply-To: $dzEmail\r\n"."X-Mailer: PHP/".phpversion();
			if(mail($dzEmailTo, $dzMailSubject, $dzMailMessage, $dzEmailHeader))
			{
				$dzRes['status'] = 1;
				$dzRes['msg'] = 'Hemos recibido su mensaje. Gracias por contactarnos.';
			}
			else
			{
				$dzRes['status'] = 0;
				$dzRes['msg'] = 'Surgió un problema al enviar el mensaje, intente de nuevo.';
			}
			echo json_encode($dzRes);
			exit;
		}
		#### Contact Form Script End ####
		
		#### Appointment Form Script ####
		if($_POST['dzToDo'] == 'Appointment')
		{
			$dzName = trim(strip_tags($_POST['dzName']));
			$dzEmail = trim(strip_tags($_POST['dzEmail']));
			$dzMessage = strip_tags($_POST['dzMessage']);	
			$dzRes = "";
			if(!filter_var($dzEmail, FILTER_VALIDATE_EMAIL)) 
			{
				$dzRes['status'] = 0;
				$dzRes['msg'] = 'Wrong Email Format.';
				echo json_encode($dzRes);
				exit;
			}
			
			$dzMailSubject = 'La Posta|Formulario de contacto: Alguien lo contacto desde la página web';
			$dzMailMessage	= 	"
								Una persona quiere contactarlo: <br><br>
								Name: $dzName<br/>
								Email: $dzEmail<br/>
								Message: $dzMessage<br/>
								";
			/*			
			$dzMailSubject = 'GardenZone|Appointment Form: A Person want to contact';
			$dzMailMessage	= 	"
								A person want to contact you: <br><br>
								Name: $dzName<br/>
								Email: $dzEmail<br/>
								Message: $dzMessage<br/>
								";
			*/
			$dzOtherField = "";
			if(!empty($_POST['dzOther']))
			{
				$dzOther = $_POST['dzOther'];
				$message = "";
				foreach($dzOther as $key => $value)
				{
					$fieldName = ucfirst(str_replace('_',' ',$key));
					$fieldValue = ucfirst(str_replace('_',' ',$value));
					$dzOtherField .= $fieldName." : ".$fieldValue."<br>";
				}
			}
			$dzMailMessage .= $dzOtherField; 
			
			$dzEmailHeader  	= "MIME-Version: 1.0\r\n";
			$dzEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
			$dzEmailHeader 		.= "From:$dzEmailFrom <$dzEmail>";
			$dzEmailHeader 		.= "Reply-To: $dzEmail\r\n"."X-Mailer: PHP/".phpversion();
			if(mail($dzEmailTo, $dzMailSubject, $dzMailMessage, $dzEmailHeader))
			{
				$dzRes['status'] = 1;
				//$dzRes['msg'] = 'We have received your message successfully. Thanks for Contact.';
				$dzRes['msg'] = 'Hemos recibido su mensaje. Gracias por contactarnos.';

			}
			else
			{
				$dzRes['status'] = 0;
				//$dzRes['msg'] = 'Some problem in sending mail, please try again later.';
				$dzRes['msg'] = 'Surgió un problema al enviar el mensaje, intente de nuevo.';
			}
			echo json_encode($dzRes);
			exit;
		}	
		#### Appointment Form Script End ####
		
	}
} catch (\Exception $e) {
    $dzRes['status'] = 0;
	$dzRes['msg'] = $e->getMessage().'Surgió un problema al enviar su mensaje, intente más tarde.';
	echo json_encode($dzRes);
	exit;
}

?>