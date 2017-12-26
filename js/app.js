$(document).ready(function () {
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

        let input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });

    $('#upload-button').on('click', function (e) {

        //e.preventDefault();

        // let fileName = document.getElementById('fileToUpload').value;
        // fileName = fileName.split('\\')[2];
        // let filePath = window.location.href+'files/'+fileName;
        //
        // if(linkCheck(filePath)){
        //     swal({
        //         type: 'error',
        //         title: 'Sorry, File already exists.'
        //     }).then((result) => {
        //         if (result) {
        //             location.href = ''
        //         }
        //     });
        // }
        // else {
        //     document.uploadForm.submit();
        // }
        //
        // function linkCheck(url)
        // {
        //     let http = new XMLHttpRequest();
        //     http.open('HEAD', url, false);
        //     http.send();
        //     return http.status!=404;
        // }

        let vFD = new FormData(document.getElementById('upload-form'));
        let oXHR = new XMLHttpRequest();
        oXHR.upload.addEventListener('progress', move, false);
        oXHR.addEventListener('load', uploadFinish, false);
        oXHR.addEventListener('error', uploadError, false);
        oXHR.open('POST', '../index.php');
        oXHR.send(vFD);
    });
});

$(document).on('change', '.btn-file :file', function () {
    let input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

let width = 0;
function move(e) {
    let elem = document.getElementById("myBar");
    let iPercentComplete = Math.round(e.loaded * 100 / e.total);
    width++;
    elem.style.width = iPercentComplete + '%';
    elem.innerHTML = iPercentComplete.toString() + '%';
}

function uploadFinish(e) {
    width = 0;
}
function uploadError(e) {
    swal({
        type: 'error',
        title: 'Sorry, Something went wrong.'
    }).then((result) => {
        if (result) {
            location.href = ''
        }
    });
}