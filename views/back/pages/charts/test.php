<?php
$to='nahla.jemili@esprit.tn';
$subject='à propos de la reclamation';
$message='salut, je voulais plus de details';
$headers='from: njemili6@gmail.com';
if(mail($to,$subject,$message,$headers))
echo ("success");
else echo("failure");
?>