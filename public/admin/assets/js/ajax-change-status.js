const statusChanger = document.querySelectorAll('.status-changer');


startStatusChanger(statusChanger);

function startStatusChanger(documents) {
    for (let i = 0; i < documents.length; i++) {
        documents[i].onchange = function() {
            runstatusChanger(i);

        }
    }
}


function runstatusChanger(i) {
    let targetUrl;
    let id;
    let value;

    if (typeof(statusChangerSearcher) == 'undefined') {

        targetUrl = statusChanger[i].getAttribute('targetUrl');
        id = statusChanger[i].getAttribute('data-status');
        value = statusChanger[i].value;

    } else {
        targetUrl = statusChangerSearcher[i].getAttribute('targetUrl');
        id = statusChangerSearcher[i].getAttribute('data-status');
    }


    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);
            console.log(jsonData);
        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    let data = { "id": id, "value": value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}