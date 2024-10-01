<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <script src="" async defer></script>

        <form action="" method="post">
            Login : <input type="text" name="login"/>
            PassWd : <input type="password" name="pass"/>
            <input type="submit" name="connexion">
        </form>

        <?php

            try{

                $ipserver = "82.165.50.104/Pokecon";
                $nomBase = "PokeUsers";
                $loginPriv = "userweb";
                $passPriv = "userweb";

                $pdo = new PDO('mysql:host='.$ipserver.';dbname=Comba'.$nomBase.'', $loginPriv, $passPriv);

            } catch (Exception $error) {
                $error->getMessage();
            }

            if(isset($_POST['connexion'])){

                $RequetSql = "SELECT * FROM 'User' 
                    WHERE 'login' = '".$_POST['login']."' 
                    AND 'pass' = '".$_POST['pass']."' ;";
                
                $res = $pdo->query($RequetSql);

                if($res->rowCount()>0){
                    echo "oui";
                }else{
                    echo "non";
                }
            }

        ?>

    </body>
</html>