// const searchBoxInput = document.querySelector('.search-box input');
// const searchResult = document.querySelector('.search-result');
// const searchBox = document.querySelector('.search-box');

searchBoxInput.oninput = function() {
    searchBoxInputRun()
}


function searchBoxInputRun() {
    let targetUrl = searchBox.getAttribute('data-target');

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);

            // console.log(jsonData);
            insertSearchResult(jsonData, searchBoxInput.value);

        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    let data = { "value": searchBoxInput.value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}

function insertSearchResult(data, value) {
    searchResult.innerHTML = '';
    if (data.length == 0 || value == '') {
        searchResult.insertAdjacentHTML("afterbegin", `
                <li><span class="fas fa-link"></span>موردی یافت نشد</li>
            `);
    } else {
        let dataUrl = searchBox.getAttribute('data-url');
        for (let i = 0; i < data.length; i++) {
            searchResult.insertAdjacentHTML("afterbegin", `
               <li><span class="fas fa-link"></span><a href="${dataUrl}/${data[i].id}">${data[i].name}</a></li>

            `);
        }
    }
}