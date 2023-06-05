// main app script
require('./bootstrap');
require('./jquery-3.4.1.min.js');
require('./owl.carousel.min.js');
require('./materialize.min.js');
require('./jQuery.tagify.min.js');
require('./sweetalert.min.js');
require('./jquery.validationEngine.js');
require('./jquery.validationEngine-es.js');
require('./jquery.fancybox.min.js');
require('./owl.carousel.min.js');
require('./bootstrap.min.js');
require('./nav.js');





(function () {
  var love;
  love = document.querySelectorAll(".icon-heart");
  $(love).on('click' , function(){
    loved  = $(this).attr('data-loved');

    if(loved == 'false'){
      $(this).attr('data-loved' , 'true');
      $(this).addClass('icon-heart--clicked');
      var negocio = $(this).attr('data-id');
      var user = $(this).attr('data-user')
      doLike(negocio, user);
    }else{
      $(this).attr('data-loved' , 'false');
      var like = $(this).attr('data-like');
      $(this).removeClass('icon-heart--clicked');
      removeLike(like);
    }
  });

}).call(this);

function doLike(negocio, usuario){
    $.ajax({
        type: "POST",
        url: url   + "/like",
        data: {'id' : usuario , 'negocio' : negocio},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            if(data.msg){
                console.log(data.msg)
            }

        },error: function (error) {
          console.log(error);
        }
      });
}

function removeLike(like){
    $.ajax({
        type: "POST",
        url: url   + "/unlike",
        data: {'id' : like},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            if(data.msg){
                console.log(data.msg)
            }

        },error: function (error) {
          console.log(error);
        }
      });
}

$('[name=txtProductosList]').tagify({
  duplicates :false,
  pattern: /^[0-9a-zA-ZÁáÉéÍíÓóÚúñ ]+$/
});


function getColonias(){
  var endpoint_sepomex  = "https://api-sepomex.hckdrk.mx/query/";
  var method_sepomex = 'info_cp/';
  var cp = $("#txtPostal").val();
  var variable_string = '?type=simplified';
  var url_cp = endpoint_sepomex + method_sepomex + cp + variable_string;


  $.get( url_cp, function() {
  }).done(function(data){
    var content = JSON.parse(JSON.stringify(data));

    if(content.error){
      $("#txtColonia").html('');
    }else{
      for (let i = 0, c = content.response.asentamiento.length; i < c; i++) {
        $("#txtColonia").append("<option value='"+content.response.asentamiento[i]+"'>"+content.response.asentamiento[i]+"</option>");
      }
    }
  }).fail(function(data){
    $("#txtColonia").html('');
  });
}

getColonias();

$("#txtPostal").on( 'change', function(){

  var endpoint_sepomex  = "https://api-sepomex.hckdrk.mx/query/";
  var method_sepomex = 'info_cp/';
  var cp = $(this).val();
  var variable_string = '?type=simplified';
  var url_cp = endpoint_sepomex + method_sepomex + cp + variable_string;


  $.get( url_cp, function() {
  }).done(function(data){
    var content = JSON.parse(JSON.stringify(data));

    if(content.error){
      $("#txtColonia").html('');
    }else{
      for (let i = 0, c = content.response.asentamiento.length; i < c; i++) {
        $("#txtColonia").append("<option value='"+content.response.asentamiento[i]+"'>"+content.response.asentamiento[i]+"</option>");
      }
    }
  }).fail(function(data){
    $("#txtColonia").html('');
  });
});


ajaxValidationCallback = function(status, form, json, options) {
  if (window.console) {
    console.log(status);
  }
  if (status === true) {
    $(".loading").hide(500);
    $("#btnSubmit").show();
    console.log(form);
    console.log(json);
    console.log(options);
    swal(json.msg);
  }else{
    swal(json.error);
  }
  return false;
};

var validateForm = function() {
  jQuery("#form-user").validationEngine('attach',{
    ajaxFormValidation: true,
    ajaxFormValidationMethod: 'post',
    onAjaxFormComplete: ajaxValidationCallback,
    onFailure: function(status, form, json, options){
      console.log("status:" , status);
      console.log("form:" , form);
      console.log("json:" , json);
      console.log("option:" , options);
    }
  });
  return false;
};



$("#form-negocio").on('submit', function(){
  $(".loading").show();
});

function updateEstablecimiento(){

  var formData = new FormData($('#form-negocio')[0]);

  $.ajax({
    type: "POST",
    url: url   + "/update-establecimiento",
    data: formData,
    mimeType: "multipart/form-data",
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.msg) {
        $(".loading").hide(500);
        swal(data.msg, "", "success");
        localStorage.clear();
        window.location.href = url + "/dashboard/mi-negocio";

      } else if (data.error) {
        // grecaptcha.reset();
        // $('#btnSubmit').show(500);
        $(".loading").addClass('dn');
        swal(data.error ,"","error");
      }
    },error: function (error) {
      console.log(error);
    }
  });
}

