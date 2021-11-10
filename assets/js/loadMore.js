
$(document).ready(function(){

    $(document).on('click',"#load-more",function(event){

        event.preventDefault();

        let id = $('#load-more').data("id");
        
        let data = {'id': id};
        
        $.post("app/controllers/loadMore.php",data,function(res){
            
            $('.add-more-wrapper').remove();
            $('#no-more-posts').remove();

            $('.post-wrapper').append(res);
           

        })
    })
});