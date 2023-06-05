<?php

namespace App\Http\Controllers;

// from voyager

use App\Helpers\YoutubeMeta;
use App\Helpers\YoutubeUploader;
use App\Models\GaleriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use League\Flysystem\Util;
use TCG\Voyager\Facades\Voyager;


// Modelos
use App\Models\Comentario;
use App\Models\Banner;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\User;
use App\Models\Establecimiento;
use App\Models\Logo;
use App\Models\Fachada;
use App\Models\Galeria;
use App\Models\Institucione;
use App\Models\Noticia;
use App\Models\Like;
use App\Models\Categoria;

// request
use App\Http\Requests\ComentarioRequest;
use App\Http\Requests\NegocioRequest;
use App\Mail\MensajeMail;



class HomeController extends Controller
{


  public function intro()
  {
    $this->setIntro();
    return view('home.intro');
  }


  public function setIntro($lang="es"){
    session(['intro' => true]);
    session(['lang' => $lang]);
    return redirect()->route('home');
  }


  public function categorias(Request $request){

    $categorias = Categoria::where(['activo' => '1'])->get();
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $establecimientos = Establecimiento::search($request->categoria)->paginate();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();

    $parametros = [
      'establecimientos' => $establecimientos,
      'ciudades' => $ciudades,
      'banners' => $banners,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'tituloSection' => 'NEGOCIOS REGISTRADOS',
      'noticias' => $noticias,
      'user' => '',
      'categorias' => $categorias
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
      if($negocio){
        $parametros['negocio'] = $negocio;
      }
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('main.index' , $parametros);

  }

  public function mainInit(Request $request){

    $categorias = Categoria::where(['activo' => '1'])->get();
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $establecimientos = Establecimiento::where(['activo' => '1'])->paginate(15);
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();

    $parametros = [
      'establecimientos' => $establecimientos,
      'ciudades' => $ciudades,
      'banners' => $banners,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'tituloSection' => 'NEGOCIOS REGISTRADOS',
      'noticias' => $noticias,
      'user' => '',
      'categorias' => $categorias
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
      if($negocio){
        $parametros['negocio'] = $negocio;
      }
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('main.index' , $parametros);

  }

  public function busquedaGet(Request $request){

    $establecimientos = Establecimiento::search($request->src)->paginate();    
    $categorias = Categoria::where(['activo' => '1'])->get();
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();
    
    $parametros = [
      'establecimientos' => $establecimientos ,
      'ciudades' => $ciudades ,
      'banners' => $banners,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'noticias' => $noticias,
      'categorias' => $categorias,
      'tituloSection' => 'RESULTADO DE LA BÚSQUEDA: ' . $request->txtBusqueda,
      'user' => '',
      'busqueda' => true,
      'string' => $request->src
    ];

    // si tenemos el usuario autenticado
    if($request->user()){
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
      if($negocio){
        $parametros['negocio'] = $negocio;
      }
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('main.index' , $parametros); 

  }

  public function busqueda(Request $request){

    $establecimientos = Establecimiento::search($request->txtBusqueda)->get();    
    $categorias = Categoria::where(['activo' => '1'])->get();
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();
    $categoriaBusqueda ='';

    if(is_array($request->txtCategoria)){
      $categoriaBusqueda = implode(', ',$request->txtCategoria);
    }
    $busqueda = $request->txtBusqueda . ' ' . $request->txtCodigo . ' ' . $request->txtProducto . ' ' . $categoriaBusqueda;

    $establecimientos = Establecimiento::search($busqueda)->paginate();
    if($request->txtDomicilio == '1'){
      $establecimientos = Establecimiento::search($busqueda)->where('entrega_domicilio' , '1')->paginate();
    }
    $parametros = [
      'domicilio' => $request->txtDomicilio,
      'establecimientos' => $establecimientos ,
      'ciudades' => $ciudades ,
      'banners' => $banners,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'noticias' => $noticias,
      'categorias' => $categorias,
      'tituloSection' => 'RESULTADO DE LA BÚSQUEDA: ' . $request->txtBusqueda,
      'user' => '',
      'busqueda' => true,
      'string' => $busqueda
    ];

    // si tenemos el usuario autenticado
    if($request->user()){
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
      if($negocio){
        $parametros['negocio'] = $negocio;
      }
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('main.index' , $parametros);

  }

  public function index(Request $request){

    $establecimientos =  Establecimiento::where(['activo' => '1'])->inRandomOrder()->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $estados = Estado::all();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();
    $categorias = Categoria::where(['activo' => '1'])->get();


    // enviamos parametros a la vista
    $parametros = [
      'estados' => $estados,
      'banners' => $banners,
      'establecimientos' => $establecimientos,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'noticias' => $noticias,
      'user' => ''
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('home.index' , $parametros);
  }

  public function trueque(Request $request){
    $categorias = Categoria::where(['activo' => '1'])->get();
    $establecimientos =  Establecimiento::where(['activo' => '1' , 'trueques' => '1'])->inRandomOrder()->paginate(15);
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $estados = Estado::all();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();

    // enviamos parametros a la vista
    $parametros = [
      'estados' => $estados,
      'banners' => $banners,
      'establecimientos' => $establecimientos,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'noticias' => $noticias,
      'tituloSection' => 'TRUEQUE',
      'categorias' => $categorias,
      'contenidoHead' => 'El intercambio es una práctica ancestral que se basa en los valores de la
      empatía, solidaridad y gentileza. Las siguientes empresas están listas para hacer trueque contigo.'
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('trueque.index' , $parametros);
  }

  public function noticias(Request $request){

    $establecimientos =  Establecimiento::inRandomOrder()->limit(3)->get();
    $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
    $estados = Estado::all();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    $instituciones =  Institucione::where(['activo' => '1'])->get();
    $noticias =  Noticia::where(['activo'  => '1'])->get();

    // enviamos parametros a la vista
    $parametros = [
      'estados' => $estados,
      'banners' => $banners,
      'establecimientos' => $establecimientos,
      'intercambios' => $intercambio,
      'instituciones' =>$instituciones,
      'tituloSection' => 'NOTICIAS',
      'noticias' => $noticias,
      'contenidoHead' => 'Enterate de las últimas noticias.'
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('noticias.index' , $parametros);
  }


  public function noticiasInt(Request $request){

    if(isset($request->slug)){

      $establecimientos =  Establecimiento::inRandomOrder()->limit(3)->get();
      $intercambio =  Establecimiento::where(['activo'=> '1' , 'trueques' => '1' ])->inRandomOrder()->get();
      $estados = Estado::all();
      $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
      $instituciones =  Institucione::where(['activo' => '1'])->get();
      $noticias =  Noticia::where(['activo'  => '1' , 'slug' => $request->slug])->first();
      $nuevas = Noticia::where(['activo' => '1' , ['id' , '!=' , $noticias->id]])->orderBy('created_at', 'desc')->take(4)->get();
      // enviamos parametros a la vista
      $parametros = [
        'estados' => $estados,
        'banners' => $banners,
        'establecimientos' => $establecimientos,
        'intercambios' => $intercambio,
        'instituciones' =>$instituciones,
        'noticias' => $noticias,
        'tituloSection' => $noticias->titulo,
        'nuevas' => $nuevas,
        'contenidoHead' => 'Enterate de las última noticias.'
      ];
      // si tenemos el usuario autenticado
      if($request->user()){
        $parametros['user'] = $request->user();
      }
      // regresamos la vista compilada
      return view('noticias.interior' , $parametros);

    }else{
      return redirect('home');
    }
  }

  public function dashboard(Request $request){

    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();

    if(!$negocio){
      return redirect('registro');
    }
    $categorias = Categoria::where(['activo' => '1'])->get();

    $parametros['categorias'] = $categorias;
    $parametros['user'] = $request->user();
    $parametros['negocio'] = $negocio;
    $parametros['active1'] = true;
    return view('dashboard.index' , $parametros);

  }

  public function miNegocio(Request $request){
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
    if(!$negocio){
      return redirect('registro');
    }

    $categorias = Categoria::where(['activo' => '1'])->get();

    $parametros['categorias'] = $categorias;

    $parametros['active2'] = $request->user();
    $parametros['user'] = $request->user();
    $parametros['negocio'] = $negocio;
    $parametros['usuario'] = $request->user()->id;
    $parametros['ciudades'] = $ciudades;
    return view('dashboard.negocio' , $parametros);

  }

  public function misFavoritos(Request $request){
    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
    $likes = Like::where(['id_usuario' => $request->user()->id])->get();

    if(!$negocio){
      return redirect('registro');
    }

    $parametros['active4'] = $request->user();
    $parametros['user'] = $request->user();
    $parametros['negocio'] = $negocio;
    $parametros['likes'] = $likes;
    $parametros['usuario'] = $request->user()->id;
    return view('dashboard.favoritos' , $parametros);

  }

  public function misProductos(Request $request)
  {
    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
    $productos = Producto::where(['establecimiento_id' => $negocio->id])->get();

    if(!$negocio){
      return redirect('registro');
    }

    $parametros['active5'] = $request->user();
    $parametros['user'] = $request->user();
    $parametros['negocio'] = $negocio;
    $parametros['productos'] = $productos;
    $parametros['usuario'] = $request->user()->id;
    return view('dashboard.productos' , $parametros);
  }

  public function agregarProducto(Request $request)
  {
    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
    $producto = new Producto([
      'nombre' => $request->input('nombre_producto'),
      'descripcion' => $request->input('descripcion_producto'),
      'establecimiento_id' => $negocio->id
    ]);

    $producto->save();

    if ($request->hasFile('galeria_producto')) {
      foreach ($request->file('galeria_producto') as $foto) {
        $path = sprintf(
          'storage/productos/%s',
          str_replace(' ', '_', strtolower($negocio->nombre))
        );
        $fileName = sprintf('%d.%s', time(), $foto->getClientOriginalExtension());

        if ($result = $foto->move($path, $fileName)){
          $galeriaProducto = new GaleriaProducto([
            'img' => $result->getPathname(),
            'producto_id' => $producto->id
          ]);

          $galeriaProducto->save();
        }
      }
    }

    return response('Ok');
  }

  public function actualizarProducto(Request $request)
  {
    $negocio = Establecimiento::where(['activo' => '1', 'id_usuario' => $request->user()->id])->first();
    /** @var Producto $producto */
    $producto = Producto::where(['id' => $request->input('id')])->first();
    $producto->update([
      'nombre' => $request->input('nombre_producto'),
      'descripcion' => $request->input('descripcion_producto')
    ]);

    if ($request->hasFile('galeria_producto')) {
      foreach ($request->file('galeria_producto') as $foto) {
        $path = sprintf(
          'storage/productos/%s',
          str_replace(' ', '_', strtolower($negocio->nombre))
        );
        $fileName = sprintf('%d.%s', time(), $foto->getClientOriginalExtension());

        if ($result = $foto->move($path, $fileName)) {
          $galeriaProducto = new GaleriaProducto([
            'img' => $result->getPathname(),
            'producto_id' => $producto->id
          ]);

          $galeriaProducto->save();
        }
      }
    }

    return response('Ok');
  }

  public function borrarProducto(Request $request)
  {
    $producto = Producto::where(['id' => $request->input('id')])->first();
    /** @var GaleriaProducto $foto */
    foreach ($producto->fotos as $foto) {
      if (File::exists($foto->img)) {
        File::delete($foto->img);
      }

      $foto->delete();
    }

    $producto->delete();

    return response('Ok');
  }

  public function votarProducto(Request $request)
  {
    /** @var Producto $producto */
    $producto = Producto::where(['id' => $request->input('id')])->first();
    $campoProducto = $request->input('tipoVoto');
    if ((boolean)$request->input('esCambioVoto')) {
      $campoAnterior = $campoProducto != 'voto_positivo' ? 'voto_positivo' : 'voto_negativo';
      $producto->setAttribute($campoAnterior, (int) $producto->getAttributeValue($campoAnterior) - 1);
    }

    $producto->setAttribute($campoProducto, (int) $producto->getAttributeValue($campoProducto) + 1);
    $producto->save();

    return response('Ok');
  }

  public function ajaxData(Request $request){

    if(!empty($request->input('user'))){
      $user = $request->input('user');
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $user])->first();
      if($negocio){
        $negocios_cercanos =  Establecimiento::where(['activo' => '1'] , ['codigo_postal' , 'like' , $negocio->codigo_postal])->get();
        // buscamos los mas cercanos al del usuario
        return response($negocios_cercanos);
      }
    }


  }

  public function miGaleria(Request $request){
    $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();

    if(!$negocio){
      return redirect('registro');
    }

    $galeria = Galeria::where(['activo' => '1' , 'id_establecimiento' => $negocio->id])->get();
    $parametros['active3'] = $request->user();
    $parametros['user'] = $request->user();
    $parametros['negocio'] = $negocio;
    $parametros['galeria'] = $galeria;
    return view('dashboard.galeria' , $parametros);
  }

  public function deleteGaleria(Request $request){

    $id = $request->input('id');
    $fullPath = $request->input('path');

    if(Galeria::where('id' , $id)->delete()){
      if(Storage::disk(config('voyager.storage.disk'))->exists($fullPath)){
        if( Storage::disk(config('voyager.storage.disk'))->delete($fullPath)){
          return response(['msg' => 'Imágen borrada con éxito.']);
        }
      }else{
        return response(['error' => 'No existe nada que cambiar.']);
      }
    }

  }

  public function updateGaleria(Request $request){
    if($request->input('txtGalId')){

      $galeria =  Galeria::find($request->input('txtGalId'));
      $galeria->caption = $request->input('txtCaption');
      if($galeria->save()){
        return response(['msg' => 'Imágen guardada con éxito.']);
      }
    }else{
      return response(['error' => 'No existe nada que cambiar.']);
    }
  }

  public function addGaleria(Request $request){

    if($request->file('txtGaleria')){

      $id_establecimiento = $request->input("txtIdEstablecimiento");
      $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
      $categoria = 'galeria';

      for ($i=0; $i < count($request->file('txtGaleria')) ; $i++) {
        if($this->uploadCustom($request->file('txtGaleria')[$i], $negocio, $categoria)){

          $filename = basename($request->file('txtGaleria')[$i]->getClientOriginalName(), '.'.$request->file('txtGaleria')[$i]->getClientOriginalExtension());
          $path = $categoria . '/' . $negocio .'/'.date('F').date('Y').'/';
          $fullPath = $path.$filename.'.'.$request->file('txtGaleria')[$i]->getClientOriginalExtension();

          $galeria = new Galeria;
          $galeria->id_establecimiento = $id_establecimiento;
          $galeria->caption = $request->input('txtCaption');
          $galeria->img = $fullPath;
          if($galeria->save()){
            return response(['msg' => 'Archivo subido con éxito']);

          }

        }else{
          return response(['error' => 'Error al subir un archivo de su galeria']);
        }
      }
    }

  }

  public function registro(Request $request)
  {
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $categorias = Categoria::where(['activo' => '1'])->get();
    // regresamos la vista compilada
    $parametros = ['ciudades' => $ciudades];
    if($request->user() ){
      // verificamos si ya tiene un negocio registrado
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
      if($negocio){
        return redirect('/dashboard');
      }else{
        if($request->user()->facebook){
          $parametros['facebook'] = true;
        }
        $parametros['negocio'] = true;
        $parametros['user'] = $request->user();
      }
    }

    $parametros['categorias'] = $categorias;

    return view('registro.index', $parametros);
  }


  function ciudades(Request $request){
    $id = $request->input('id');
    $ciudades = Ciudad::where('provincia' , $id)->get();
    return view('home.secciones.ciudad', compact('ciudades'))->render();
  }

  public function updateInformacion(Request $request){

    $usuario = User::find($request->user()->id);
    $usuario->name = $request->input('txtNombre') . ' ' . $request->input('txtApellidos');
    $usuario->telefono = $request->input('txtTelefonoPersonal');
    if(!empty($request->input('txtPass'))){
      $usuario->password = Hash::make($request->input('txtPass'));
    }

    if($usuario->save()){
      return response(['msg'=>'Usuario actualizado.']);
    }
    return response(['error'=>'No se ha podido actualizar la información.']);
  }

  public function updateEstablecimiento(Request $request){

    $establecimiento = Establecimiento::find($request->input('txtId'));
    $establecimiento->nombre = $request->input('txtNombreNegocio');
    $establecimiento->descripcion = $request->input('txtDescripcion');
    $establecimiento->giro = $request->input('txtGiro');
    $establecimiento->lista_productos = $request->input('txtProductosList');
    $establecimiento->codigo_postal = $request->input('txtPostal');
    $establecimiento->calle = $request->input('txtCalle');
    $establecimiento->numero = $request->input('txtNumero');
    $establecimiento->colonia = $request->input('txtColonia');
    $establecimiento->ciudad = $request->input('txtCiudad');
    $establecimiento->telefono = $request->input('txtTelefonoNegocio');
    $establecimiento->whatsapp = $request->input('txtWhatsapp');
    $establecimiento->email_negocio = $request->input('txtEmailNegocio');
    $establecimiento->entrega_domicilio = $request->input('txtDomicilio');
    $establecimiento->manos_guanajuato = $request->input('txtManos');
    $establecimiento->celular = $request->input('txtCelular');
    $establecimiento->facebook = $request->input('txtFacebook');
    $establecimiento->instagram = $request->input('txtInstagram');
    $establecimiento->web = $request->input('txtWeb');
    $establecimiento->trueques = $request->input('txtTrueques');
    $establecimiento->interior = $request->input('txtInterior');
    $establecimiento->entre_calles = $request->input('txtEntreCalles');

    // return(response(['msg' => $request->input('txtLogo')]));
    if($request->file('txtLogo')){
      if($establecimiento->logo){
        // guardamos la ruta anterior
        $oldImg = $establecimiento->logo->img;
        // debemos validar si tiene imagen
        $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
        $file = $request->file('txtLogo');
        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $path =  'logos/' . $negocio .'/'.date('F').date('Y').'/';
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
        $logo = new Logo(['img' => $fullPath]);

        if($establecimiento->logo()->save($logo)){

          // start logo delete validation
          if(Logo::where('id' , $request->input('logoId'))->delete()){
            // borramos el viejo archivo comprobamos que exista
            if(Storage::disk(config('voyager.storage.disk'))->exists($oldImg)){
              if( Storage::disk(config('voyager.storage.disk'))->delete($oldImg)){
                // guardamos la nueva imagen
                // hacemos el rezise de la imagen
                $fullFilename = null;
                $resizeWidth = 800;
                $resizeHeight = null;
                $ext = $file->guessClientExtension();
                if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
                  $image = Image::make($file)
                  ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });
                  if ($ext !== 'gif') {
                    $image->orientate();
                  }
                  $image->encode($file->getClientOriginalExtension(), 75);

                  // move uploaded file from temp to uploads directory
                  if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $status = __('voyager::media.success_uploading');
                    $fullFilename = $fullPath;
                  } else {
                    return response(['error' => 'Se pudo subir nada.']);
                  }
                } else {
                  return response(['error' => 'Se pudo subir nada.']);
                }
              }
            }else{
              return response(['error' => 'No existe nada que cambiar.']);
            }
          }else{
            return response(['error' => "No se pudo eliminar el logo de la base de datos"]);
          }
        }
        // end validation logo delete
      }else{
        // un nuevo logo
        $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
        $file = $request->file('txtLogo');
        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $path =  'logos/' . $negocio .'/'.date('F').date('Y').'/';
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        if($this->uploadCustom($file, $negocio, 'logos')){
          $logo = new Logo;
          $logo->id_establecimiento = $request->input('txtId');
          $logo->img = $fullPath;
          if(!$logo->save()){
            return response (['msg' => 'No se pudo subir el logo nuevo.']);
          }
        }else{
          return response (['msg' => 'No se pudo subir el logo nuevo.']);
        }

      }

    }

    // terminamos de subir el logo empieza la fachada
    if($request->file('txtFachada')){

      if($establecimiento->fachada){
        // guardamos la ruta anterior
        $oldImg = $establecimiento->fachada->img;

        $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
        $file = $request->file('txtFachada');
        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $path =  'fachada/' . $negocio .'/'.date('F').date('Y').'/';
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
        $fachada = new Fachada(['img' => $fullPath]);

        if($establecimiento->fachada()->save($fachada)){

          // start logo delete validation
          if(Fachada::where('id' , $request->input('fachadaId'))->delete()){
            // borramos el viejo archivo comprobamos que exista
            if(Storage::disk(config('voyager.storage.disk'))->exists($oldImg)){
              if( Storage::disk(config('voyager.storage.disk'))->delete($oldImg)){
                // guardamos la nueva imagen
                // hacemos el rezise de la imagen
                $fullFilename = null;
                $resizeWidth = 800;
                $resizeHeight = null;
                $ext = $file->guessClientExtension();
                if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
                  $image = Image::make($file)
                  ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });
                  if ($ext !== 'gif') {
                    $image->orientate();
                  }
                  $image->encode($file->getClientOriginalExtension(), 75);

                  // move uploaded file from temp to uploads directory
                  if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $status = __('voyager::media.success_uploading');
                    $fullFilename = $fullPath;
                  } else {
                    return response(['error' => 'Se pudo subir nada.']);
                  }
                } else {
                  return response(['error' => 'Se pudo subir nada.']);
                }
              }
            }else{
              return response(['error' => 'No existe nada que cambiar.']);
            }
          }else{
            return response(['error' => "No se pudo eliminar el logo de la base de datos"]);
          }
        }
        // end validation logo delete
        // aqui ponemos la nueva fachada
      }else{
        // una nueva fachada
        $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
        $file = $request->file('txtFachada');
        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $path =  'fachada/' . $negocio .'/'.date('F').date('Y').'/';
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        if($this->uploadCustom($file, $negocio, 'fachada')){
          $logo = new Fachada;
          $logo->id_establecimiento = $request->input('txtId');
          $logo->img = $fullPath;
          if(!$logo->save()){
            return response (['msg' => 'No se pudo subir la nueva fachada.']);
          }
        }else{
          return response (['msg' => 'No se pudo subir el logo nuevo.']);
        }
      }

    }

    if ($testimonial = $request->file('videoTestimonial')) {
      $uploader = new YoutubeUploader();
      $meta = new YoutubeMeta(
        sprintf('Testimonial %s', $establecimiento->nombre),
        'Video testimonial para Consume Guanajuato',
        ['consume-gto']
      );

      $establecimiento->video_link = $uploader->__invoke($testimonial, $meta);
    }

    if($establecimiento->save()){
      return response(['msg'=>'Usuario actualizado.']);
    }
    return response(['error'=>'No se ha podido actualizar la información.']);
  }

  public function sendComentario(ComentarioRequest $request){
    $comentario = new Comentario;
    $comentario->nombre = $request->input('txtNombre');
    $comentario->email = $request->input('txtEmail');
    $comentario->telefono = $request->input('txtTelefono');
    $comentario->comentario = $request->input('txtComentario');
    $comentario->ciudad = $request->input('txtCiudad');
    $comentario->estado = $request->input('txtEstado');

    if($comentario->save()){
      // enviamos notificacion de email utilizando la clase
      // Mail::to(setting('site.correo'))->send(new MensajeMail($comentario));
      // enviamos respuesta al cliente
      return response(['msg'=>'Tu comentario ha sido enviado.']);
    }
    return response(['error'=>'Error al enviar tu mensaje']);
  }

  public function sendNegocio(Request $request){

    $loggedUser = false;
    $usuarioId = '';

    if($request->user()){
      $usuarioId = $request->user()->id;
      $loggedUser = true;
    }else{
      // subimos el usuario
      $usuario = new User;
      $usuario->name = $request->input('txtNombre') . ' ' . $request->input('txtApellidos');
      $usuario->telefono = $request->input('txtPersonal');
      $usuario->email = $request->input('txtEmail');
      // ponemos seguridad al password
      if($request->input('txtPass') === $request->input('txtPass2')){
        $usuario->password = Hash::make($request->input('txtPass2'));
      }else{
        return response(['error' => 'Contraseñas no coinciden.']);
      }
      $usuario->token_email =  Hash::make($request->input('txtNombre'));
      if($usuario->save()){
        $usuarioId = $usuario->id;
        $loggedUser = true;
      }
    }

    if($loggedUser && (!empty($usuarioId))){

      $id = $usuarioId;

      // guardamos los establecimientos
      $establecimientos = new Establecimiento;
      $establecimientos->id_usuario = $id;
      $establecimientos->nombre = $request->input('txtNombreNegocio');
      $establecimientos->descripcion = $request->input('txtDescripcion');
      $establecimientos->giro = json_encode($request->input('txtGiro'));
      $establecimientos->lista_productos = $request->input('txtProductosList');
      $establecimientos->codigo_postal = $request->input('txtPostal');
      $establecimientos->calle = $request->input('txtCalle');
      $establecimientos->numero = $request->input('txtNumero');
      $establecimientos->colonia = $request->input('txtColonia');
      $establecimientos->ciudad = $request->input('txtCiudad');
      $establecimientos->telefono = $request->input('txtTelefonoNegocio');
      $establecimientos->whatsapp = $request->input('txtWhatsapp');
      $establecimientos->trueques = $request->input('txtTrueques');
      $establecimientos->entrega_domicilio = $request->input('txtDomicilio');
      $establecimientos->slug = strtolower(str_replace(" ","-",$request->input('txtNombreNegocio')));

      if($establecimientos->save()){
        $id_establecimiento = $establecimientos->id;
        // se hace al final la subida de imágen

        $negocio = trim(str_replace(" ","_",strtolower($request->input('txtNombreNegocio'))));
        $categoria = 'logos';
        $file = $request->file('txtLogo');
        // subimos el logo
        if(!empty($file)){

          if($this->uploadCustom($file, $negocio, $categoria)){

            $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $path = $categoria . '/' . $negocio .'/'.date('F').date('Y').'/';
            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
            $logo = new Logo;
            $logo->id_establecimiento = $id_establecimiento;
            $logo->img = $fullPath;
            $logo->save();
            // subimos la fachada
            $categoria = 'fachada';
            $file = $request->file('txtFachada');
            if(!empty($file)){
              if($this->uploadCustom($file, $negocio, $categoria)){

                $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
                $path = $categoria . '/' . $negocio .'/'.date('F').date('Y').'/';
                $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
                $fachada = new Fachada;
                $fachada->id_establecimiento = $id_establecimiento;
                $fachada->img = $fullPath;
                $fachada->save();

                if($request->file('txtGaleria')){
                  $categoria = 'galeria';
                  for ($i=0; $i < count($request->file('txtGaleria')) ; $i++) {
                    if($this->uploadCustom($request->file('txtGaleria')[$i], $negocio, $categoria)){

                      $filename = basename($request->file('txtGaleria')[$i]->getClientOriginalName(), '.'.$request->file('txtGaleria')[$i]->getClientOriginalExtension());
                      $path = $categoria . '/' . $negocio .'/'.date('F').date('Y').'/';
                      $fullPath = $path.$filename.'.'.$request->file('txtGaleria')[$i]->getClientOriginalExtension();

                      $galeria = new Galeria;
                      $galeria->id_establecimiento = $id_establecimiento;
                      $galeria->img = $fullPath;
                      $galeria->save();

                    }else{
                      return response(['error' => 'Error al subir un archivo de su galeria']);
                    }
                  }
                }
              }
            }
          }
        }
      }else{
        return response(['error'=>'Establecimiento no guardado.']);
      }
    }else{
      return response(['error'=>'Usuario no guardado.']);
    }
    return response(['msg'=>'Usuario guardado.']);
  }

  protected function uploadCustom($file, $negocio, $categoria){

    // hacemos el rezise de la imagen
    $fullFilename = null;
    $resizeWidth = 800;
    $resizeHeight = null;

    // subimos la path al nombre del negocio
    $path = $categoria . '/' . $negocio .'/'.date('F').date('Y').'/';

    $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
    $filename_counter = 1;

    // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
    while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
      $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension()).(string) ($filename_counter++);
    }

    $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

    $ext = $file->guessClientExtension();

    if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
      $image = Image::make($file)
      ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      });
      if ($ext !== 'gif') {
        $image->orientate();
      }
      $image->encode($file->getClientOriginalExtension(), 75);

      // move uploaded file from temp to uploads directory
      if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
        $status = __('voyager::media.success_uploading');
        $fullFilename = $fullPath;
      } else {
        return false;
      }
    } else {
      return false;
    }

    // echo out script that TinyMCE can handle and update the image in the editor
    return true;

  }

  public function thankYou(){
    $parametros= ['thank' => true];
    return view('registro.index' , $parametros);
  }

  public function interiorNegocio(Request $request){

    $interior = Establecimiento::where(['activo' => '1' , 'slug' => $request->slug , 'id' => $request->id])->first();
    $ciudades = Ciudad::where(['provincia' => '11'])->get();
    $likes = Like::where(['id_establecimiento' => $interior->id]);
    $productos = Producto::where(['establecimiento_id' => $interior->id])->get();
    $negocio="";
    $user ="";
    $stringProducto = '';


    $productosLista = json_decode($interior->lista_productos, true);
    foreach ($productosLista as $k => $v) {
      $stringProducto .= ' '.$v['value'];
    }
    $busqueda = $stringProducto;

    $relacionados = Establecimiento::search($busqueda)->get();
    if($interior){

      // si tenemos el usuario autenticado
      if($request->user()){
        $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $request->user()->id])->first();
        if($negocio){
          $negocio = $negocio;
        }
        $user = $request->user();
      }

      $parametros = [
        'imgInt' => ($interior->logo ?  $interior->logo->img : 'placeholder-logo.png'),
        'tituloInt' => $interior->nombre,
        'descripcionInt' => $interior->descripcion,
        'interior' => $interior ,
        'negocio' => $request->slug ,
        'ciudades' => $ciudades ,
        'user' => $user ,
        'negocio' => $negocio,
        'likes' => $likes,
        'establecimientos' => $relacionados,
        'intProductos' => $productos
      ];

      return view('interior.index' , $parametros);

    }else{
      return redirect('/catalogo');
    }

  }

  public function logout(){
    Auth::logout();

    return redirect('/home');
  }

  public function aviso(Request $request){

    $establecimientos =  Establecimiento::inRandomOrder()->limit(3)->get();
    $estados = Estado::all();
    $banners =  Banner::where(['activo' => '1'])->orderBy('orden' , 'desc')->get();
    // enviamos parametros a la vista
    $parametros = [
      'estados' => $estados,
      'banners' => $banners,
      'establecimientos' => $establecimientos
    ];
    // si tenemos el usuario autenticado
    if($request->user()){
      $parametros['user'] = $request->user();
    }
    // regresamos la vista compilada
    return view('aviso.index' , $parametros);

  }

  public function doLike(Request $request){

    $user = (!empty($request->id) ? $request->id : '');
    $establecimiento = $request->negocio;
    $validLike = Like::where(['id_usuario' => $request->id ,'id_establecimiento' => $establecimiento])->first();

    if($validLike){
      return response(['error' => 'Usuario repetido']);
    }
    $like = new Like;
    //validamos si esta ya el usauario

    $like->id_usuario = $user;
    $like->id_establecimiento = $establecimiento;
    if($like->save()){
      return response(['msg' => 'Like agregado']);
    }else{
      return response(['error' => 'No pudo agregarse el like']);

    }
  }

  public function unlike(Request $request){
    if(Like::where('id' , $request->id)->delete()){
      return response(['msg' => 'Like borrado']);
    }
  }

}
