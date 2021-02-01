<?php

class LeagueOfLegend {
    
    static public function infoChampionsAll() {
        $array = [];

        $array = @file_get_contents
        ('http://ddragon.leagueoflegends.com/cdn/10.22.1/data/pt_BR/champion.json');

        return json_decode($array);
    }

    static public function infoChampion($id_champion) {
        $array = [];

        $data = @file_get_contents
        ("http://ddragon.leagueoflegends.com/cdn/10.22.1/data/pt_BR/champion/"
        .$id_champion.".json");

        if(!empty($data)) {
            $data = json_decode($data);

            $array['id'] = $data->data->$id_champion->id;
            $array['name'] = $data->data->$id_champion->name;
            $array['title'] = $data->data->$id_champion->title;
            $array['desc'] = $data->data->$id_champion->lore;
            $array['tags'] = $data->data->$id_champion->tags;
            $array['passive'] = $data->data->$id_champion->passive->image->full;
            $array['name-passive'] = $data->data->$id_champion->passive->name;
            $array['desc-passive'] = $data->data->$id_champion->passive->description;
            
            $array['skins'] = [];
            foreach($data->data->$id_champion->skins as $itemSkin) {
                if($itemSkin->name == 'default') {
                    $array['skins'][] = [
                        'num' => $itemSkin->num,
                        'nameSkin' => 'Clássico'
                    ];
                } else {
                    $array['skins'][] = [
                        'num' => $itemSkin->num,
                        'nameSkin' => $itemSkin->name
                    ];
                }
            }

            $array['spells'] = [];
            $num = 1;
            foreach($data->data->$id_champion->spells as $data) {
                $array['spells'][] = [
                    'index' => $num,
                    'id' => $data->id,
                    'name' => $data->name,
                    'desc' => $data->description,
                ];
                $num++;
            }
        }

        return $array;
    }

}


