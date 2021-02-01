<?php
require_once "models/leagueoflegend_api.php";

$tag = filter_input(INPUT_POST, 'tag');

$array = [];

if($tag) {
    $lolAPI = new LeagueOfLegend();
    $champions = $lolAPI::infoChampionsAll();

    if(!empty($champions)) {
        foreach($champions->data as $champion) {
            if(in_array($tag, $champion->tags)) {
                $array[] = [
                    'id' => $champion->id,
                    'name' => $champion->name
                ];
            } 
        }
    }
    if($tag == 'all') {
        foreach($champions->data as $champion) {
            $array[] = [
                'id' => $champion->id,
                'name' => $champion->name
            ];
        }
    }
} 

header("Content-Type: application/json");
echo json_encode($array);
exit;


