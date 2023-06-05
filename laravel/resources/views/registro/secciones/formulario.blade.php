<section class="pt-5 pb-5" id="formulario-registro">
  <style>
  body{
    background: #e7e7c7;
  }
  #header{
    background: rgba(207, 0, 15, .8);
  }
  #formulario-registro{
    padding-top: 155px !important;
    height: 1505px !important;
  }
  #msform fieldset{
    box-shadow: none !important;
  }
  #progressbar li{
    color: black !important;
    margin-bottom: 10px;
  }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4 pt-3">
        <!-- <div class="text-center">
        <img style="width:60%;" src="{{asset('images/logo-inverse.png')}}" alt="Logo White">
      </div> -->
      <h1 class="text-center advent active-red font-weight-bold">HAZLO LOCAL</h1>
      <p class="text-justify">
        Consume Guanajuato es una iniciativa sin ánimo de lucro que tiene el objetivo de unir a pequeños negocios y proveedores locales a reactivar su economía.
        <br>
        Incentivemos el consumo local para empezar a reconstruirnos desde casa, descubriendo la fuerza de los guanajuatenses para seguir de pie.
        <br>
      </p>
      <p class="text-center">
        <strong class="text-center advent active-red">¡Compártenos tus productos o servicios!</strong>
      </p>
      <div class="text-center">

        <img src="{{asset('images/login.jpg')}}" alt="Guanajuato">
      </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
      <form id="msform" autocomplete="false" enctype="multipart/form-data" method="post">
        <!-- progressbar -->
        <ul id="progressbar">

          <li class="active">Datos del solicitante</li>
          <li>Datos del negocio</li>
          <li>Ubicación</li>
        </ul>
        <!-- fieldsets -->
        @if(!isset($facebook))
        <!-- <fieldset>
        <h2 class="fs-title">Inicio de sesión</h2>
        <h3 class="fs-subtitle">Con estos datos puedes iniciar sesión.</h3>
        <div class="contenido mb-3">
        <div class="contenido2">
        <a href="{{ route('social.auth', 'facebook') }}" class="facebook-button text-light"> <i class="fab fa-facebook-square"></i> INICIAR SESIÓN CON FACEBOOK</a>
      </div>
    </div>
    <hr>
    <input class="required emailInput" type="text" data-msg="email" id="txtEmail" name="txtEmail" placeholder="Correo*"/>
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-email red-font"></small></div>

    <div class="text-left form-group">
    <input type="password" class="required password1" type="password" id="txtPass"  name="txtPass" placeholder="Contraseña*"/>
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-pass red-font"></small></div>

    <input type="password" class="required password2" type="password" id="txtPass2" name="txtPass2" placeholder="Confirma contraseña*"/>
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-pass red-font"></small></div>

  </div>
  <hr>
  <input type="button" id="next1" name="next" class="next action-button" value="Siguiente"/>
</fieldset> -->
@endif
<fieldset>
  <h2 class="fs-title">Datos del solicitante</h2>
  <h3 class="fs-subtitle">Queremos saber de ti</h3>
  <input class="textInput required" type="text" data-msg="name" id="txtNombre" name="txtNombre" placeholder="Nombre del dueño*"/>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-name red-font"></small></div>

  <input class="textInput" type="text" data-msg="apellidos" id="txtApellidos "name="txtApellidos" placeholder="Apellidos"/>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-apellidos red-font"></small></div>

  <input class="phoneInput" type="text" data-msg="telefono" id="txtTelefonoPersonal" name="txtPersonal" placeholder="Teléfono personal"/>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-telefono red-font"></small></div>
  <div class="text-center">
    <small class="text-center form-text text-muted">Para ver nuestro aviso de privacidad y uso de datos <a class="active-red" href="{{url('aviso-de-privacidad')}}">click aquí</a>.</small>
  </div>
  <input type="button" id="next1" name="next" class="next action-button" value="Siguiente"/>
</fieldset>
<fieldset>
  <h2 class="fs-title">Datos del negocio</h2>
  <h3 class="fs-subtitle">¡Ahora dinos sobre tu negocios! <br> ¡Nos interesa conocerlo!</h3>
  <input class="textInput required" type="text" id="txtNombreNegocio" data-msg="negocio" name="txtNombreNegocio" placeholder="Nombre del negocio*"/>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-negocio red-font"></small></div>
  <div class="row">
    <div class="col">
      <div class="text-left form-group">
        <label>Elegir nuevo logo:</label>
        <a class="img-input waves-effect waves-light btn custom-btn red darken-2 text-light" data-file="Logo"><i class="fas fa-arrow-circle-up"></i></a>
        <input class="dn" type="file" id="txtLogo" name="txtLogo" accept="image/x-png,image/jpeg"/>
        <div class="thumb-logo">
          <div data-img="logo" class="text-center remove-btn">
            <i class="far fa-trash-alt"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="text-left form-group">
        <label>Fachada de tu negocio:</label>
        <a class="img-input waves-effect waves-light btn custom-btn red darken-2 text-light" data-file="Fachada"><i class="fas fa-arrow-circle-up"></i></a>
        <input class="dn" type="file" id="txtFachada" name="txtFachada"  accept="image/x-png,image/jpeg"/>
        <div class="thumb-fachada">
          <div data-img="fachada" class="text-center remove-btn2">
            <i class="far fa-trash-alt"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <textarea class="textInput required" id="txtDescripcion" data-msg="descripcion" name="txtDescripcion" rows="10" cols="80" maxlength="120" placeholder="Describe el valor de tu negocio*"></textarea>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-descripcion red-font"></small></div>
  <div id="check-giro" class="text-left form-group">
    <label>Elije el giro de tu negocio</label>
    @foreach($categorias as $categoria)
    <div class="custom-control custom-checkbox">
      <label>
        <input class="giro-check"  name="txtGiro[]" type="checkbox" value="{{$categoria->nombre}}"><span>{{$categoria->nombre}}</span>
      </label>
    </div>
    @endforeach
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-giro red-font"></small></div>
  </div>
  <div class="text-left form-group">
    <label class="form-text text-muted">¿Qué productos ofreces?</label>
    <input class="textInput required" type="text" id="txtProductosList" data-msg="lista" name="txtProductosList" value="">
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-lista red-font"></small></div>

  </div>
  <small class="form-text text-muted">Para ver nuestro aviso de privacidad y uso de datos <a class="active-red" href="{{url('aviso-de-privacidad')}}">click aquí</a>.</small>
  <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
  <input type="button" name="next" class="next action-button" value="Siguiente"/>
