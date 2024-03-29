$(window).scroll(function () {
    if($(document).innerHeight() > 1050)
    {
        let scroll = $(this).scrollTop();
        if(scroll > 60){
            $('#desktop-menu').addClass('menu-fixed');
        } else if(scroll == 0) {
            $('#desktop-menu').removeClass('menu-fixed');
        }
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
            300: {
                items: 1,
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


// it use in question
function showAnswerToAnswerForm(el) {
    let form = el.parentElement.querySelector('form');
    form.classList.toggle('hidden');
    el.classList.add('hidden');
}
function closeAnswerToAnswerForm(el){
    let form = el.parentElement;
    form.classList.toggle('hidden');
    form.parentElement.querySelector('.show-btn').classList.remove('hidden');
    el.preventDefault();

}



//reach text for question anb answer page
$(document).ready(function(){

    let summernotes = $('textarea[data-editor="summernote"]');
    if(summernotes.length > 0){
        summernotes.summernote({
            placeholder: 'Ҷавоби шумо ...',
            tabsize: 2,
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
                ['insert', ['link', 'picture']],
            ]
        });
    }
});




//confirm to delete question
$('.delete-btn').click(function(event) {
    event.preventDefault();
    let deleteQuestion = confirm('Шумо дар ҳақиқат мехоҳед саволро пок кунед?');
    if(deleteQuestion)
    {
        $(this).parent().submit();
    }
});



//PWA installer
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    deferredPrompt = e;
});
const installApp = document.getElementById('installPwa');
installApp.addEventListener('click', async () => {
    console.log(deferredPrompt);
    if (deferredPrompt !== null) {
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;
        if (outcome === 'accepted') {
            deferredPrompt = null;
        }
    }
});

window.addEventListener('beforeinstallprompt', (e) => {
    $('#installPwa').show();
    deferredPrompt = e;
});