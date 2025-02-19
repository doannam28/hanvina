
function initEditor() {
    tinymce.remove();
    tinymce.init({
        selector: '.editor',
        plugins: 'image code autoresize table lists',
        toolbar: 'code| undo redo | link image | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat | table ',
        min_height: 300,
        placeholder: 'Nhập nội dung bài viết',
        resize: true,
        forced_root_block: 'p',
        newline_behavior: '',
        autoresize_bottom_margin: 100,
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | importword exportpdf exportword | print | deleteallconversations' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
            view: { title: 'View', items: 'code revisionhistory | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
            insert: { title: 'Insert', items: 'image link media addcomment pageembed codesample inserttable | math | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
        },
        automatic_uploads: true,
        images_file_types: 'jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp',
        images_upload_url: '/api/upload',
    });
}


