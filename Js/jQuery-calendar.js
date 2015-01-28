  /* jQuery(function($){
               $('.month').hide();
               $('.month:first').show();
               $('.months a:first').addClass('active');
               var current = 1;
               $('.months a').click(function(){
                    var month = $(this).attr('id').replace('linkMonth','');
                    if(month != current){
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('.months a').removeClass('active'); 
                        $('.months a#linkMonth'+month).addClass('active'); 
                        current = month;
                    }
                    return false; 
               });
            });

  */
  $(document).ready(function() {
    
    var date = new Date();
    var curentMonth = date.getMonth()+1;
    $('#month'+curentMonth).fadeIn();


    $('.monthsList').on('click', function() {
      var id = $(this).attr('id');
      id = id.replace('linkMonth','');
      id = id.replace('"','');

      $('.month').fadeOut();
      $('#month'+id).fadeIn();
    });

    function hideAll() {
      $('.month').fadeOut();
    }

  });
