$(document).ready(function(){

    defaultTheme();

    $('.btn_dark').on('click', () => {
        localStorage.setItem('theme', 'dark');
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('.icon_text').html(`<i class="bi bi-moon-stars"></i>`);
        $('.btn_dark').addClass('active');
        $('.btn_light').removeClass('active');
    });

    $('.btn_light').on('click', () => {
        localStorage.setItem('theme', 'light');
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('.icon_text').html(`<i class="bi bi-brightness-high"></i>`);
        $('.btn_light').addClass('active');
        $('.btn_dark').removeClass('active');
    });

});

const defaultTheme = () =>{

    if(!localStorage.getItem('theme')){
        localStorage.setItem('theme', 'light')
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('.icon_text').html(`<i class="bi bi-moon-stars"></i>`);
        $('.btn_light').addClass('active');
        $('.btn_dark').removeClass('active');
        return false;
    }

    if(localStorage.getItem('theme') === "dark"){
        // $('html').attr('data-bs-theme', localStorage.set('theme', 'dark'));
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('.icon_text').html(`<i class="bi bi-moon-stars"></i>`);
        $('.btn_dark').addClass('active');
        $('.btn_light').removeClass('active');
        return false;
    }

    if(localStorage.getItem('theme') === "light"){
        // $('html').attr('data-bs-theme', localStorage.set('theme', 'light'));
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('.icon_text').html(`<i class="bi bi-brightness-high"></i>`)
        $('.btn_light').addClass('active');
        $('.btn_dark').removeClass('active');
        return false;
    }
}