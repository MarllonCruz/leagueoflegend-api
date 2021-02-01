<?php
require_once "config.php";
require_once "partials/header.php";
require_once "models/leagueoflegend_api.php";

if(empty($_GET['id'])) {
   header("Location: ".$base); 
}

$lolApi = new LeagueOfLegend();
$champ = $lolApi::infoChampion($_GET['id']);
$id = $_GET['id'];

if(empty($champ)) {
    header('Location: '.$base);
}

$tags = [];
foreach($champ['tags'] as $item) {
    switch($item) {
        case "Assassin":
            $tags[] = 'Assassino';
            break;
        case "Fighter":
            $tags[] = "Lutador";
            break;
        case "Mage":
            $tags[] = "Mago";
            break;
        case "Marksman":
            $tags[] = "Atirador";
            break;
        case "Support":
            $tags[] = "Suporte";
            break;
        case "Tank";
            $tags[] = "Tanque";
            break;          
    }
}

?>

<div class="container-profile">
    <div class="profile-box">
        <a href="<?=$base;?>" class='list-champs'>
            Listas Campeões
        </a>
        <img src="http://ddragon.leagueoflegends.com/cdn/img/champion/splash/<?=$champ['id'];?>_0.jpg" />
        <div class="profile-info">
            <div class="profile-info--conteudo">
                <img src="http://ddragon.leagueoflegends.com/cdn/10.22.1/img/champion/<?=$champ['id'];?>.png" />

                <div class="profile-info--conteudo-name-title">
                    <h2><?=$champ['name'];?></h2>
                    <h3>'<?=$champ['title'];?>'</h3>
                </div>

                <div class="profile-info--conteudo-tag">
                    <img src="<?=$base;?>/assets/images/lol-tag2.png" />
                    <span>Função</span>
                    <?php foreach($tags as $item): ?>
                        <h3><?=$item;?></h3>
                    <?php endforeach; ?>
                </div>

                <div class="profile-info--conteudo-desc">
                    <h3>Descrição</h3>
                    <p><?=$champ['desc'];?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-box abiliity-box">
        <h2>Habilades</h2>

        <!-- Passive -->
        <div class="ability-conteudo">
            <div class="ability-img">
                <img class="icone-ability" src="http://ddragon.leagueoflegends.com/cdn/10.22.1/img/passive/<?=$champ['passive'];?>" />
                <h4>Passiva</h4>
            </div>
            <div class="ability-desc">
                <h2><?=$champ['name-passive'];?></h2>
                <p><?=$champ['desc-passive'];?></p>
            </div>
        </div>
        
        <!-- Abilits -->
        <?php foreach($champ['spells'] as $item): ?>
            <div class="ability-conteudo">
                <div class="ability-img">
                    <img class="icone-ability" src="http://ddragon.leagueoflegends.com/cdn/10.22.1/img/spell/<?=$item['id'];?>.png" />
                    <img class="icone-key" src="assets/images/key-<?=$item['index'];?>.png" />
                </div>
                <div class="ability-desc">
                    <h2><?=$item['name'];?></h2>
                    <p><?=$item['desc'];?></p>
                </div>
            </div>
        <?php endforeach; ?>   
        
    </div>

    <div class="profile-box skins-box">
        <h2>Skins</h2>
        <div class="skin-area">
            <?php foreach($champ['skins'] as $itemSkin): ?>
                <div class="skin-conteudo">
                    <img src="http://ddragon.leagueoflegends.com/cdn/img/champion/loading/<?=$champ['id'];?>_<?=$itemSkin['num'];?>.jpg">
                    <h3><?=$itemSkin['nameSkin'];?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>




<?php
require_once "partials/footer.php";
?>