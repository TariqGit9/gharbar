
    $(document).ready(function() {
        $('#navbar').css('position','212');
      });
   
      $(document).on('click', '.mobile-nav-toggle', function() {
        $(window).scrollTop(0);
      });
      function getScreenWidth(){
       return screen.width;
      }
      displayCards();
      function displayCards(){
        if(getScreenWidth()>1199){
          var count =4;
        }else if(getScreenWidth()>768){
          var count =2;
        }else{
          var count =1;
        }
        var pos_check=0;
        $('.scroll-cards-mf').each(function(){
          if(count>pos_check){
            $(this).removeClass('d-none');
            pos_check++;
          }
        });
      }
      $(document).on('click', '.right', function() {
        var last = "";
        var complete=0;
        var array=[];
        $('.scroll-cards-mf').each(function(){
            if(! $(this).hasClass('d-none')){
              array.push($(this).data('pos'));
            }
            last=$(this).data('pos');
          });
          if(last+1 >(array[array.length-1] + 1)){
            $('.scroll-cards-mf-'+(array[0])).addClass("d-none");
            $('.scroll-cards-mf-'+(array[array.length-1] + 1)).removeClass("d-none");
          }
        
      });
      $(document).on('click', '.left', function() {
        var first = "";
        var check =0;
        var complete=0;
        var array=[];
        $('.scroll-cards-mf').each(function(){
         
          if(! $(this).hasClass('d-none')){
            if(check==0){
              first = $(this).data('pos');
              check =1;
            }
            array.push($(this).data('pos'));
          }
        });
        if(array[0]!=1){
          $('.scroll-cards-mf-'+(array[array.length-1] )).addClass("d-none");
          $('.scroll-cards-mf-'+(array[0] - 1)).removeClass("d-none");
        }
        
      });
  