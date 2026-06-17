const ajaxDelete = document.querySelectorAll('.ajax-delete');


startAjaxDelete(ajaxDelete);

function startAjaxDelete(documents) {
    for (let i = 0; i < documents.length; i++) {
        documents[i].querySelector('.btn-ajax-delete').onclick = function() {
            if (confirm('از حذف این ردیف اطمینان دارید؟؟')) {
                runAjaxDelete(i);

            }

        }
    }
}

function runAjaxDelete(i) {
    let targetUrl;

    if (typeof(ajaxDeleteSearcher) == 'undefined') {
        targetUrl = ajaxDelete[i].querySelector('.btn-ajax-delete').getAttribute('targetUrl');

    } else {
        targetUrl = ajaxDeleteSearcher[i].querySelector('.btn-ajax-delete').getAttribute('targetUrl');

    }



    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);
            console.log(jsonData);

            if (jsonData.status === true) {
                if (typeof(ajaxDeleteSearcher) == 'undefined') {
                    ajaxDelete[i].remove();
                } else {
                    ajaxDeleteSearcher[i].remove();
                }
            } else {
                alert(jsonData.message)
            }

        }
    }
    xmlHttp.open('GET', targetUrl, true);

    xmlHttp.send();

}