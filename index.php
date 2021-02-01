<?php
require_once "config.php";
require_once "partials/header.php";
require_once "models/leagueoflegend_api.php";

$lolAPI = new LeagueOfLegend();

$champions = $lolAPI::infoChampionsAll();
?>

<header>
    <div class="title">
        <h1>Campeões</h1>
    </div>
</header>
<div class="container-filter">
    <div class="filter-box">
        <div class="filter-search">
            <input text="text" class="searchAction" name="seach" placeholder="Campeões">
            <img id="btnSearch" src="<?=$base;?>/assets/images/search.png">
        </div>
        <div class="filter-functions">
            <input type="checkbox" id="chec"/>
            <label for="chec">
                <img id="menu-oponer" src="<?=$base;?>/assets/images/menu.png" />
            </label>
            <nav>
                <ul>
                    <li>
                        <button data-key="all" class="btn-filter active">Todos</button>
                    </li>
                    <li>
                        <button data-key="Assassin" class="btn-filter"> Assassinos</button>
                    </li>
                    <li>
                        <button data-key="Fighter" class="btn-filter">Lutadores</button>
                    </li>
                    <li>
                        <button data-key="Mage" class="btn-filter">Magos</button>
                    </li>
                    <li>
                        <button data-key="Marksman" class="btn-filter">Atiradores</button>
                    </li>
                    <li>
                        <button data-key="Support" class="btn-filter">Suportes</button>
                    </li>
                    <li>
                        <button data-key="Tank" class="btn-filter">Tanques</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <?php if($champions): ?>
        <?php foreach($champions->data as $champion): ?>
            <div class="area-campeos">
                <a href="champion-profile.php?id=<?=$champion->id;?>">
                    <div class="box-campeos">
                        <img src="http://ddragon.leagueoflegends.com/cdn/img/champion/loading/<?=$champion->id;?>_0.jpg">
                        <div class="name-campeao"><?=$champion->name;?></div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h2>Aguarde 2 minuto e atualiza a página.</h2>
    <?php endif; ?>    
</div>

<?php
require_once "partials/footer.php";
?>


