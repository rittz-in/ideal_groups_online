$(document).ready(function () {
    var addresss = "";
    ClassicEditor
        .create(document.querySelector('#address'), {
            // Enable the CKFinder button in the toolbar.
            toolbar: {
                items: [
                    'ckfinder', 'imageUpload', '|',
                    'heading', '|',
                    'bold', 'italic', '|',
                    'link', '|',
                    'bulletedList', 'numberedList',
                    'insertTable', '|',
                    'blockQuote', '|',
                    'undo', 'redo'
                ],
                shouldNotGroupWhenFull: true
            },
            ckfinder: {
                // Upload the images to the server using the CKFinder QuickUpload command.
                uploadUrl: assets_path + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            }

        })
        .then(editor => {
            myEditor = editor;
            if (obj.address) {
                myEditor.setData(obj.address);
            }
        })
        .catch(error => {
            console.error(error);
        });

});