var validateForm2 = function() {
  jQuery("#form-negocio").validationEngine('attach',{
    onValidationComplete:function(form, status){
      if(status == true){
        updateEstablecimiento();
      }
    },
    onFailure: function(status, form, json, options){
      console.log("status:" , status);
      console.log("form:" , form);
      console.log("json:" , json);
      console.log("option:" , options);
    }
  });
  return false;
};

$("#btnSubmit").on('click', function(){
  $(".loading").show(500);
  $("#btnSubmit").hide();
})

validateForm();
validateForm2();

$("#frm-gal").on('submit', function(e){
  console.log("submit");
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type: "POST",
    url: url   + "/galeria",
    data: formData,
    mimeType: "multipart/form-data",
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.msg) {
        swal(data.msg, "", "success");
        window.location.href = url + "/dashboard/mi-galeria";
      } else if (data.error) {
        $('#btnSubmitGaleria').show(500);
        $(".loading").hide(500);
        swal(data.error ,"","error");
      }
    },error: function (error) {
      console.log(error);
    }
  });
});

// galeria
$("#txtGaleria").on('change', function(e){
  $(".thumbs-galeria").html('');
  $("#btnSubmit").removeClass('color-11');
  count = 0;
  var files = e.target.files , filesLength = files.length;
  // validate format
  for (let i = 0, c = files.length; i < c; i++) {

    if(files[i].type != 'image/png'
    && files[i].type != 'image/jpeg'
    && files[i].type != 'image/png'
    && files[i].type != 'image/jpg'){
      return false;
    }
  }

  count++;

  if(filesLength > 5){
    swal("Sólo se permiten 5 archivos en formato .png o .jpg");
    return false;
  }

  for (let j = 0, d = filesLength; j < d; j++) {
    var f = files[j];
    var fileReader = new FileReader();
    fileReader.onload = (function(e) {
      $("#btnGaleria").html("REEMPLAZAR");
      $("#btnSubmit").addClass('color-11');
      $(".thumbs-galeria").append("<div class='col'><div class='item-gal'><a href=\"" + e.target.result + "\" class='fancybox'><img class=\"galeria-thumbnail w100\" src=\"" + e.target.result + "\"/></a></div></div>");
      $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
      });
      $(".remove-galeria").click(function(){

        $("#txtGaleria").val(null);

        $(".item-gal").each(function(){
          $(this).remove();
        });


      });
    });

    fileReader.readAsDataURL(f);
  }
});

// input files
$(".img-input").on('click', function(e){
  e.preventDefault();
  var attr =  $(this).attr('data-file');
  $('#txt' + attr).trigger('click');

});

// input files
$(".logo-badge").on('click', function(e){
  e.preventDefault();
  $('#txtLogo').trigger('click');
});

$(".fachada-badge").on('click', function(e){
  e.preventDefault();
  $('#txtFachada').trigger('click');
});


$(".upd-gal").on('submit' , function(e){
  e.preventDefault();

  var data = $(this).serialize();
  $.ajax({
    type: "POST",
    url: url   + "/upd-gal",
    data: data,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {

      if (data.msg) {
        swal(data.msg, "", "success");

      } else if (data.error) {
        swal(data.error ,"","error");
      }
    },error: function (error) {
      console.log(error);
    }
  });
});

$(".delete-button").on('click' , function(e){

  e.preventDefault();
  var id = $(this).attr('data-id');
  var path = $(this).attr('data-path');
  $.ajax({
    type: "POST",
    url: url   + "/dlt-gal",
    data: {"id" : id , "path" : path},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      if (data.msg) {
        swal(data.msg, "", "success");
        window.location.href = url + "/dashboard/mi-galeria";
      } else if (data.error) {
        swal(data.error ,"","error");
      }
    },error: function (error) {
      console.log(error);
    }
  });

});

// logo
$("#txtLogo").on('change', function(e){
  $(".logo-thumbnail").remove();
  count = 0;
  var files = e.target.files , filesLength = files.length;

  // validate format
  for (let i = 0, c = files.length; i < c; i++) {

    if(files[i].type != 'image/png'
    && files[i].type != 'image/jpeg'
    && files[i].type != 'image/png'
    && files[i].type != 'image/jpg'){
      return false;
    }
  }

  count++;
  for (let j = 0, d = filesLength; j < d; j++) {
    var f = files[j];
    var fileReader = new FileReader();

    fileReader.onload = (function(e) {
      $(".logo-badge").attr("src" , e.target.result);

    });
    fileReader.readAsDataURL(f);
  }
});


