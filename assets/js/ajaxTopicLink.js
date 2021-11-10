

$(document).ready(function(){
    $('.topic-link').click(function(){
        event.preventDefault();

        let topicId = {"id":$(event.target).data('id')};

        $.post("app/controllers/getPostsByTopic.php",topicId,function(res){

            $('.post-content').html(' ');
            $('.post-content').append(res);

        })
        $('html, body').animate({
            scrollTop: $(".post-content").offset().top
        }, 2000);
})

    $(document).on('click',"#load-more-categories",function(event){

        event.preventDefault();

        let id = $('#load-more-categories').data("id");
        let categorie = $('#load-more-categories').data("categorie");

        let data = 
        {
            'id': id,
            'categorie': categorie 
        };
        
        $.post("app/controllers/loadMoreByCategories.php",data,function(res){
            
            $('.add-more-wrapper').remove();
            $('#no-more-posts').remove();

            $('.post-wrapper').append(res);
           
        })
    })
})

