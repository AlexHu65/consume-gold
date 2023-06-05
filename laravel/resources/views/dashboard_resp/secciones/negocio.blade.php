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
                    <img style="height:84px;width: 84px;cursor:pointer;" class="circle logo-badge" src="{{asset('storage') . '/' . ($negocio->logo ?  $negocio->logo->img : 'placeholder-logo.png') }}">
                    <img style="height:45px;cursor:pointer;float:right;background:whitesmoke;padding:5px;" class="circle fachada-badge" src="{{asset('images/camera.png')}}">
                  </div>
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

                    <input id="txtNombreNegocio" type="text" name="txtNombreNegocio" class="validate[required ,custom[onlyLetterNumber]] s13" value="{{$negocio->nombre}}">
                    <label for="txtNombreNegocio">Nombre*</label>
                  </div>

                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="txtDescripcion" name="txtDescripcion" class="validate[required ,custom[onlyLetterNumber]] materialize-textarea s13" value="{{$negocio->descripcion}}">{{$negocio->descripcion}}</textarea>
                    <label for="txtDescripcion">Descripcion*</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <div id="check-giro" class="text-left form-group">
                      <label>Elije el giro de tu negocio</label>
                      <?php
                      $giro = (json_decode($negocio->giro));
                      ?>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Alimentos y bebidas' , $giro) ? 'checked' : '')}}  name="txtGiro[]" type="checkbox" value="Alimentos y bebidas"><span>Alimentos y bebidas</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Abarrotes' , $giro) ? 'checked' : '')}}  name="txtGiro[]" type="checkbox" value="Abarrotes"><span>Abarrotes</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Asesoría y consulta' , $giro) ? 'checked' : '')}}  name="txtGiro[]" type="checkbox" value="Asesoría y consulta"><span>Asesoría y consulta</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Automotriz' , $giro) ? 'checked' : '')}}  name="txtGiro[]" type="checkbox" value="Automotriz"><span>Automotriz</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Carne, fruta y despensa' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Carne, fruta y despensa"><span>Carne, fruta y despensa</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Clases online' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Clases online"><span>Clases online</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Deportes' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Deportes"><span>Deportes</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Hogar' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Hogar"><span>Hogar</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Mascotas' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Mascotas"><span>Mascotas</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Médicos y terapias' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Médicos y terapias"><span>Médicos y terapias</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Música y entretenimiento' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Médicos y terapias"><span>Música y entretenimiento</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Otros' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Otros"><span>Otros</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Panadería y repostería' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Panadería y repostería"><span>Panadería y repostería</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Ropa zapatos y accesorios' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Ropa zapatos y accesorios"> <span>Ropa zapatos y accesorios</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Salud y belleza' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Salud y belleza"> <span>Salud y belleza</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Servicio' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Servicio"> <span>Servicio</span>
                        </label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input class="giro-check" {{(in_array('Ventas de productos' , $giro) ? 'checked' : '')}} name="txtGiro[]" type="checkbox" value="Venta de productos"> <span>Ventas de productos</span>
                        </label>
                      </div>                     


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
                  <small>Lista de productos*</small>
                  <input class="validate[custom[onlyLetterNumber]] textInput required s13 w100" type="text" id="txtProductosList" data-msg="lista" name="txtProductosList" value="{{$product}}">
                </div>
                <div class="divider"></div>
                <div class="row mt-3">
                  <div class="col">

                    <h3 class="active-red s18">Ubicación.</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtPostal" type="text" name="txtPostal" class="validate[required ,custom[onlyNumberSp]]  s13" value="{{$negocio->codigo_postal}}">
                    <label for="txtPostal">Código postal*</label>
                  </div>
                  <div class="input-field col s4">
                    <input id="txtCalle" type="text" name="txtCalle" class="validate[required ,custom[onlyLetterNumber]] s13" value="{{$negocio->calle}}">
                    <label for="txtCalle">Calle*</label>
                  </div>

                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtEntreCalles" type="text" name="txtEntreCalles" class="validate[custom[onlyLetterNumber]] s13" value="{{$negocio->entre_calles}}">
                    <label for="txtEntreCalles">Entre calles</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtNumero" type="text" name="txtNumero" class="validate[required ,custom[onlyLetterNumber]] s13" value="{{$negocio->numero}}">
                    <label for="txtNumero">Número*</label>
                  </div>
                  <div class="input-field col s4">
                    <input id="txtInterior" type="text" name="txtInterior" class="validate[custom[onlyLetterNumber]] s13" value="{{$negocio->interior}}">
                    <label for="txtInterior">Número interior</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <small class="text-muted">Colonia*</small>
                    <select class="browser-default" id="txtColonia" name="txtColonia">
                      <option class="s13" value="{{$negocio->colonia}}" selected>{{$negocio->colonia}}</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <select id="txtCiudad" name="txtCiudad">
                      <option class="s13" value="{{$negocio->ciudad}}" selected>{{$negocio->ciudad}}</option>
                      @foreach($ciudades as $ciudad)
                      <option class="s13" value="{{$ciudad->nombre}}">{{$ciudad->nombre}}</option>
                      @endforeach
                    </select>
                    <label>Ciudad*</label>
                  </div>

                </div>
                <div class="divider"></div>
                <div class="row mt-3">
                  <div class="col">

                    <h3 class="active-red s18">Contacto.</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtTelefonoNegocio" type="text" name="txtTelefonoNegocio" class="validate[required ,custom[phone]] s13" value="{{$negocio->telefono}}">
                    <label for="txtTelefonoNegocio">Teléfono*</label>
                  </div>
                  <div class="input-field col s4">
                    <input id="txtWhatsapp" type="text" name="txtWhatsapp" class="validate[required ,custom[phone]] s13" value="{{$negocio->whatsapp}}">
                    <label for="txtWhatsapp">WhatsApp*</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtEmailNegocio" type="email" name="txtEmailNegocio" class="validate[custom[email]] s13" value="{{$negocio->email_negocio}}">
                    <label for="txtEmailNegocio">Email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="text-left form-group">
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
                    <div class="text-left form-group">
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
                  <div class="input-field col s4">
                    <input id="txtCelular" type="text" name="txtCelular" class="validate[custom[phone]] s13" value="{{$negocio->celular}}">
                    <label for="txtCelular">Teléfono celular</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtFacebook" type="text" name="txtFacebook" class="validate[custom[url]] s13" value="{{$negocio->facebook}}">
                    <label for="txtFacebook">Facebook</label>
                  </div>
                  <div class="input-field col s4">
                    <input id="txtInstagram" type="text" name="txtInstagram" class="validate[custom[url]] s13" value="{{$negocio->instagram}}">
                    <label for="txtInstagram">Instagram</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input id="txtWeb" type="text" name="txtWeb" class="validate[custom[url]] s13" value="{{$negocio->web}}">
                    <label for="txtWeb">Página web</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="text-left form-group">
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
                <div class="row">
                  <div class="col s12">
                    <button id="btnSubmit2" class="btn-hover color-9 s13" type="submit" name="action">GUARDAR</button>
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
