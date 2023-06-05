require('./bootstrap');
require('./jquery-ui.min.js');
require('./jquery.validationEngine.js');
require('./jquery.validationEngine-es.js');
require('./select2.min.js');
require('./owl.carousel.min.js');
require('./materialize.min.js');
require('./uikit.min.js');
require('./uikit-icons.min.js');
require('./jquery.fancybox.min.js');
require('./nav.js');
require('./jQuery.tagify.min.js');
require('./sweetalert.min.js');
require('./jquery.fancybox.min.js');

intro  = sessionStorage.getItem("intro") || false;
if(!intro){
  sessionStorage.setItem("intro", true);
  window.location.href = url + '/intro';
}


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

$("#srcForm").validationEngine();


// deprecated version
(function ($) {
  $.fn.extend({
    size: function () {
      return $(this).length;
    }
  });
})(jQuery);

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  next_fs = $(this).parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
      next_fs.css({'left': left, 'opacity': opacity});
    },
    duration: 800,
    complete: function(){
      current_fs.hide();
      animating = false;
    }
  });
});

$(".previous").click(function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

  //show the previous fieldset
  previous_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    },
    duration: 800,
    complete: function(){
      current_fs.hide();
      animating = false;
    }
  });
});


var validateForm = {
  inputsText: $(".textInput"),
  inputsPhone: $(".phoneInput"),
  inputsNumber: $(".numberInput"),
  inputEmail: $(".emailInput"),
  valid :false,
  validation: function(){

    validateForm.required();
    validateForm.password();

    $(validateForm.inputsText).keyup(function(){

      var value = $(this).val();
      var input = $(this);
      var help = $(this).attr('data-msg');
      var required = $(input).hasClass('required');

      for (let d = 0, x = validateForm.rulesTxt.length; d < x; d++) {
        if(!validateForm.rulesTxt[d].regex.test(value)){
          if(required || value.length > 0){
            $('.msg-' + help).html(validateForm.rulesTxt[d].alertText);
            if(required && value.length <= 0){
              $('.msg-' + help).html("*Este campo es requerido");
            }
            $('.msg-' + help).show();
            $(input).focus();
            validateForm.valid = false;
          }else{
            $('.msg-' + help).html();
            $('.msg-' + help).hide(500);
            validateForm.valid = true;
          }
        }else{
          $('.msg-' + help).html();
          $('.msg-' + help).hide(500);
          validateForm.valid = true;
        };
      }

    });

    $(validateForm.inputsPhone).keyup(function(){
      var value = $(this).val();
      var input = $(this);
      var help = $(this).attr('data-msg');
      var required = $(input).hasClass('required');

      for (let d = 0, x = validateForm.rulesPhone.length; d < x; d++) {
        if(!validateForm.rulesPhone[d].regex.test(value)){
          if(required || value.length > 0){
            $('.msg-' + help).html(validateForm.rulesPhone[d].alertText);
            if(required && value.length <= 0){
              $('.msg-' + help).html("*Este campo es requerido");
            }
            $('.msg-' + help).show();
            validateForm.valid = false;
            $(input).focus();
          }else{
            $('.msg-' + help).html();
            $('.msg-' + help).hide(500);
            validateForm.valid = true;
          }
        }else{
          $('.msg-' + help).html();
          $('.msg-' + help).hide(500);
          validateForm.valid = true;
        };
      }
    });

    $(validateForm.inputEmail).keyup(function(){
      var value = $(this).val();
      var input = $(this);
      var help = $(this).attr('data-msg');
      var required = $(input).hasClass('required');

      for (let d = 0, x = validateForm.inputEmail.length; d < x; d++) {
        if(!validateForm.ruleEmail[d].regex.test(value)){
          if(required || value.length > 0){
            $('.msg-' + help).html(validateForm.ruleEmail[d].alertText);
            if(required && value.length <= 0){
              $('.msg-' + help).html("*Este campo es requerido");
            }
            $('.msg-' + help).show();
            validateForm.valid = false;
            $(input).focus();
          }else{
            $('.msg-' + help).html();
            $('.msg-' + help).hide(500);
            validateForm.valid = true;
          }
        }else{
          $('.msg-' + help).html();
          $('.msg-' + help).hide(500);
          validateForm.valid = true;
        };
      }
    });

    $(validateForm.inputsNumber).keyup(function(){
      var value = $(this).val();
      var input = $(this);
      var help = $(this).attr('data-msg');
      var required = $(input).hasClass('required');

      for (let d = 0, x = validateForm.inputsNumber.length; d < x; d++) {
        if(!validateForm.rulesNumber[d].regex.test(value)){
          if(required || value.length > 0){
            $('.msg-' + help).html(validateForm.rulesNumber[d].alertText);
            if(required && value.length <= 0){
              $('.msg-' + help).html("*Este campo es requerido");
            }
            $('.msg-' + help).show();
            validateForm.valid = false;
            $(input).focus();
          }else{
            $('.msg-' + help).html();
            $('.msg-' + help).hide(500);
            validateForm.valid = true;
          }
        }else{
          $('.msg-' + help).html();
          $('.msg-' + help).hide(500);
          validateForm.valid = true;
        };
      }
    });

  },
  password: function(){

    pass1 = "";
    pass2 = "";

    $(".password1").keyup(function(){
      pass1= $(this).val();
      if(!pass1){
        $('.msg-pass').html('*Las contraseñas no coinciden.');
        $('.msg-pass').show();
        validateForm.valid = false;
      }
      if(pass2 != pass1){
        $('.msg-pass').html('*Las contraseñas no coinciden.');
        $('.msg-pass').show();
        validateForm.valid = false;
      }else{
        validateForm.valid = true;
        $('.msg-pass').hide(500);
        $('.msg-pass').html('');
      }
    });

    $(".password2").keyup(function(){
      pass2= $(this).val();
      if(!pass2){
        $('.msg-pass').html('*Las contraseñas no coinciden.');
        $('.msg-pass').show();
        validateForm.valid = false;

      }
      if(pass1 != pass2){
        $('.msg-pass').html('*Las contraseñas no coinciden.');
        $('.msg-pass').show();
        validateForm.valid = false;
      }else{
        validateForm.valid = true;
        $('.msg-pass').hide(500);
        $('.msg-pass').html('');
      }
    });



  },
  required: function(){
    // este lo validamos cuando enviemos el formulario

    // var required = $(".required");
    // var value = required.val();
    // var help =$(".required").attr('data-msg');
    //
    // if(required && value.length <= 0){
    //   $('.msg-' + help).html("*Este campo es requerido");
    //   $('.msg-' + help).show();
    //   validateForm.valid = false;
    // }

  },
  rulesTxt:[
    {"regex" : /^[0-9a-zA-ZÁáÉéÍíÓóÚúñ., ]+$/ , "alertText" : "* No se permiten caracteres especiales."},
  ],
  rulesNumber:[
    {"regex" : /^[0-9]+$/ , "alertText" : "*Sólo se permiten números."},
  ],
  rulesPhone:[
    {"regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,"alertText": "*Número invalido."}
  ],
  ruleEmail:[
    {"regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
    "alertText": "* Correo inválido"}
  ],
  init: function(){
    validateForm.validation();
  }
};

// input files
$(".img-input").on('click', function(e){
  e.preventDefault();
  var attr =  $(this).attr('data-file');
  $('#txt' + attr).trigger('click');

});

$("#msform input").each(function(){
  validateForm.validation();
});

validateForm.init();

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

$('[name=txtProductosList]').tagify({
  duplicates :false,
  pattern: /^[0-9a-zA-ZÁáÉéÍíÓóÚúñ ]+$/
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
      var file = e.target;
      $(".thumb-logo").append("<a href=\"" + e.target.result + "\" class='fancybox'><img class=\"logo-thumbnail\" src=\"" + e.target.result + "\"/></a>");
      $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
      });
      $(".thumb-logo").show(500);
      $(".remove-btn").click(function(){
        $(".logo-thumbnail").remove();
        $("#txtLogo").val(null);
        $(".thumb-logo").hide(500);

      });

    });
    fileReader.readAsDataURL(f);
  }
});

