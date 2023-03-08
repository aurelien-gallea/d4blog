<?php
    if(!empty($_SESSION["id"])){
        $user=Checker::getLoginAndRank($_SESSION["id"]);
    }
    $title = "Acceuil";
    ob_start();
?>
<div class="my-5">
    <h1> Projets </h1>
<?php 
    if (isset($_GET["success"])){
    if ($_GET["success"] == 1) { ?>

        <p class="card m-2 p-1 bg-success d-inline-block"><?=$_GET["message"] ?></p>  
<?php }
}           

    while($project = $requete->fetch()) {   
    $author = Checker::getAuthor("projects", $project['id_user']) ;
    $likes = new ProjectController(new ProjectRepository);
    $like = $likes->getNumberLike($project["id"])
   
?>
    <div class="card mt-4">
    
    <?php if (!empty($project["img"])){ ?>

        <div class="item-center"><img class="card-img-top mx-auto" src="./public/src/img/<?=$project["img"] ?>" alt="Image of project"></div>
    <?php } ?> 

        <div class="card-header">
            <b><?= $project['title'] ?></b>
        </div>
        <div class="card-body">
            <p class="card-text"> <?=$project["content"] ?></p>                   
            <p class="card-subtitle">
               
            </p>
        </div>
        <!-- plus tard reserver a l'admin -->        

        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col">
                    <p>Ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> <br>
                    <i>Le : <?= DateToFr::dateFR($project['date']) ?></i></p>
                </div>
            
                
                <div class="col">
                    <form class="col" method="get" action="index.php?" > 
                        <?php if (!empty($_SESSION["id"])){
                            $res = $likes->checkIdUser($project["id"],$_SESSION["id"]);
                            if ($res === 0){ ?>
                                <span>Likes : <?=$like ?> </span><button class="btn ms-1" type="submit" name="like" id="like" value="<?= $project["id"] ?>"> <span class="ms-1 fa-regular fa-thumbs-up"></span></button>
                        <?php  } else { ?>
                                <span>Likes : <?=$like ?> </span><button  class="btn ms-1"  type="submit" name="dislike" id="dislike" value="<?= $project["id"] ?>"><span class="ms-1 fa-regular fa-thumbs-down"></span></button>
                        <?php }} else { ?> 
                                <span>Likes : <?=$like ?> </span>
                            <?php }  ?>
                                              
                    </form > 
                </div>
                <?php if (!empty($user['rank'])){ if ($user['rank'] == "admin"){ ?>  
                
                <form class="col" method="get" action="index.php" >                 
                    <button class="btn btn-danger mb-3" type="submit" name="deleteId" id="deleteId" value="<?= $project["id"] ?>" >Supprimer</button>
                    <button class="btn btn-success mb-3" type="submit" name="updateId" id="updateId" value="<?= $project["id"] ?>" >Modifier</button>
                </form>
            <?php } }?>
            </div>          
        </div> 
    </div>  
 
<?php   
}if (!empty($user['rank'])){
if ($user['rank'] == "admin"){
?>    
    <p> <a class="btn btn-primary mt-3" href="index.php?page=createProject">Creer un Projet</a></p>
</div> 

<?php }}
$content = ob_get_clean();
require_once("./view/base.php");
?>
