
$ = jQuery.noConflict(true);
$(".wc-block-product-categories-list--depth-0").addClass('product-categories');
$(".wc-block-product-categories-list-item").addClass('cat-item');
$(".wc-block-product-categories-list--depth-1").addClass('children');
$(".wc-block-product-categories-list--depth-1 .wc-block-product-categories-list-item").removeClass('cat-item');
if($('li.cat-item ul')!= null){
    $('li.cat-item').addClass('cat-parent');
}
$(".wp-block-search__inside-wrapper").addClass('woocommerce-product-search');

$('.product-categories').find('.cat-item.cat-parent').append("<button class='toggle_cat'></button>");
// var quantity_minicart=
$('.wc-block-cart-item__prices').append("<span>x</span>");
// $('input[name=quantity]').keydown(function(event) {
//     return false;
// });

//add button to search
// $('.woocommerce-product-search').append("<a href='#'  id='buttonlistener' class='listener'></a>");
$('.dgwt-wcas-sf-wrapp').append("<a href='#'  id='buttonlistener' class='listener'></a>");

//$('.onsale')[0].textContent='';
let sales = document.getElementsByClassName('onsale');
for(let sale of sales){
    sale.textContent='';
}
$('#product-id').hide();

$(document).ready(function(){
    $(".toggle_cat").click(function(){

        // $(".product-categories ul.children").slideUp();
        // $(".toggle_cat").removeClass('slide_cat');

        $(this).siblings('ul.children').slideToggle();  /* Selecting div after h1 */
        $(this).toggleClass('slide_cat');

    });
});
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
//DOM load event
// buttonListen = document.getElementById("buttonlistener");
// buttonListen.addEventListener("click", () => {
//
//     //Set speech recognition fallback
//     window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
//
//     var recognition = new SpeechRecognition();
//     createNote = (transcript, newNote = true) => {
//         oldHtml = jQuery('#wp-block-search__input-1').html();
//
//         jQuery('#wp-block-search__input-1').html(transcript);
//         console.log(transcript);
//         document.getElementById('wp-block-search__input-1').value = transcript;
//     };
//
//     recognition.addEventListener('result', e => createNote(e.results[0][0].transcript));
//
//     recognition.addEventListener('end', recognition.start);
//
//     recognition.start();
// });

//to add video in the product page. width="560" height="315"
jQuery(document).ready(function($) {
    var myVideo = document.getElementById("myvideo");
    var srcVideo = ""; // Initialize srcVideo variable
    if(myVideo){
        srcVideo = myVideo.dataset['video'];
    }
    if(srcVideo !== "")
    {
        console.log(srcVideo);

        $('.woocommerce-product-gallery').append("<div class='display-video-flex' id='display-video'><button  class='display-video'></button><div>לצפיה בוידיאו</div></div>");
        $('.woocommerce-product-gallery').append('<div class="woocommerce-product-video"><iframe width="600" height="345" src="" frameborder="0" allowfullscreen></iframe></div>');
        $(".woocommerce-product-video").find("iframe")[0].src = srcVideo;
        $(".woocommerce-product-video").find("iframe").hide();
        videoButton = document.getElementById('display-video');
        videoButton.addEventListener("click",displayvideo);
    }
});
function displayvideo(){
    $(".woocommerce-product-video").find("iframe").show();
}
// var modal = document.getElementById("myModal");
//
// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");
//
// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];
//
// // When the user clicks on the button, open the modal
// if(btn) {
//     btn.onclick = function () {
//         modal.style.display = "block";
//     }
// }
//
// // When the user clicks on <span> (x), close the modal
// if(span) {
//     span.onclick = function () {
//         modal.style.display = "none";
//     }
// }
//
// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }
// // JS to popup
// var slideIndex = 0;
// showSlides();
//
// function showSlides() {
//     var i;
//     var slides = document.getElementsByClassName("slide");
//     for (i = 0; i < slides.length; i++) {
//         slides[i].style.display = "none";
//     }
//     slideIndex++;
//     if (slideIndex > slides.length) {slideIndex = 1}
//     if(slides[slideIndex - 1] !== undefined) {
//         slides[slideIndex - 1].style.display = "block";
//     }
//     setTimeout(showSlides, 2000); // Change image every 2 seconds
// }
// var leftArrow=document.getElementById("left-arrow");
// if(leftArrow){
// leftArrow.addEventListener("click", function() {
//     slideIndex--;
//     if (slideIndex < 1) {slideIndex = slides.length;}
//     showSlides();
// });
// }
// var rightArrow=document.getElementById("right-arrow");
// if(rightArrow){
// rightArrow.addEventListener("click", function() {
//     slideIndex++;
//     if (slideIndex > slides.length) {slideIndex = 1;}
//     showSlides();
// });
// }

function openminicart(){

    if (! $('.minicart1').hasClass('open-cart')){

        $.ajax({
            type: 'GET',
            url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
            success: function(data) {
                // Update the mini-cart with the response data
                $('#mini-cart').html(data.fragments['div.widget_shopping_cart_content']).show();
                var scrollheight = $('.allproduct').prop('scrollHeight');
                if($('.allproduct').prop('scrollTop')==0)
                     $('.allproduct').scrollTop(-scrollheight);
            },
            error: function(error) {
                console.log(error);
            }
        });
         $(".minicart1").addClass('open-cart');
    }
    else{
        $(".minicart1").removeClass('open-cart');
    }
}
function closeminicart(){
    $(".minicart1").removeClass('open-cart');

}

// jQuery(document).ready(function($) {
//     $('form.variations_form').on('found_variation', function(event, variation) {
// // do stuff here
//         console.log('change variation');
//  $('textarea[name=add-custom-text]').val('');
//
//     });
//
//     // $('.allproduct').on('change',function(event){
//     //     var scrollheight = $('.allproduct').prop('scrollHeight');
//     //     $('.allproduct').scrollTop(-scrollheight);
//     // })
// });
//
