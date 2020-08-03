/**
 * Show file name in single upload
 */
$('#upload').change(function() {
    const path = document.getElementById('upload').value;
    document.getElementById('upload_file_name').innerHTML = path.replace(/^.*\\/, "");
});
