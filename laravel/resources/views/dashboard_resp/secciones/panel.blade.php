<section id="panel">
  <div id="wrapperPanel" class="container p-2 pt-5">
    <div class="row">
      <div class="col-sm-12 col-md-4">
        <!-- sidebar -->
        <div class="sidebar">
          @include('dashboard.secciones.sidebar')
        </div>
      </div>
      <div class="col-sm-12 col-md-8">
        <!-- content -->
        <div class="panel-content">
          <div class="text-left s13 pt-3 pb-3">
            <h2 class="active-red advent">MIS DATOS</h2>
            <p class="textMuted">Aquí puedes modificar tus datos personales y de acceso.</p>
          </div>
          <div class="content">
            <div class="row">
              <form id="form-user" method="post" action="{{url('/')}}/update-usuario" class="col s12">
                @csrf
                <div class="row">
                  <img style="height:84px;width: 84px;cursor:pointer;" class="circle" src="{{($user->facebook ?  $user->avatar :  asset('storage/') . '/' .$user->avatar)}}">
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtNombre" type="text" name="txtNombre" class="validate[required ,custom[onlyLetterNumber]] s13" value="{{$user->name}}">
                    <label for="txtNombre">Nombre*</label>
                  </div>
                  <div class="input-field col s4">
                    <input id="txtTelefonoPersonal" type="text" name="txtTelefonoPersonal" class="validate[required ,custom[phone]] s13" value="{{$user->telefono}}">
                    <label for="txtTelefonoPersonal">Teléfono*</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input  disabled id="email" type="email" name="txtEmail" class="validate s13" value="{{$user->email}}">
                  </div>
                </div>
                @if($user->password)
                <div class="row">
                  <div class="input-field col s12">
                    <input id="txtPass" name="txtPass" type="password" class="validate">
                    <label for="txtPass">Password</label>
                    <small class="text-muted active-red">*Dejar en blanco para mantener la misma contraseña.</small>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col s12">
                    <button id="btnSubmit" class="btn-hover color-9 s13" type="submit" name="action">GUARDAR</button>
                    <span class="co loading dn text-dark"><i class="fas fa-spinner fa-spin"></i> &nbsp;ENVIANDO...</span>

                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