</fieldset>
<fieldset>
  <h2 class="fs-title">Ubicación y datos del negocio</h2>
  <h3 class="fs-subtitle">¿Dónde podemos encontrar tu negocio?</h3>
  <input class="required phoneInput" type="text" id="txtPostal" data-msg="postal" name="txtPostal" placeholder="Código postal*"/>
  <div class="text-left  help-msg"><small class="form-text text-muted dn msg-postal red-font"></small></div>

  <div class="row">
    <div class="col">
      <input class="required textInput" type="text" id="txtCalle" data-msg="calle" name="txtCalle" placeholder="Calle*"/>
      <div class="text-left  help-msg"><small class="form-text text-muted dn msg-calle red-font"></small></div>
    </div>
    <div class="col">
      <input class="required numberInput" type="text" id="txtNumero" data-msg="numero" name="txtNumero" placeholder="Número*"/>
      <div class="text-left  help-msg"><small class="form-text text-muted dn msg-numero red-font"></small></div>
    </div>
  </div>
  <div class="text-left form-group">
    <label>Colonia o asentamiento*:</label>
    <select id="txtColonia" data-msg="colonia" class="select-search required" name="txtColonia">

    </select>
    <div class="text-left  help-msg"><small class="form-text text-muted dn msg-colonia red-font"></small></div>
  </div>
  <div class="text-left form-group">
    <label>Ciudad*:</label>
    <select class="required" id="txtCiudad" name="txtCiudad">
      @foreach($ciudades as $ciudad)
      <option data-id="{{$ciudad->id}}" value="{{$ciudad->nombre}}">{{$ciudad->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div class="row">
    <div class="col">
      <input class="required phoneInput" type="text" id="txtTelefonoNegocio" data-msg="telefono-negocio" name="txtTelefonoNegocio" placeholder="Teléfono de tu negocio*"/>
      <div class="text-left  help-msg"><small class="form-text text-muted dn msg-telefono-negocio red-font"></small></div>
    </div>
    <div class="col">
      <input class="required phoneInput" type="text" id="txtWhatsapp" data-msg="whatsapp" name="txtWhatsapp" placeholder="WhatsApp*"/>
      <div class="text-left  help-msg"><small class="form-text text-muted dn msg-whatsapp red-font"></small></div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="text-left form-group">
        <label>¿Cuentas con entrega a domicilio?</label>
        <p>
          <label>
            <input name="txtDomicilio" value="1" type="radio"/>
            <span>Si</span>
          </label>
          <label>
            <input name="txtDomicilio" value="0" type="radio" checked/>
            <span>No</span>
          </label>
        </p>
      </div>
    </div>
    <div class="col">
      <div class="text-left form-group">
        <label>¿Perteneces a Manos X Guanajuato?</label>
        <p>
          <label>
            <input name="txtManos" value="1" type="radio"/>
            <span>Si</span>
          </label>
          <label>
            <input name="txtManos" value="0" type="radio" checked/>
            <span>No</span>
          </label>
        </p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="text-left form-group">
        <label>¿Estas dispuesto a aceptar trueques entre usuarios de la comunidad?</label>
        <p>
          <label>
            <input name="txtTrueques" value="1" type="radio" checked/>
            <span>Si</span>
          </label>
          <label>
            <input name="txtTrueques" value="0" type="radio" />
            <span>No</span>
          </label>
        </p>
      </div>
    </div>
  </div>
  <div class="text-center">
    <small class="form-text text-muted">Para ver nuestro aviso de privacidad y uso de datos <a class="active-red" href="{{url('aviso-de-privacidad')}}">click aquí</a>.</small>
  </div>
  <div class="text-center custom-control custom-checkbox">
    <label>
      <input class="required" id="checkedAcepto" name="acepto" type="checkbox"> <span>Acepto las <a class="active-red" href="{{url('aviso-de-privacidad')}}">políticas de uso de datos</a>.</span>
    </label>
    <div class="text-center  help-msg"><small class="form-text text-muted dn msg-acepto red-font"></small></div>
  </div>
  @if(isset($facebook))
  <input type="hidden" name="txtIdUsuario"  value="{{$user->id}}">
  @endif
  <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
  <input id="btnSubmit" type="submit" name="submit" class="submit action-button" value="Enviar"/>
  <span class="co loading dn text-dark"><i class="fas fa-spinner fa-spin"></i> &nbsp;ENVIANDO...</span>
</fieldset>
</form>
</div>
</div>
</div>
</section>
