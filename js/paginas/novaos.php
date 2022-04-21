<?php
echo "
<script>
function limpaPrevia(){
    var elemento = document.getElementById('previa');
    while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
    }
}
function previewImages(){
    var preview = document.querySelector('#previa');
    if(this.files){
        [].forEach.call(this.files, readAndPreview);
    }
    function readAndPreview(file){
        if(!/\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF)$/i.test(file.name)){
            return alert(file.name + ' está no formato incorreto!');
        }
        var reader = new FileReader();
        reader.addEventListener('load', function(){
            var image = new Image();
            image.style = 'padding: 3px';
            image.height = 100;
            image.title = file.name;
            image.src = this.result;
            preview.appendChild(image);
        });
        reader.readAsDataURL(file);
    }
}
document.querySelector('#anexo').addEventListener('change', previewImages);
$(document).ready(function(){
    var limit = 4;
    $('#anexo').change(function(){
        var files = $(this)[0].files;
        if(files.length > limit){
            $('#previa').hide();
            alert('You can select max '+limit+' images.');
            $('#anexo').val('');
            return false;
        }else{
            $('#previa').show();
            $('#limpar').show();
            return true;
        }
    });
});
$(document).ready(function(){
    $('#limpar').click(function(){
        $('#previa').hide();
        $('#anexo').val('');
        $('#limpar').hide();
    });
});
$(document).ready(function(){
    $('#submit').click(function () {
		var nome = $('#nome').val();
		var estabelecimento = $('#estabelecimento').val();
        var setor = $('#setor').val();
        var equipamento = $('#equipamento').val();
        var ramal = $('#ramal').val();
        var descricao = $('#descricao').val();
		if(nome != '' && estabelecimento != '' && setor != '' && equipamento != '' && ramal != '' && descricao != '') {
			$('#loading').show('fast');
            $('#submit').removeAttr('disabled');
		}else{
            $('#loading').hide();
        }
	});
});
(function(){
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
    .forEach(function (form){
        form.addEventListener('submit', function (event){
            if(!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
        form.classList.add('was-validated')
        }, false)
    })
})()
</script>
";
?>