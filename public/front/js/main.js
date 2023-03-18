$(document).ready(function(){

    var BtnClose = document.getElementById("Close");

    function owlres() {
        var $carousel = $('.sliderMainSlide');  
        if($carousel.length>0)  {   
            $carousel.data('owl.carousel')._invalidated.width = true;
            $carousel.trigger('refresh.owl.carousel');
        }
    }
    
    updateOwl = function(){
        $(".sliderMainSlide").each(function() {
          $(this).data('owl.carousel').onResize();
          $(".sliderMainSlide").trigger('refresh.owl.carousel');
        });

        $(".SliderPhotoWork").each(function() {
            $(this).data('owl.carousel').onResize();
            $(".sliderMainSlide").trigger('refresh.owl.carousel');
        });
    };

    BtnClose.onclick = function () {
        
        var SideBar = document.getElementById("SideBar");
        var Content = document.getElementById("Content");

        SideBar.classList.toggle("hide");
        Content.classList.toggle("show");

        setTimeout(function(){
            updateOwl();        
          },   500)

    }
    $(window).on('resize', function(){
        setTimeout(function(){
            updateOwl();        
          },   500)
    });

    $(".sliderMainSlide").owlCarousel({
        autopaly:true,
        items:1,
        rtl:true,
        
    });
    $(".SliderPhotoWork").owlCarousel({
        autopaly:true,
        items:1,
        rtl:true,
        
    });
    $(".sliderPartnerSlide").owlCarousel({
        autopaly:true,
        margin:30,
        dots:false,
        rtl:true,
        nav: true,
        navText : ['<i class="far fa-angle-right" aria-hidden="true"></i>','<i class="far fa-angle-left" aria-hidden="true"></i>'],
        responsive : {
            0 : {
                items:1,
                stagePadding: 0,
            },425: {
                items: 1,
                stagePadding: 30,
            },600: {
                items: 2,
                stagePadding: 30,
            },768: {
                items: 2,
                stagePadding: 30,
            },992: {
                items: 3,
                stagePadding: 30,
                margin:15,
            }
        }
        
    });

    var ItemService = document.getElementsByClassName("paddservice");
    var ItemNum = $(".paddservice .service .descriptionservice .numItem");

    var i;
    for(i = 0; i < ItemService.length;i++) {
        if(i <= 9-1) {
            ItemNum[i].innerHTML = "0" + (i+1);
        }else {
            ItemNum[i].innerHTML = i+1;
        }
    }
    
    (function() {

        var itemActive = $(".mainBody .sliderPartnerSlide .owl-item.active")[0];
        var itemcount = document.getElementById("itemactivecount");
        var allcount = document.getElementById("allcount");
        itemcount.innerHTML = $(".mainBody .sliderPartnerSlide .owl-item.active").index()+1;
        var ItemPartnerCount = document.getElementsByClassName("itempartner");
        allcount.innerHTML = ItemPartnerCount.length;
        $(itemActive).addClass("ActiveItem");
        $('.sliderPartnerSlide').on("dragged.owl.carousel",changeActive)
        $('.sliderPartnerSlide.owl-theme .owl-nav button').on('click',changeActive)
        function changeActive() {
            var itemActive = $(".mainBody .sliderPartnerSlide .owl-item.active")[0];
            var itemActiveDelprev = $(".mainBody .sliderPartnerSlide .owl-item.active")[1];
            var itemActiveDelnext = $(".mainBody .sliderPartnerSlide .owl-item.active")[2];

            $(itemActive).addClass("ActiveItem");
            $(itemActiveDelprev).removeClass('ActiveItem');
            $(itemActiveDelnext).removeClass('ActiveItem');

            itemcount.innerHTML = $(".mainBody .sliderPartnerSlide .owl-item.active").index() + 1;
        }
        

    })();

    var ItemPartner = document.getElementsByClassName("itempartner");
    var ItemNumPartner = $(".itempartner .bgimg .body-slide .number-partner .number");

    var i;
    for(i = 0; i < ItemPartner.length;i++) {
        if(i <= 9-1) {
            ItemNumPartner[i].innerHTML = "0" + (i+1);
            
        }else {
            ItemNumPartner[i].innerHTML = i+1;
        }
    }

    $(".sideBar .Navsidebar .nav-item").click(function() {
        $(".sideBar .Navsidebar .nav-item").removeClass("active");
        $(this).addClass("active");
    });
    

});

    
        
    
    
