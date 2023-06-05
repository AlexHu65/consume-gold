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
            <h2 class="active-red advent">DATOS DE MI NEGOCIO</h2>
            <!-- <div class="float-right s25 radical-red"><i class="fas fa-heart"></i> <small class="text-muted s13">Likes: {{$negocio->likes}}</small> </div> -->
            <p class="text-muted">
              Aquí puedes cambiar los datos que la comunidad ve de tu negocio.
            </p>
          </div>
          @if($negocio)
          <div class="content">
            <div class="row">

              <form id="form-negocio" method="post"  action="{{url('/')}}/update-establecimiento" enctype="multipart/form-data" class="col s12">
                @csrf
                <div class="row">
                  <div style="background:url({{asset('storage') . '/' .  ($negocio->fachada ?  $negocio->fachada->img : 'placeholder-fachada.jpg')}});width: 100%;height: 250px;background-repeat: no-repeat;padding: 15px;background-size: cover;background-position: center;" class="content-fachada">
                    <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;cursor: pointer;" class="circle logo-badge ui tiny circular image" src="{{asset('storage') . '/' . ($negocio->logo ?  $negocio->logo->img : 'placeholder-logo.png') }}">
                  </div>
                  <strong style="cursor: pointer" class="fachada-badge hover"><i class="ui home icon"></i>Cambiar fachada</strong>
                </div>
                <input type="hidden" name="txtId" value="{{$negocio->id}}">
                @if($negocio->logo)
                <input type="hidden" name="logoId" value="{{$negocio->logo->id}}">
                @endif
                @if($negocio->fachada)
                <input type="hidden" name="fachadaId" value="{{$negocio->fachada->id}}">
                @endif
                <div class="row">
                  <div class="input-field col s4">

                    <input class="dn" type="file" id="txtLogo" name="txtLogo" accept="image/x-png,image/jpeg"/>
                    <input class="dn" type="file" id="txtFachada" name="txtFachada" accept="image/x-png,image/jpeg"/>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col-sm-12 s12 pt-3">
                    <label for="txtNombreNegocio">Nombre*</label>
                    <input id="txtNombreNegocio" type="text" name="txtNombreNegocio" class="validate[required ,custom[onlyLetterNumber]] s13 form-control" value="{{$negocio->nombre}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col-sm-12 s12 pt-3">
                    <label for="txtDescripcion">Descripcion*</label>
                    <textarea id="txtDescripcion" name="txtDescripcion" class="form-control validate[required ,custom[onlyLetterNumber]] materialize-textarea s13" value="{{$negocio->descripcion}}">{{$negocio->descripcion}}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col-sm-12 s12 pt-3">
                    <div id="check-giro" class="text-left form-group">
                      <label for="txtGiro">Elije el giro de tu negocio</label>
                      <?php
                      $giro = (json_decode($negocio->giro, true));
                      ?>
                      @foreach($categorias as $categoria)
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array($categoria->nombre , $giro) ? 'checked' : '')}}  name="txtGiro[]" type="checkbox" value="{{$categoria->nombre}}"><span>{{$categoria->nombre}}</span>
                        </label>
                      </div>
                      @endforeach
                      <div class="text-left  help-msg"><small class="form-text text-muted dn msg-giro red-font"></small></div>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <?php
                  $productos =  json_decode($negocio->lista_productos);
                  $product = "";
                  for ($i=0; $i < count($productos) ; $i++) {
                    $product .=  $productos[$i]->value . ",";
                  }
                  ?>
                  <div class="input-field col-sm-12 s12 pt-3">
                    <label for="txtProductosList">Lista de productos*</label>
                    <input class="validate[custom[onlyLetterNumber]] textInput required s13 w100" type="text" id="txtProductosList" data-msg="lista" name="txtProductosList" value="{{$product}}">

                  </div>
                </div>
                <div class="ui divider"></div>
                <div class="row mt-3">
                  <div class="col">
                    <h3 class="advent active-red s18">Ubicación.</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtPostal">Código postal*</label>
                    <input id="txtPostal" type="text" name="txtPostal" class="form-control validate[required ,custom[onlyNumberSp]]  s13" value="{{$negocio->codigo_postal}}">
                  </div>
                  <div class="input-field col s4 pt-3">
                    <label for="txtCalle">Calle*</label>
                    <input id="txtCalle" type="text" name="txtCalle" class="form-control validate[required ,custom[onlyLetterNumber]] s13" value="{{$negocio->calle}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtEntreCalles">Entre calles</label>
                    <input id="txtEntreCalles" type="text" name="txtEntreCalles" class="form-control validate[custom[onlyLetterNumber]] s13" value="{{$negocio->entre_calles}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtNumero">Número*</label>
                    <input id="txtNumero" type="text" name="txtNumero" class="form-control validate[required ,custom[onlyLetterNumber]] s13" value="{{$negocio->numero}}">
                  </div>
                  <div class="input-field col s4 pt-3">
                    <label for="txtInterior">Número interior</label>
                    <input id="txtInterior" type="text" name="txtInterior" class="form-control validate[custom[onlyLetterNumber]] s13" value="{{$negocio->interior}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtColonia">    Colonia</label>
                    <select class="form-control" id="txtColonia" name="txtColonia">
                      <option class="s13" value="{{$negocio->colonia}}" selected>{{$negocio->colonia}}</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtCiudad">Ciudad</label>
                    <select class="form-control" id="txtCiudad" name="txtCiudad">
                      <option class="s13" value="{{$negocio->ciudad}}" selected>{{$negocio->ciudad}}</option>
                      @foreach($ciudades as $ciudad)
                      <option class="s13" value="{{$ciudad->nombre}}">{{$ciudad->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                </div>
                <div class="ui divider"></div>
                <div class="row mt-3">
                  <div class="col">
                    <h3 class="active-red s18">Contacto.</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtTelefonoNegocio">Teléfono*</label>
                    <input id="txtTelefonoNegocio" type="text" name="txtTelefonoNegocio" class="form-control validate[required ,custom[phone]] s13" value="{{$negocio->telefono}}">
                  </div>
                  <div class="input-field col s4 pt-3">
                    <label for="txtTelefonoNegocio">Whatsapp*</label>
                    <input id="txtWhatsapp" type="text" name="txtWhatsapp" class="form-control validate[required ,custom[phone]] s13" value="{{$negocio->whatsapp}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtEmailNegocio">Email</label>
                    <input id="txtEmailNegocio" type="email" name="txtEmailNegocio" class="form-control validate[custom[email]] s13" value="{{$negocio->email_negocio}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="text-left form-group pt-3">
                      <label>¿Cuentas con entrega a domicilio?</label>
                      <p>
                        <label>
                          <input name="txtDomicilio" value="1" type="radio" {{($negocio->entrega_domicilio ? 'checked' : '')}}/>
                          <span>Si</span>
                        </label>
                        <label>
                          <input name="txtDomicilio" value="0" type="radio" {{(!$negocio->entrega_domicilio ? 'checked' : '')}}/>
                          <span>No</span>
                        </label>
                      </p>
                    </div>
                  </div>
                  <div class="col">
                    <div class="text-left form-group pt-3">
                      <label>¿Perteneces a Manos X Guanajuato?</label>
                      <p>
                        <label>
                          <input name="txtManos" value="1" type="radio" {{($negocio->manos_guanajuato ? 'checked' : '')}}/>
                          <span>Si</span>
                        </label>
                        <label>
                          <input name="txtManos" value="0" type="radio" {{(!$negocio->manos_guanajuato ? 'checked' : '')}}/>
                          <span>No</span>
                        </label>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtCelular">Teléfono celular</label>
                    <input id="txtCelular" type="text" name="txtCelular" class="form-control validate[custom[phone]] s13" value="{{$negocio->celular}}">

                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtFacebook">Facebook</label>
                    <input id="txtFacebook" type="text" name="txtFacebook" class="form-control validate[custom[url]] s13" value="{{$negocio->facebook}}">
                  </div>
                  <div class="input-field col s4 pt-3">
                    <label for="txtInstagram">Instagram</label>
                    <input id="txtInstagram" type="text" name="txtInstagram" class="form-control validate[custom[url]] s13" value="{{$negocio->instagram}}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <label for="txtWeb">Página web</label>
                    <input id="txtWeb" type="text" name="txtWeb" class="form-control validate[custom[url]] s13" value="{{$negocio->web}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="text-left form-group pt-3">
                      <label>¿Estas dispuesto a aceptar trueques?</label>
                      <p>
                        <label>
                          <input name="txtTrueques" value="1" type="radio" {{($negocio->trueques ? 'checked' : '')}}/>
                          <span>Si</span>
                        </label>
                        <label>
                          <input name="txtTrueques" value="0" type="radio" {{(!$negocio->trueques ? 'checked' : '')}}/>
                          <span>No</span>
                        </label>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="ui divider"></div>
                <div class="row mt-3">
                  <div class="col">
                    <h3 class="active-red s18">Video testimonial</h3>
                  </div>
                </div>
                @if($negocio->video_link)
                <div class="row mt-2">
                  <div class="col">
                    <iframe width="100%" height="500" src="https://www.youtube-nocookie.com/embed/{{$negocio->video_link}}?controls=0"
                      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                  </div>
                </div>
                @else
                <div class="row">
                  <div class="input-field col s4 pt-3">
                    <input id="videoTestimonial" type="file" accept="video/mp4,video/x-m4v,video/*" name="videoTestimonial">
                  </div>
                </div>
                @endif
                <div class="row mt-2">
                  <div class="col s12">
                    <button id="btnSubmit2" class="ui primary button" type="submit" name="action">GUARDAR</button>
                    <span class="co loading dn text-dark"><i class="fas fa-spinner fa-spin"></i> &nbsp;ENVIANDO...</span>
                  </div>
                </div>
              </form>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
