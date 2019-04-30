<?php

include "C:/wamp64/www/back/pages/config.php";

PHPMailer    class UserC
    {

        public function __construct()
        {
            //1- creer une instance de la classe config
            $this->db=new config();
            //2-faire la cnx avec la base de donnée
            $this->db=$this->db->getCnx();
        }

        public function creerUser(User $user)
        {

            $query = "INSERT INTO `user`(`cin`, `username`, `password`, `role`, `email`, `numero`, `nom`, `prenom`, 
                                        `date_nais`, `region`, `ville`, `codePostal`,`token`, `enabled`, `sexe`) 
                                  VALUES (:cin,:usn,:pwd, :role, :email, :num , :nom , :prenom, :dateN, :region,
                                        :ville, :code, :token, :enabled, :sexe)";
            
            try {
                $req=$this->db->prepare($query);


                $req->bindValue(':cin',$user->getCin());
                $req->bindValue(':usn',$user->getUsername());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':role',$user->getRole());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':num',$user->getNumero());
                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':dateN',$user->getDateNaissance());
                $req->bindValue(':region',$user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':token',$user->getToken());
                $req->bindValue(':enabled',0);
                $req->bindValue(':sexe',$user->getSexe());

                $req->execute();


            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }   
        }
        public function generateToken(){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 20; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        public function verifierUniqueCin(User $user)
        {
            $query = "SELECT * FROM user where cin = :cin";
            $req=$this->db->prepare($query);

            $req->execute(['cin' => $user->getCin()]);
            return $req->fetch();
        }
        public function verifierUniqueEmail(User $user)
        {
            $query = "SELECT * FROM user where email= :email";
            $req=$this->db->prepare($query);

            $req->execute(['email' => $user->getEmail()]);
            return $req->fetch();
        }
        public function verifierUniqueUsername(User $user)
        {
            $query = "SELECT * FROM user where username= :usn";
            $req=$this->db->prepare($query);

            $req->execute(['usn' => $user->getUsername()]);
            return $req->fetch();
        }
        public function verifierUniqueNumero(User $user)
        {
            $query = "SELECT * FROM user where numero= :num";
            $req=$this->db->prepare($query);

            $req->execute(['num' => $user->getNumero()]);
            return $req->fetch();
        }
        public function activateAccount($cin,$token)
        {
            $query = "SELECT * FROM  user where cin= :cin AND token= :token AND enabled =0";
            $req = $this->db->prepare($query);
            $req->execute(['cin' => $cin , 'token' => $token]);
            $result = $req->fetch();

            if($result)
            {
                $sql = "UPDATE user set enabled= :enabled, token= :token WHERE cin= :cin";
                $req=$this->db->prepare($sql);
                $req->bindValue(':enabled',1);
                $req->bindValue(':token', '');
                $req->bindValue(':cin',$cin);
                $req->execute();
                return true;
            }
            return false;
        }
        public function seConnecter($username, $email, $password)
        {
            $query = "SELECT id,email,nom,prenom,enabled,token,username,role FROM user where email = :email AND password = :pwd  OR username = :username AND password = :pwd2 limit 1";
            $req=$this->db->prepare($query);
            $req->execute(['pwd' => $password, 'pwd2' => $password , 'email' => $email , 'username' => $username]);
            $result =  $req->fetch();

            $array = null;
            if($result)
                $array = array_filter($result);

            if($result)
            {
               if(array_key_exists("enabled" , $array))
                   return $result;

                else
                   return "disabled";
            }
            return "error";
        }
        public function connected($id)
        {
            $sql = "SELECT * FROM user WHERE id=".$id;
            $result = $this->db->query($sql)->fetch();
            return $result;
        }
        public function updateProfile($id, User $user)
        {
            $sql = "UPDATE user SET nom= :nom, prenom= :prenom, email= :email , password= :pwd , 
                                    region= :region , ville= :ville, codePostal= :code, numero= :num , 
                                    photo= :im where id= :id";

            try{
                $req = $this->db->prepare($sql);

                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':region', $user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':num',$user->getNumero());
                $req->bindValue(':im',$user->getPhoto());
                $req->bindValue(':id',$id);

                return $req->execute();
            }catch (Exception $e)
            {
                var_dump($e->getMessage());
            }

        }
        public function getClients()
        {
            $sql = "SELECT * from user where role=17";
            $clients =$this->db->query($sql);
            return $clients;
        }
        public function getTechnicien()
        {
            $sql = "SELECT * from user where role=13";
            $clients =$this->db->query($sql);
            return $clients;
        }
        public function getLivreur()
        {
            $sql = "SELECT * from user where role=14";
            $clients =$this->db->query($sql);
            return $clients;
        }
        public function getAdmin()
        {
            $sql = "SELECT * from user where role=16";
            $clients =$this->db->query($sql);
            return $clients;
        }
        public function creerLivreur(User $user)
        {

            $query = "INSERT INTO `user`(`cin`, `password`, `username`, `role`, `email`, `nom`, `prenom`, 
                                        `date_nais`, `region`, `ville`, `codePostal`, `enabled`, `sexe`,
                                        `dateDebutContrat`, `dateFinContrat`, `disponibilite`, `degree`) 
                                  VALUES (:cin , :pwd , :usn , :role , :email , :nom , :prenom , :date , :region ,
                                        :ville , :code , :enabled , :sexe , :deb , :fin , :dis , :degree); ";


             $req=$this->db->prepare($query);



            try{
                $req->bindValue(':cin',$user->getCin());
                $req->bindValue(':usn',$user->getUsername());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':role',$user->getRole());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':date',$user->getDateNaissance());
                $req->bindValue(':region',$user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':enabled',$user->getEnabled());
                $req->bindValue(':sexe',$user->getSexe());
                $req->bindValue(':deb',$user->getDateDebutContrat());
                $req->bindValue(':fin',$user->getDateFinContrat());
                $req->bindValue(':dis',$user->getDisponibilite());
                $req->bindValue(':degree',$user->getDegree());

                $req->execute();

            }catch(Exception $e)
            {
                var_dump("error debug : " .$e->getMessage() );
            }

        }
        public function creerTechnicien(User $user)
        {

            $query = "INSERT INTO `user`(`cin`, `password`, `username`, `role`, `email`, `nom`, `prenom`, 
                                        `date_nais`, `region`, `ville`, `codePostal`, `enabled`, `sexe`,
                                        `dateDebutContrat`, `dateFinContrat`, `disponibilite`, `degree`) 
                                  VALUES (:cin , :pwd , :usn , :role , :email , :nom , :prenom , :date , :region ,
                                        :ville , :code , :enabled , :sexe , :deb , :fin , :dis , :degree); ";


            $req=$this->db->prepare($query);



            try{
                $req->bindValue(':cin',$user->getCin());
                $req->bindValue(':usn',$user->getUsername());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':role',$user->getRole());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':date',$user->getDateNaissance());
                $req->bindValue(':region',$user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':enabled',$user->getEnabled());
                $req->bindValue(':sexe',$user->getSexe());
                $req->bindValue(':deb',$user->getDateDebutContrat());
                $req->bindValue(':fin',$user->getDateFinContrat());
                $req->bindValue(':dis',$user->getDisponibilite());
                $req->bindValue(':degree',$user->getDegree());

                $req->execute();

            }catch(Exception $e)
            {
                var_dump("error debug : " .$e->getMessage() );
            }

        }
        public function chercherLivreur($email)
        {
            $query = "SELECT * FROM user where role=14 AND email='".$email."'";
           // $req=$this->db->prepare($query);
            $employes=$this->db->query($query);
            return $employes;
        }
        public function chercherTechnicien($email)
        {
            $query = "SELECT * FROM user where role=13 AND email='".$email."'";
            // $req=$this->db->prepare($query);
            $employes=$this->db->query($query);
            return $employes;
        }
        public function chercherAdmin($email)
        {
            $query = "SELECT * FROM user where role=16 AND email='".$email."'";
            // $req=$this->db->prepare($query);
            $employes=$this->db->query($query);
            return $employes;
        }
        public function deleteUser($id)
        {
            $sql="delete from user where id=".$id;
            $this->db->exec($sql);
        }
        public function updateEmploye($id, User $user)
        {
            $sql = "UPDATE user SET nom= :nom, prenom= :prenom, email= :email , 
                                    region= :region , ville= :ville, codePostal= :code , date_nais= :daten, 
                                    `dateDebutContrat`= :deb , `dateFinContrat` = :fin , password= :pwd,
                                    `degree` = :deg where id= :id";

            try{
                $req = $this->db->prepare($sql);

                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':region', $user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':daten',$user->getDateNaissance());
                $req->bindValue(':deb',$user->getDateDebutContrat());
                $req->bindValue(':fin',$user->getDateFinContrat());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':deg',$user->getDegree());
                $req->bindValue(':id',$id);


                $res = $req->execute();

            }catch (Exception $e)
            {
                var_dump($e->getMessage());
            }
        }
        public function getEmployer($id)
        {
            $sql = "SELECT * FROM user WHERE id=".$id;
            $result = $this->db->query($sql)->fetch();
            return $result;
        }
        public function blockUser($id)
        {
            $sql = "UPDATE user set enabled= :enabled, token= :token WHERE id= :id";
            $req=$this->db->prepare($sql);
            $req->bindValue(':enabled',0);
            $req->bindValue(':token',"");
            $req->bindValue(':id',$id);
            $req->execute();
        }
        public function unBlockUser($id)
        {
            $sql = "UPDATE user set enabled= :enabled, token= :token WHERE id= :id";
            $req=$this->db->prepare($sql);
            $req->bindValue(':enabled',1);
            $req->bindValue(':token',"");
            $req->bindValue(':id',$id);
            $req->execute();
        }
        public function creerAdmin(User $user)
        {
            $query = "INSERT INTO `user`(`cin`, `password`, `username`, `role`, `email`, `nom`, `prenom`, 
                                        `date_nais`, `region`, `ville`, `codePostal`, `enabled`, `sexe`) 
                                  VALUES (:cin , :pwd , :usn , :role , :email , :nom , :prenom , :daten , :region ,
                                        :ville , :code , :enabled , :sexe); ";


            $req=$this->db->prepare($query);



            try{
                $req->bindValue(':cin',$user->getCin());
                $req->bindValue(':usn',$user->getUsername());
                $req->bindValue(':pwd',$user->getPassword());
                $req->bindValue(':role',$user->getRole());
                $req->bindValue(':email',$user->getEmail());
                $req->bindValue(':nom',$user->getNom());
                $req->bindValue(':prenom',$user->getPrenom());
                $req->bindValue(':daten',$user->getDateNaissance());
                $req->bindValue(':region',$user->getRegion());
                $req->bindValue(':ville',$user->getVille());
                $req->bindValue(':code',$user->getCodePostal());
                $req->bindValue(':enabled',$user->getEnabled());
                $req->bindValue(':sexe',$user->getSexe());

                $req->execute();

            }catch(Exception $e)
            {
                var_dump("error debug : " .$e->getMessage() );
            }

        }
        public function passwordForgot($email)
        {
            $query = "SELECT * FROM client where email= :email";
            $req=$this->db->prepare($query);
            $req->execute(['email' => $email]);
            $res = $req->fetchAll();
            if($res)
            {
                $sql = "UPDATE client set enabled= :enabled, token= :token WHERE email= :email";
                $sql2=$this->db->prepare($sql);
                $token = $this->generateToken();
                $url = 'http://localhost/snowboarding/reset.php?mail='.$email.'&token='.$token;
                $send = 'Veuillez cliquer sur ce  <a href='.$url.'>lien</a> afin de réinitialiser votre compte';
                $this->sendEmail($email,$send);
                $sql2->bindValue(':enabled',0);
                $sql2->bindValue(':token',$token);
                $sql2->bindValue(':email',$email);
                $sql2->execute();

            }
            return $res;
        }
        public function verifyUrl($token,$email)
        {
            $query = "SELECT * FROM  user where email= :email AND token= :token";
            $req = $this->db->prepare($query);
            $req->execute(['email' => $email , 'token' => $token]);
            return $req->fetchAll();
        }
        public function sendEmail($email,$send)
        {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML(true);
            $mail->Username = 'ahmed.bannour@esprit.tn';
            $mail->Password = 'rcop1g1337';
            $mail->setFrom("no-reply@esprit.tn");
            $mail->Subject = "Best Medical";
            $mail->Body = $send;
            $mail->AddAddress($email);
            $mail->send();
        }
        public function resetPassword($password,$email)
        {
            $sql = "UPDATE user set enabled= :enabled, token= :token, password= :pwd WHERE email= :email";
            $req=$this->db->prepare($sql);
            $req->bindValue(':enabled',1);
            $req->bindValue(':token',"");
            $req->bindValue(':pwd',$password);
            $req->bindValue(':email',$email);
            $req->execute();
        }
    }

?>