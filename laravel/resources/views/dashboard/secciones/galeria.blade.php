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
            <h2 class="active-red advent">GALERÍA</h2>
            <p class="textMuted">Muestra tus productos con la comunidad.</p>
          </div>
          <div class="content">
            <div class="row">
              <div class="col-md-6">                
                <form method="post" id="frm-gal">
                  <input class="dn"  type="file" id="txtGaleria" name="txtGaleria[]" accept="image/x-png,image/jpeg" />
                  <input type="hidden" id="txtNombreNegocio" name="txtNombreNegocio" value="{{$negocio->nombre}}">
                  <input type="hidden" id="txtIdEstablecimiento" name="txtIdEstablecimiento" value="{{$negocio->id}}">
                  <div class="row">
                    <div class="input-field col-sm-12 s12">
                        <label for="txtCaption">Descripción*</label>

                        <textarea id="txtCaption" name="txtCaption" class="form-control s13"></textarea>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 pt-3">
                        <button id="btnGaleria" class="ui primary button img-input w100" data-file="Galeria" name="action">AGREGAR</button>
                      </div>
                      <div class="col-md-6 pt-3">
                        <span class="co loading dn text-dark s13"><i class="fas fa-spinner fa-spin"></i> &nbsp;ENVIANDO...</span>
                        <input id="btnSubmit" type="submit" name="submit" class="ui green button w100" value="SUBIR"/>
         
                    </div>
                </div>
            </form>
            </div>
            <div class="col-md-6">
<div class="thumbs-galeria"></div>
            </div>
            </div>
            <div class="ui divider"></div> 
            <h2 class="advent">Galería actual</h2>

            <div class="row">
              @foreach($galeria as $gal)
              <div class="col-sm-12 col-md-4">
                <div class="d-sm-flex flex-column justify-content-center align-items-center">
                  <div class="img-gal card text-center">
                    <a class="fancybox" rel="gallery1" href="{{asset('storage') . '/' . $gal->img}}" title="titulo">
                      <img class="w100" src="{{asset('storage') . '/' . $gal->img}}"/>
                    </a>
                  </div>
                  <form method="post" class="upd-gal">
                    <div class="caption">
                      <small class="text-muted">Descripción:</small>
                      <input type="hidden" name="txtGalId" value="{{$gal->id}}">
                      <input class="browser-default form-control s13" type="text" name="txtCaption" value="{{$gal->caption}}">
                    </div>
                    <div class="controls mt-2">
                      <button class="browser-default btn btn-primary s13 w100" type="submit" name="txtGaleria"><i class="fas fa-save"></i> GUARDAR</button>
                      <button class="browser-default btn btn-danger w100 s13 mt-2 delete-button" type="button" name="txtGaleria" data-path="{{$gal->img}}" data-id="{{$gal->id}}">BORRAR</button>
                    </div>
                  </form>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
