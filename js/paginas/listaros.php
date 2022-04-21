<?php
echo "
<script>
$(document).ready(function(){
    load_data(1);
    function load_data(pagina, protocolo = ''){
        $.ajax({
            url: 'includes/listaros.php',
            method: 'POST',
            data: {
                pagina:pagina,
                protocolo:protocolo
            },
            success: function(data){
                $('#retornoBusca').html(data);
            }
        });
    }
    $(document).on('click', '.page-link', function(){
        var pagina = $(this).data('page_number');
        var protocolo = $('#protocolo').val();
        load_data(pagina, protocolo);
    });
    $('#protocolo').keyup(function(){
        var protocolo = $('#protocolo').val();
        load_data(1, protocolo);
    });
});
$(document).ready(function(){
    $(document).on('click', '#btnModal', function(event){
        event.preventDefault()
        var id_protocolo = $(this).data('id');
        $.ajax({
            url: 'includes/listarosinfo.php',
            method: 'POST',
            data: {
                id_protocolo:id_protocolo
            },
            success: function(data){
                $('#retornoBuscaInfo').html(data);
                $('#modal').modal('show');
            }
        });
    });
});
function openModal(){
    document.getElementById('anexos').style.display = 'block';
}

function closeModal(){
    document.getElementById('anexos').style.display = 'none';
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n){
    showSlides(slideIndex += n);
}

function currentSlide(n){
    showSlides(slideIndex = n);
}

function showSlides(n){
    var i;
    var slides = document.getElementsByClassName('mySlides');
    var dots = document.getElementsByClassName('demo');
    var captionText = document.getElementById('caption');
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = 'none';
    }
    for (i = 0; i < dots.length; i++){
        dots[i].className = dots[i].className.replace(' active', '');
    }
    slides[slideIndex-1].style.display = 'block';
    dots[slideIndex-1].className += ' active';
    captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
";
?>