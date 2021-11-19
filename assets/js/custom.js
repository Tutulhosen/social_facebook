
$('input[name=photo]').change(function(e){
      let photos= URL.createObjectURL(e.target.files[0]);

      $('#upload').attr('src' ,photos);
});