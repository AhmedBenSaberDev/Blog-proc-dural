
// Drop Down menu

let dropDownMenu = false;

$( document ).ready(function() {

    $("html").click(function(){

        if($(event.target).hasClass('username-nav')){
            
        }
        else{
            dropDownMenu = false;
            $('.drop-down').hide();
        }
        
    })

    $('.user-logo').click(function(){

        dropDownMenu = !dropDownMenu;
        
        if(dropDownMenu){
            $('.drop-down').show();
        }
        else{
            $('.drop-down').hide();
        }  
    })
});


// Hamburger Menu
let menu = false;

$(document).ready(function(){
    
    $('.mobile-nav-wrapper').hide(); 
    

    $('.menu-wrapper').on('click', function() {
		$('.hamburger-menu').toggleClass('animate');
        menu = !menu;
        
        if(menu){
            $('.mobile-nav-wrapper ').show(); 
            $('.hamburger-menu').removeClass('hidden');
            $('.hamburger-menu').addClass('fixThis');
        }else{
            $('.mobile-nav-wrapper ').hide();
            $('.hamburger-menu').removeClass('hidden');
            $('.hamburger-menu').removeClass('fixThis');
        }  
	});
   
})

//  responsive handling

$(window.onresize = function(){

    if(window.innerWidth <= 1023)
    {
        $('.desktop-nav').hide();
        $('.hamburger').show();
        $('.hamburger-menu').removeClass('hidden');
        
    }else{

        $('.desktop-nav').show();
        $('.hamburger').hide(); 
        $('.mobile-nav-wrapper').hide(); 
        $(".hamburger-menu").removeClass('animate');
        menu = false;
    }
  
})
    

