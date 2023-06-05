@if($noticias->count() > 0)

<section id="noticias" class="pt-5 pb-5">
    <style>
        #noticias{
            background: #e7e7c7;
        }

        .card{
            box-shadow:none !important;
            border-radius: 5px !important;
        }
    </style>
    <div class="container">
        <h2 class="advent active-red text-center">NOTICIAS</h2>
        <div class="row d-sm-flex justify-content-center align-items-center">
            @foreach($noticias as $noticia)
            <div class="col-md-4 d-sm-flex justify-content-center align-items-center">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('storage/') . '/' . $noticia->img}}" alt="{{$noticia->titulo}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$noticia->titulo}}</h5>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($noticia->contenido , 155 , '...')!!}</p>
                        <small class="text-muted float-left">{{$noticia->created_at->format('d M Y')}}</small>
                        <a href="{{url('noticias') . '/' . $noticia->slug}}" class="float-right active-red">Leer Más</a>
                    </div>
                </div>
            </div>    
            @endforeach        

        </div>
    </div>

</section>

@endif