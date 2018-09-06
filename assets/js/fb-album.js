function getAlbum() {
    FB.api(
    "/me/albums?fields=name",
        function (response) {
            // $('.overlay-loader').show();
            if (response && !response.error) {
                $('.overlay-loader').show();
                for(var i=0; i<=response.data.length-1;i++){
                    var albumID=response.data[i].id;
                    var albumName=response.data[i].name;
                    getAlbumPhoto(albumID,albumName);
                }
            }
        }
    );  
}
  
function getAlbumPhoto( albumID , albumName ) {
    var quotations = [];
    var limit = 100;
    FB.api("/"+ albumID +"/photos?fields=images&limit="+limit, doSomething);
    function doSomething(response){
        quotations.push(...response.data);
        response.data.forEach(photo => {
            photo.picture_full = photo.images[0].source; 
            delete photo.images; 
        });
        if (response.paging.hasOwnProperty('next')){
            FB.api(response.paging.next, doSomething );
        }else{
            //$('.overlay-loader').hide();
            callback(quotations , albumName);
            console.log("No more photos");
            return false;
        }
    }
}

var data = {};
function callback(cb , albumName){
    var album1 = [];
    //console.log(cb);
    for(var i=0; i<=cb.length-1;i++){
      var img_url = cb[i].picture_full;
      album1.push(img_url);
    }
    data[albumName]= (album1);
    //console.log(album1);
    data1 = JSON.stringify(data);
    $('div#js_photos').text(data1);
    $.ajax({
        type: 'POST',
        //url: 'https://localhost/fbalbum/callback/set_session',
        url: 'https://clapdust.com/callback/set_session',
        data: {data: JSON.stringify(data)},
        dataType: 'json', 
        async:false,   
        success: function(result){
            console.log(result);
        },
        complete: function (data) {
            $('.overlay-loader').hide();
        }
    });
}