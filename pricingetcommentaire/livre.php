<?php 
require_once 'class/Message.php';
require_once 'class/GeustBook.php';
$errors = null;
$succes = false;
$GeustBook = new GeustBook(__DIR__ . DIRECTORY_SEPARATOR . 'data/messages');
if(isset($_POST['username']) && isset($_POST['message'])){
    $Message = new Message($_POST['message'],$_POST['username']);
    if( $Message->isvalid()){
        $GeustBook->addMessage($Message);
        $succes=true;
        $_POST = [];

    }
    else{
       $errors = $Message->geterrors();
    }
}
$messages = $GeustBook->getMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Acceuille</title>
</head>
<body>
<div class="pricing">
            <div class="table">
                <div class="photo">

                </div>
               <div class="contenu">
                    <h6>MENSUEL</h6>
                    <br>
                    <p>32.90 $ /mois<br>
                    <br>
                    <strong>8 a 10</strong> friendises chaque mois<br>
                    <br>
                    Livraison <strong>GRATUIT</strong>a Antananarivo<br>
                    <br>
                    Renouvelement automatique<br>
                    <br>
                    Annuler quand vous vouler </p>
                    <br>
                    <button class="selection">SELECTIONNER</button>
               </div>
            </div>


            <div class="table">
                <div class="photo">

                </div>
                <div class="contenu">
                    <h6>ABONNEMENT 6 MOIS</h6>
                    <br>
                    <p>32.90 $ /mois<br>
                    <br>
                    <strong>8 a 10</strong> friendises chaque mois<br>
                    <br>
                    Livraison <strong>GRATUIT</strong>a Antananarivo<br>
                    <br>
                    Renouvelement automatique<br>
                    <br>
                    Annuler quand vous vouler </p>
                    <br>
                    <button class="selection">SELECTIONNER</button>
                </div>
            </div>


            <div class="table">
                <div class="photo">

                </div>
                <div class="contenu">
                    <h6>ABONNEMENT 12 MOIS</h6>
                    <br>
                    <p>32.90 $ /mois<br>
                    <br>
                    <strong>8 a 10</strong> friendises chaque mois<br>
                    <br>
                    Livraison <strong>GRATUIT</strong>a Antananarivo<br>
                    <br>
                    Renouvelement automatique<br>
                    <br>
                    Annuler quand vous vouler </p>
                    <br>
                    <button class="selection">SELECTIONNER</button>
                </div>
            </div>
        </div>
         <div class="resolution">
             <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate consectetur nobis debitis beatae corrupti nesciunt repudiandae. Doloremque sunt officia ea? Praesentium minus non veritatis nobis rem quod saepe nam esse!</p>
         </div>    
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger container mt-5">
                Formulaire  invalide
            </div>
        <?php elseif($succes): ?>
            <div class="alert alert-success container mt-5">
                Messages envoyer
            </div>
        <?php endif ?>
    <div class="container">
        <h1>Votre message sur notre service</h1>
        <form action="" method="post">
            <input value="<?=htmlentities($_POST['username'] ?? '')?>" type="text" name="username" placeholder="votre pseudo" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''?>">
            <?php if (isset($errors['username'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['username']?>
                </div>
            <?php endif;?>            
            <textarea class="form-control  mt-2  <?= isset($errors['message']) ? 'is-invalid' : ''?> "  name="message" placeholder="votre message" ><?=htmlentities($_POST['message'] ?? '')?></textarea>
            <?php if (isset($errors['message'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['message']?>
                </div>
            <?php endif;?>            
            <button class=" btn btn-warning mt-2" type="submit">Envoyer</button>
        </form>
        <?php if(!empty($messages)):?>
            <div class="container">
                <h2>
                    Vos Messages:
                </h2>
                <?php foreach($messages as $message):?>
                    <?= $message->toHTML(); ?>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
</body>
</html>
