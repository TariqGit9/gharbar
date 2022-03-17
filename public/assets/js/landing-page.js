function setUpLandingPage(){
    if(getScreenWidth()>650){
        $('#small-screens-mf').hide();
        $('#big-screens-mf').show();
    }else{
        $('#small-screens-mf').show();
        $('#big-screens-mf').hide();
    }
}
setUpLandingPage();