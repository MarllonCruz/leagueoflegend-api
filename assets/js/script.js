window.addEventListener('load', function() {
    const BASE = '/leagueoflegend-api/';

    let inputSearch = document.querySelector('.searchAction');
    document.querySelector('#btnSearch').addEventListener('click', ()=>{
        searchAction(inputSearch.value);
    });

    inputSearch.addEventListener('keyup', (e)=>{
        if(e.keyCode == 13) {
            let search = e.target.value;
            searchAction(search);
        }
    });
    
    let filters = document.querySelectorAll(".btn-filter");

    filters.forEach(item=>{
        item.addEventListener('click', async ()=>{

            let key = item.getAttribute('data-key');

            let data = new FormData();
            data.append('tag', key);

            let req = await fetch(BASE+'tag_ajax.php', {
                method: 'POST',
                body: data
            });

            let json = await req.json();

            if(json != '') {
                document.querySelector(".container").innerHTML = "";
                __feedListToObjeto(json);
            } 

            filters.forEach(itens=>{
                itens.classList.remove('active');
            });
            item.classList.add('active');
        });
    });

    async function searchAction(el) {
        if(el != '') {
            let data = new FormData();
            data.append('search', el);

            let req = await fetch(BASE+'search_ajax.php', {
                method: 'POST',
                body: data
            });

            let json = await req.json();

            if(json.error) {
                document.querySelector(".container").innerHTML = "";
                document.querySelector(".container").innerHTML = json.error;
            } else {
                document.querySelector(".container").innerHTML = "";
                __feedListToObjeto(json);
            }
            
        } 
    }

    function __feedListToObjeto(json) {
        for(var c in json) {
            let data = `<div class="area-campeos">`;
            data += `<a href="champion-profile.php?id=${json[c].id}">`;
            data += `<div class="box-campeos">`;
            data += `<img src="http://ddragon.leagueoflegends.com/cdn/img/champion/loading/${json[c].id}_0.jpg" />`;
            data += `<div class="name-campeao">${json[c].name}</div>`;
            data += `</div>`;
            data += `</a>`;
            data += `</div>`;

            document.querySelector(".container").innerHTML += data;
        } 
    } 

});
