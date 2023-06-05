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
                    <div class="col-sm-12">
                        <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;cursor: pointer;" class="circle ui tiny circular image" src="{{($user->facebook ?  $user->avatar :  asset('storage/') . '/' .$user->avatar)}}">
                        
                    </div>
                    
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtNombre">Nombre*</label>
                    <input id="txtNombre" type="text" name="txtNombre" class="form-control validate[required ,custom[onlyLetterNumber]] s13" value="{{$user->name}}">
                  </div>
                  <div class="input-field col s4 pt-3">
                    <label for="txtTelefonoPersonal">Teléfono*</label>
                    <input id="txtTelefonoPersonal" type="text" name="txtTelefonoPersonal" class="form-control validate[required ,custom[phone]] s13" value="{{$user->telefono}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 pt-3">
                    <label for="txtEmail">Email*</label>
                    <input disabled id="email" type="email" name="txtEmail" class="form-control validate s13" value="{{$user->email}}">
                  </div>
                </div>
                @if($user->password)
                <div class="row">
                  <div class="input-field col s12 pt-3">
                    <label for="txtPass">Password</label>
                    <input id="txtPass" name="txtPass" type="password" class="form-control validate">
                    <small class="text-muted active-red">*Dejar en blanco para mantener la misma contraseña.</small>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col s12">
                    <button id="btnSubmit" class="ui primary button" type="submit" name="action">GUARDAR</button>
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
