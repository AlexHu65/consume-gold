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
          <div class="col">
            <button id="agregar_producto_btn" class="ui right floated button primary">
              <i class="icon shopping bag"></i>
              Nuevo producto
            </button>
          </div>
          <div class="text-left s13 pb-3">
            <h2 class="active-red advent">Mis Productos</h2>
          </div>
          <div class="content">
            <div class="row">
              @if(count($productos) > 0)
                @foreach($productos as $producto)
                  <div class="col-6">
                    <div class="ui card mb-4">
                      <div class="image">
                        @if(isset($producto->fotos[0]))
                        <img src="{{asset($producto->fotos[0]->img)}}" alt="Imagen de producto">
                        @else
                          <img src="{{asset('storage') . '/' . 'placeholder-fachada.jpg'}}" alt="Imagen de producto">
                        @endif
                      </div>
                      <div class="content">
                        <a class="header">{{$producto->nombre}}</a>
                        <div class="meta">
                          @if($producto->voto_positivo > 0)
                            <i class="heart icon"></i>
                          {{$producto->voto_positivo*100/($producto->voto_positivo + $producto->voto_negativo)}}% gusta de tu producto
                          @else
                            <i class="eye slash icon"></i>
                            Tu producto aún no recibe valoraciones
                          @endif
                        </div>
                        <div class="description">
                          {{ $producto->descripcion }}
                        </div>
                      </div>
                      <div class="extra content">
                        <div class="ui two buttons">
                          <div class="ui basic primary button editar_producto_btn"
                               data-id="{{$producto->id}}"
                               data-nombre="{{$producto->nombre}}"
                               data-descripcion="{{$producto->descripcion}}"
                               data-galeria=@json($producto->fotos)
                          >
                            Editar
                          </div>
                          <div class="ui basic red button borrar_articulo" data-id="{{$producto->id}}">Borrar</div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-sm-12 col-md-12">
                  <h3 class="advent">Aún no has agregado productos</h3>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="ui modal" id="agregar_producto">
  <div class="header">Agregar producto</div>
  <div class="content">
    <form enctype="multipart/form-data" id="agregar_producto_form" class="ui form">
      <div class="field">
        <label>Nombre del producto</label>
        <input required type="text" name="nombre_producto" placeholder="Nombre del producto">
      </div>
      <div class="field">
        <label>Descripción</label>
        <textarea required name="descripcion_producto" placeholder="Descripción" rows="2"></textarea>
      </div>
      <div class="field">
        <label>Galería</label>
        <input type="file" accept="image/*" multiple name="galeria_producto[]">
      </div>
    </form>
  </div>
  <div class="actions">
    <div class="ui deny red button">
      Cancelar
    </div>
    <div class="ui positive right button" id="salvar_nuevo_btn">
      Agregar producto
    </div>
  </div>
</div>


<div class="ui modal" id="editar_producto">
  <div class="header">Editar producto</div>
  <div class="content">
    <form enctype="multipart/form-data" id="editar_producto_form" class="ui form">
      <div class="field">
        <label>Nombre del producto</label>
        <input required type="text" name="nombre_producto" placeholder="Nombre del producto">
      </div>
      <div class="field">
        <label>Descripción</label>
        <textarea required name="descripcion_producto" placeholder="Descripción" rows="2"></textarea>
      </div>
      <div class="field">
        <label>Galería</label>
      </div>
      <div class="ui three stackable cards galeria mb-1"></div>
      <div class="field">
        <label>...Y puedes agregar más imágenes</label>
        <input type="file" accept="image/*" multiple name="galeria_producto[]">
      </div>
    </form>
  </div>
  <div class="actions">
    <div class="ui deny red button">
      Cancelar
    </div>
    <div class="ui positive right button" id="salvar_edicion_btn">
      Guardar Cambios
    </div>
  </div>
</div>

<div class="ui basic modal">
  <div class="ui icon header">
    <i class="trash alternate icon"></i>
    Borrar articulo
  </div>
  <div class="content">
    <p class="text-center">¿Estás seguro de borrar este articulo?</p>
    <p class="text-center">Esta acción no se puede deshacer</p>
  </div>
  <div class="actions">
    <div class="ui red basic cancel inverted button">
      <i class="remove icon"></i>
      No
    </div>
    <div class="ui green ok inverted button">
      <i class="checkmark icon"></i>
      Yes
    </div>
  </div>
</div>