// fachada
$("#txtFachada").on('change', function(e){
  $(".fachada-thumbnail").remove();
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
      var file = e.target;
      $(".thumb-fachada").append("<a href=\"" + e.target.result + "\" class='fancybox'><img class=\"fachada-thumbnail\" src=\"" + e.target.result + "\"/></a>");
      $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
      });
      $(".thumb-fachada").show(500);
      $(".remove-btn2").click(function(){
        $(".fachada-thumbnail").remove();
        $("#txtFachada").val(null);
        $(".thumb-fachada").hide(500);

      });

    });
    fileReader.readAsDataURL(f);
  }
});

// galeria
$("#txtGaleria").on('change', function(e){
  $(".item-gal").each(function(){
    $(this).remove();
  });
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
      $(".thumbs-galeria").append("<div class='item-gal'><a href=\"" + e.target.result + "\" class='fancybox'><img class=\"galeria-thumbnail\" src=\"" + e.target.result + "\"/></a></div>");
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


function validateChecks(){

  var checked = $("#check-giro input[type=checkbox]:checked").length;
  var validCheck = checked > 0;

  if(!validCheck){
    $('.msg-giro').html('*Selecciona al menos una opción');
    $('.msg-giro').show();
    validateForm.valid = false;

  }else{
    $('.msg-giro').html();
    $('.msg-giro').show();
    validateForm.valid = true;
  }

  $("#check-giro input[type=checkbox]").on('change' ,function(){
    var newcheck =  $("#check-giro input[type=checkbox]:checked").length;
    var valid = newcheck > 0;

    if(!valid){
      $('.msg-giro').html('*Selecciona al menos una opción');
      $('.msg-giro').show();
      validateForm.valid = false;

    }else{
      $('.msg-giro').html();
      $('.msg-giro').hide(500);
      validateForm.valid = true;
    }

  });
}

function validateTerminos(){

  var checked = $("#checkedAcepto:checked").length;
  var validCheck = checked > 0;


  if(!validCheck){
    $('.msg-acepto').html('*Debes aceptar nuestros términos y condiciones.');
    $('.msg-acepto').show();
    validateForm.valid = false;

  }else{
    $('.msg-acepto').html();
    $('.msg-acepto').show();
    validateForm.valid = true;
  }

  $("#checked-acepto").on('change' ,function(){
    var newcheck =  $("#checked-acepto:checked").length;
    var valid = newcheck > 0;
    if(!valid){
      $('.msg-acepto').html('*Debes aceptar nuestros términos y condiciones.');
      $('.msg-acepto').show();
      validateForm.valid = false;
    }else{
      $('.msg-acepto').html();
      $('.msg-acepto').hide(500);
      validateForm.valid = true;
    }
  });
}

validateChecks();


$('#msform').submit(function (e) {

  e.preventDefault();
  $(".tagify").removeClass("required");
  $(".required").each(function(){

    if($(this).val() == null || $(this).val() == ""){

      var help = $(this).attr('data-msg');
      $('.msg-' + help).html("*Este campo es requerido");
      $('.msg-' + help).show();
      validateForm.valid = false;
      swal("Verifica los campos requeridos" ,"" , "error");
    }
  });

  validateTerminos();

  // validar password de un usuario nuevo
  if(!$("#txtId")){
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var ps = $("#txtPass").val();

    if(!strongRegex.test(ps)){
      $('.msg-pass').html("*Contraseña invalida.");
      $(".msg-pass").show();
      validateForm.valid = false;
      swal("Contraseña inválida asegurate que contenga:" ,"1.- Al menos una minúscula. 2.- Una mayúscula. 3.- Un número. 4.- Un caracter especial. 5.- 8 caracteres." , "error");
    }

  }

  if(validateForm.valid){
    // start submit
    $('#btnSubmit').hide();
    $(".loading").show(500);
    e.preventDefault();
    var formData = new FormData(this);
    // var dataString = $("#msform").serialize();
    // validacion del captcha
    // $.ajax({
    //
    //   type: "POST",
    //   url: url + "/api/captcha",
    //   data: dataString,
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   },
    //   success: function (resp) {
    //     if (resp.error) {
    //       grecaptcha.reset();
    //       $('#btnSubmit').show(500);
    //       $(".loading").addClass('dn');
    //       $(".msg").show();
    //       $(".msg").html(resp.error);
    //     }
    //     if (resp.mensaje) {
    $.ajax({
      type: "POST",
      url: url   + "/add-registro",
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
          // $('#msform').trigger("reset");
          // grecaptcha.reset();
          $('#btnSubmit').hide(500);
          $(".loading").hide(500);
          window.location.href = url + "/registro/thank-you";
          // swal(data.msg, "", "success");

        } else if (data.error) {
          // grecaptcha.reset();
          $('#btnSubmit').show(500);
          $(".loading").addClass('dn');
          swal(data.error ,"","error");
        }
      },error: function (error) {
        console.log(error);
      }
    });
    // }
    // succes del captcha
    // }
    // termina validacion del captcha
    // });
  }else{
    swal("Verifica los campos requeridos" ,"" , "error");
  }

  // end submit
});

$(window).scroll(function(){
    var scroll = $(this).scrollTop();
    if(scroll > 1){

        $("#header").css({"background" : "rgba(207, 0, 15, .8)"});
    }else{
        $("#header").css({"background" : "rgba(207, 0, 15, .8)"});
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
    loop: true,
    margin:15,
    items: 5,
    autoplay:true,
    autoplayHoverPause:true,
    nav: false,
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
            nav:false,
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
    loop: $('.owl-instituciones .item').length > 1 ? true : false,
    margin:15,
    items: 1,
    autoplay:true,
    autoplayHoverPause:true,
    responsiveClass:true,
    center:true
  });

  $('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});

   $(".volver").on('click', function(){
        window.history.back();
    });

$(".buscarBtn").on('click' , function(){
  $("#srcForm").submit();  
});




  

