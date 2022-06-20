 
function kaydet(row, column,cid) {
        var k= row + '-' + column;
        var information = document.getElementById(k).value;
      
            $.ajax({
            type: "POST",
            url: "guncelle.php",
            data: {
                cid: cid,
                information: information
            },
            success: function(data) {
                

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
            });
}
