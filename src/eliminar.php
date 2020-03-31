<?php

    // Llamando a la libreria de MailChimp
    include('lib/mailchimp.php');

    use \DrewM\MailChimp\MailChimp;

    $api_key = 'aqui va el api';
    $list_id = 'aqui va el codigo de la lista';

    $MailChimp = new MailChimp($api_key);

    if( $_POST )
    {
        $email    = $_POST['email'];
        $newemail = $_POST['newemail'];
        $fname    = $_POST['fname'];
        $lname    = $_POST['lname'];
        $birthday = $_POST['birthday'];

        $subscriber_hash = MailChimp::subscriberHash($email);

        $result = $MailChimp->delete("lists/$list_id/members/$subscriber_hash", [
                        'email_address' => $email,
                        'merge_fields' =>     ['FNAME'=>$fname, 'LNAME'=>$lname, 'BIRTHDAY'=>$birthday],
                        'status'        => 'unsubscribed',
                    ]);
        
        if ($MailChimp->success()) {
            //print_r($result);	
            echo "<h3>Datos guardados</h3>";
        } else {
            echo "<h3>Un Error al enviar la informacion</h3>";
        }
    }