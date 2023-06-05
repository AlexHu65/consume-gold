<section class="pt-5 pb-5" id="instituciones">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <h2 class="advent active-red text-center">INSTITUCIONES INVOLUCRADAS</h2>
                <div class="owl-instituciones owl-carousel owl-theme z-0">
                    @foreach($instituciones as $ins)
                    <div class="item text-center p-5">
                        <a class="p-5" target="_blank" href="{{$ins->web}}">
                            <img src="{{asset('storage/') .'/'. $ins->logo}}" alt="{{$ins->nombre}}">
                        </a>
                    </div>
                    @endforeach
                  </div>
            </div>
        </div>
    </div>
</section>
