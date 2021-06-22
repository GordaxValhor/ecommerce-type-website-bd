    var imagine = document.getElementsByClassName("imagine");
    var lungime = document.getElementsByClassName("imagine").length;
    var y=0;
    function switch_Img(link){
        var i = 2;
        var old_src = link;
        var new_src = link.replace("_1", "_" + i );
        for (y= 0; y<=lungime;y++)
        {
            if(imagine[y]) {
                var local_src = imagine[y].src;
                if( local_src == old_src)
                {
                    imagine[y].setAttribute('src', new_src);
                }
            }
        }
        
    }
    function switchback_Img(src){
        var i = 1;
        var new_src = src.replace("_2", "_" + i );
        var old_src = src;
        for (y = 0; y<=lungime;y++)
        {
            if(imagine[y]) {
                var local_src = imagine[y].src;
                if( local_src == old_src)
                {
                    imagine[y].setAttribute('src', new_src);
                }
            }
        }
    }
    