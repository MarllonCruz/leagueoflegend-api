<?php
require_once "models/leagueoflegend_api.php";

$search = filter_input(INPUT_POST, 'search');

$array = [];

if($search) {
    $lolAPI = new LeagueOfLegend();
    $champions = $lolAPI::infoChampionsAll();

    if(!empty($champions)) {
        foreach($champions->data as $champion) {
            if(stristr($champion->name, $search)) {
                $array[] = [
                    'id' => $champion->id,
                    'name' => $champion->name
                ];
            } 
        }
    }
} 

if(empty($array)) {
    $array = [
        'error' => 'Nenhum resultado de busca!'
    ];
}

header("Content-Type: application/json");
echo json_encode($array);
exit;


