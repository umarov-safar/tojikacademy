$(window).scroll(function () {
    let scroll = $(this).scrollTop();
    if(scroll > 60){
        $('#desktop-menu').addClass('menu-fixed');
    } else if(scroll == 0) {
        $('#desktop-menu').removeClass('menu-fixed');
    }
});

//Nav bar menu
// in desktop
$( ".catalog-menu" )
    .mouseenter(function() {
        $(this).find('.child-items').addClass('show-childe-items');
        $(this).find('i').attr('class', 'fas fa-angle-up');
    })
    .mouseleave(function() {
        $(this).find('.child-items').removeClass('show-childe-items');
        $(this).find('i').attr('class', 'fas fa-angle-down');
    });

//in mobile
$('.parent-item-mobile').click(function() {
    $(this).parent('.catalog-menu-mobile').find('.child-items-mobile').toggleClass('show-item-mobile')
})

$('#bar').click(function () {
    $('.mobile-menu').toggleClass('show-mobile')
})


$('.category-item').click(function(){
    $(this).toggleClass('show-2')
})

$(document).ready(function(){
    //Initialize the skrollr library

    //Owl carousel initialize
    $('.owl-carousel').owlCarousel({
        items: 3,
        margin: 20,
        autoplay: true,
        loop: true,
        autoplayTimeout: 1300,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3,
            },
            500: {
                items: 2
            },
            900: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
});



//If the user selected avatar then show img in bottom
$('#avatar').change((event) => {
    let file = event.target.files[0];
    let type = file.type.split('/');
    if(type[0] == 'image'){
        $('#avatar-preview')[0].src = URL.createObjectURL(file);
    }
})


//text to speech function for learning word and sentence
let synth = speechSynthesis;
function textToSpeech(text, name){
    synth.cancel();
    let utternamce = new SpeechSynthesisUtterance(text);
    for(let voice of synth.getVoices()){
        if(voice.name === name){
            utternamce.voice = voice;
        }
    }
    speechSynthesis.speak(utternamce)
}
