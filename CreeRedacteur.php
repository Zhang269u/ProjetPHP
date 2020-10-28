<?php
require_once ('Connexion.php');
error_reporting(E_ALL ^E_NOTICE);

?>
<html>
<script language=" javascript " type="text/javascript">
    function checkEmail(email)
    {
        //regex pour ladresse mail
        var regex2= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex2.test(email);
    }
    function checkNom(nom)
    {
        //regex pour nom et prenom
        var regex1= /^[A-z]+[\-']?[[a-z]+[\-']?]*[a-z]+$/;

        return regex1.test(nom);
    }

    function checkPrenom(prenom)
    {
        //regex pour nom et prenom
        var regex1= /^[A-z]+[\-']?[[a-z]+[\-']?]*[a-z]+$/;

        return regex1.test(prenom);
    }
    function checkPassword(password,password2)
    {
        return password==password2;
    }
    function validate() {
        var email = document.getElementById("email").value;
        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var password = document.getElementById("password").value;
        var confirmpassword = document.getElementById("confirmpassword").value;
        var valid=true;
        if (!checkNom(nom)) {
            alert('nom non valide');
            valid=false;
        }
        if (!checkPrenom(prenom)) {
            alert('prenom non valide');
            valid=false;
        }
        if (!checkEmail(email)) {
            alert('Adresse e-mail non valide');
            valid=false;
        }
        if(!checkPassword(password,confirmpassword)){
            alert('Mot de passe different ou non rempli');
            valid=false;
        }
        return valid;
    }
</script>
    <body>
    <?php
    $Terreur=[];

    if(isset($_POST['Valider'])){
        $valid = '<script type="text/javascript">document.write(validate());</script>';
        $Terreur['nom']='A saisir';
        $nom='';
        if(isset($_POST['nom'])){
            $nom=$_POST['nom'];
            if(!empty(trim($nom)))
                $Terreur['nom']='';
        }

        $Terreur['prenom']='A saisir';
        $prenom='';
        if(isset($_POST['prenom'])){
            $prenom=$_POST['prenom'];
            if(!empty(trim($prenom)))
                $Terreur['prenom']='';
        }

        $Terreur['email']='A saisir';
        $email='';
        if(isset($_POST['email'])){
            $email=$_POST['email'];
            if(!empty(trim($email)))
                $Terreur['email']='';
        }

        $Terreur['password']='A saisir';
        $password='';
        if(isset($_POST['password'])){
            $password=$_POST['password'];
            if(!empty(trim($password))){
                $confirmpassword='';
                if(isset($_POST['confirmpassword'])) {
                    $confirmpassword = $_POST['confirmpassword'];
                    if ($password == $confirmpassword)
                        $Terreur['password'] = '';
                    else
                        $Terreur['password'] = 'Les mots de passe sont différent';
                }
            }
        }

        if($Terreur['nom']=='' && $Terreur['prenom']=='' && $Terreur['email']=='' && $Terreur['password']==''){
            echo 'haha';
            $insert_stmt = $objPdo->prepare('INSERT INTO redacteur (nom, prenom, adressemail, motdepasse) VALUES (?,?,?,?)');
            $insert_stmt->bindValue(1, $nom, PDO::PARAM_STR);
            $insert_stmt->bindValue(2, $prenom, PDO::PARAM_STR);
            $insert_stmt->bindValue(3, $email, PDO::PARAM_STR);
            $insert_stmt->bindValue(4, $password, PDO::PARAM_STR);
            $insert_stmt->execute();
            header("Location:News.php");
        }

    }
    ?>
        <h1>Saisie des Informations du Redacteur</h1>
        <form method='post' action=''>
            <label for='nom'>Nom :</label>
            <input id='nom' name='nom' type='text' value=<?php echo $nom ?>><span style='color:red'><?php echo $Terreur['nom'] ?></span>
            <br><br>
            <label for='prenom'>Prenom :</label>
            <input id='prenom' name='prenom' type='text' value=<?php echo $prenom ?>><span style='color:red'><?php echo $Terreur['prenom'] ?></span>
            <br><br>
            <label for='email'>Adresse Mail :</label>
            <input id='email' name='email' type='text' value=<?php echo $email ?>><span style='color:red'><?php echo $Terreur['email'] ?></span>
            <br><br>
            <label for='password'>Password :</label>
            <input id='password' name='password' type='password'><span style='color:red'><?php echo $Terreur['password'] ?></span>
            <br><br>
            <label for='confirmpassword'>Confirm Password :</label>
            <input id='confirmpassword'  name='confirmpassword' type="password">
            <br><br>
            <input type='submit' id='Valider' name="Valider" value="Ajouter" onclick="validate()">
        </form>
    </body>
</html>