$('.owl-banner').owlCarousel({
    loop:false,
    margin:0,
    items: 1,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true
  });

    $('.owl-empresas').owlCarousel({
    loop: $('.owl-empresas .item').length > 1 ? true : false,
    margin:15,
    items: 5,
    autoplay:true,
    autoplayHoverPause:true,
    nav: true,
    center: true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
        }
    }
  });

  $('.owl-instituciones').owlCarousel({
    loop: $('.owl-instituciones .item').length > 1 ? true : false,
    margin:15,
    items: 3,
    autoplay:true,
    autoplayHoverPause:true,
    responsiveClass:true,
    center:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:3,
        }
    }
  });

  $('.owl-galeria').owlCarousel({
    loop: $('.owl-galeria .item').length > 1 ? true : false,
    margin:15,
    items: 3,
    autoplay:true,
    autoplayHoverPause:true,
    responsiveClass:true,
    center:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:3,
        }
    }
  });



  $(window).scroll(function(){
    var scroll = $(this).scrollTop();
    if(scroll > 1){

        $("#header").css({"background" : "rgba(207, 0, 15, .8)"});
    }else{
        $("#header").css({"background" : "rgba(207, 0, 15, .8)"});
    }
});

$(document).ready(function(){
$('.ui.dropdown').dropdown();
$('.ui.sticky')
  .sticky({
    context: '#stickForm'
  })
;
});

$("#btnLimpiar").click(function(e) {
    e.preventDefault();
    $("#frmBusqueda")[0].reset();
});

$(document).ready(function () {

  $('#agregar_producto_btn').on('click', (e) => {
    const form = $('#agregar_producto_form');
    const saveBtn = $('#salvar_nuevo_btn');

    $('#agregar_producto').modal({
      onDeny: () => form.trigger('reset'),
      onApprove: () => {
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
          return false;
        }

        const formData = new FormData(document.getElementById('agregar_producto_form'))
        saveBtn.addClass('loading');

        $.ajax({
          type: "POST",
          url: "/agrega-producto",
          data: formData,
          mimeType: "multipart/form-data",
          contentType: false,
          processData: false,
          cache: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).done(function (response) {
          location.reload();
        }).always(() => saveBtn.removeClass('loading'));

        return false;
      }
    }).modal('show')
  });

  $('.editar_producto_btn').on('click', (e) => {
    const form = $('#editar_producto_form');
    const saveBtn = $('#salvar_edicion_btn');
    const {nombre, descripcion, id, galeria} = e.currentTarget.dataset;

    const template = (src) => `<div class="card">
    <div class="image">
      <img src="${location.origin + '/' + src}" alt="Imagen de galería">
    </div>
  </div>`;

    $('input[name="nombre_producto"]', form).val(nombre);
    $('textarea[name="descripcion_producto"]', form).val(descripcion);
    $('.galeria', form).html(JSON.parse(galeria).map(v => template(v.img)));

    $('#editar_producto').modal({
      onDeny: () => form.trigger('reset'),
      onApprove: () => {
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
          return false;
        }

        const formData = new FormData(form[0]);
        formData.append('id', id);
        saveBtn.addClass('loading');

        $.ajax({
          type: "POST",
          url: "/actualiza-producto",
          data: formData,
          mimeType: "multipart/form-data",
          contentType: false,
          processData: false,
          cache: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).done(function (response) {
          location.reload();
        }).always(() => saveBtn.removeClass('loading'));

        return false;
      }
    }).modal('show');
  });

  $('.borrar_articulo').on('click', (e) => {
    const saveBtn = $('.ui.green.ok');
    const {id} = e.currentTarget.dataset;
    $('.ui.basic.modal').modal({
      onApprove: () => {
        saveBtn.addClass('loading');
        $.ajax({
          type: "DELETE",
          url: "/borra-producto",
          data: {id},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).done(function (response) {
          location.reload();
        }).always(() => saveBtn.removeClass('loading'));

        return false;
      }
    }).modal('show');
  });

  $('.votar_producto').on('click', function (e) {
    const {tipoVoto, id} = e.currentTarget.dataset;
    const esCambioVoto = +(estaVotado(`producto_${id}`) !== null);

    if (estaVotado(`producto_${id}`) !== tipoVoto) {
      $.ajax({
        type: "POST",
        url: "/vota-producto",
        data: {id, tipoVoto, esCambioVoto},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (response) {
        localStorage.setItem(`producto_${id}`, tipoVoto);
        location.reload();
      });
    }

  });

  const marcarProductosVotados = () => {
    const productos = $('.producto');
    productos.each((index, value) => {
      marcarSiVotado(value);
    });
  };

  const estaVotado = (id) => {
    return localStorage.getItem(id);
  }

  const marcarSiVotado = (item) => {
    const votado = estaVotado(item.id);
    if (votado) {
      const tipo = votado === 'voto_negativo' ? 'down' : 'up';
      $(`.thumbs.${tipo}`, item).removeClass('outline');
    }
  }

  marcarProductosVotados();
})
