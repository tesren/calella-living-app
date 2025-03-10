<div class="row justify-content-center" style="background-image: url('{{asset('/img/marmol-bg-min.webp')}}'); background-repeat: no-repeat; background-size: cover;">
    {{-- The whole world belongs to you. --}}

    @section('titles')
        <title>Calella Living - {{__('Departamento')}} {{$unit->name}} {{__('en venta')}}</title>
        <meta name="description" content="{{__('Departamento en venta en Calella Living, Aguascalientes. Este exclusivo espacio de :bedrooms recámaras y :const_total m² ofrece un diseño moderno y funcional. Disfruta de amenidades premium como terraza, jacuzzi, fogatas y asadores. Vive con comodidad en una ubicación privilegiada. ¡Agenda tu visita hoy!',
            ['bedrooms' => $unit->unitType->bedrooms, 'const_total' => $unit->const_total])}}">
    @endsection


    <div class="col-12 col-lg-11 col-xxl-10">

    
        @php
            $unit_type_imgs = $unit->unitType->getMedia('gallery');
        @endphp

        {{-- Imágenes --}}
        <div class="position-relative row justify-content-center my-3 my-lg-5">

            @if ($unit_type_imgs->count() > 0)
                <div class="col-12 col-lg-7 p-2 position-relative">
                    <img src="{{ $unit_type_imgs[0]->getUrl('medium') }}" alt="{{__('Departamento')}} {{$unit->name}} Calella Living" class="w-100 h-100 object-fit-cover rounded-2" data-fancybox="gallery">

                    <div class="position-absolute bottom-0 start-0 py-2 px-3 bg-white rounded-2 text-darkgreen mb-4 ms-4 fs-5">
                        <i class="fa-solid fa-images"></i> 1/{{count($unit_type_imgs)}}
                    </div>
                </div>
            @endif

            <div class="col-12 col-lg-5 p-0 d-none d-lg-block">

                @if ($unit_type_imgs->count() > 1)
                    <img src="{{ $unit_type_imgs[1]->getUrl('medium') }}" alt="{{__('Departamento')}} {{$unit->name}} Calella Living" class="w-100 rounded-4 p-2" data-fancybox="gallery">
                @endif

                @if ($unit_type_imgs->count() > 2)
                    <img src="{{ $unit_type_imgs[2]->getUrl('medium') }}" alt="{{__('Departamento')}} {{$unit->name}} Calella Living" class="w-100 rounded-4 p-2" data-fancybox="gallery">
                @endif

            </div>

        </div>

        @if ($unit_type_imgs->count() > 3)

            @for ($i=3; $i < count($unit_type_imgs); $i++)
                <img src="{{ $unit_type_imgs[$i]->getUrl('medium') }}" alt="{{__('Departamento')}} {{$unit->name}} Calella Living" class="d-none" data-fancybox="gallery">
            @endfor
            
        @endif


        {{-- Información --}}
        <div class="row justify-content-center mb-6">

            <div class="col-12 col-lg-8 text-center text-lg-start px-0">

                @php
                    if ($unit->status == 'Vendida') {
                        $status_class = 'bg-danger';
                    }
                    elseif($unit->status == 'Apartada'){
                        $status_class = 'bg-warning';
                    }
                    else {
                        $status_class = 'bg-success';
                    }
                @endphp

                <div class="badge {{$status_class}} fs-5 fw-light rounded-pill mb-2">
                    {{__($unit->status)}}
                </div>

                <h1 class="text-brown mb-0">{{__('Departamento')}}  {{$unit->name}}</h1>
                
                @if ( $unit->price != 0 and $unit->status == 'Disponible' )
                    <div class="fs-1 fw-semibold mb-5">${{ number_format($unit->price) }} {{$unit->currency}}</div>
                @endif

                <h2 class="text-brown">{{__('Características')}}</h2>

                <div class="row px-0 fs-4">

                    <div class="col-6 col-lg-3">
                        <i class="fa-solid fa-bed"></i> {{$unit->unitType->bedrooms}} {{__('Recámaras')}}
                    </div>

                    <div class="col-6 col-lg-2">
                        <i class="fa-solid fa-bath"></i> {{$unit->unitType->bathrooms}} {{__('Baños')}}
                    </div>

                    <div class="col-12 col-lg-2">
                        <i class="fa-solid fa-arrow-turn-up"></i> 
                        @if ($unit->floor == 0)
                            {{__('Planta baja')}}
                        @else
                            {{__('Piso')}} {{$unit->floor}}
                        @endif 
                    </div>

                    <div class="col-12 col-lg-4">
                        <i class="fa-solid fa-compass"></i> {{__('Orientación')}} {{__($unit->orientation)}} 
                    </div>

                </div>


                {{-- Medidas --}}
                <h2 class="text-brown mt-5">{{__('Dimensiones')}}</h2>

                <div class="row px-0 fs-4 mb-5">

                    <div class="col-12 col-lg-4">
                        <i class="fa-solid fa-expand"></i> {{__('Interior')}}: {{$unit->interior_const}} m²
                    </div>

                    <div class="col-12 col-lg-4">
                        <i class="fa-solid fa-maximize"></i> {{__('Terraza')}}: {{$unit->exterior_const}} m²
                    </div>


                    <div class="col-12 col-lg-4">
                        <i class="fa-solid fa-house"></i> {{__('Total')}}: {{$unit->const_total}} m²
                    </div>

                </div>


                {{-- Planos --}}
                <div class="row justify-content-between px-0">

                    @php
                        $floor_plans = $unit->unitType->getMedia('blueprints');
                    @endphp

                    @if ($floor_plans->count() > 0)
                        <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                            <h3 class="text-brown fs-2">{{__('Distribución')}}</h3>
                            <img src="{{ $floor_plans[0]->getUrl('medium') }}" alt="Distribucipon del departamento {{$unit->name}} de Calella Living" class="w-100" data-fancybox="planos">
                        </div>
                    @endif

                    @if ($floor_plans->count() > 1)
                        <div class="col-12 col-lg-6">
                            <h3 class="text-brown fs-2">{{__('Ubicación en planta')}}</h3>
                            <img src="{{ $floor_plans[1]->getUrl('medium') }}" alt="Ubicación en planta del departamento {{$unit->name}} de Calella Living" class="w-100" data-fancybox="planos">
                        </div>
                    @endif


                </div>

            </div>

            <div class="col-12 col-lg-4 position-relative">

                <div class="sticky-top">

                    <div class="text-center">
                        <a href="#contact-section" class="btn btn-green fs-5 py-3 px-5 my-5 ff-marquez">
                            <i class="fa-brands fa-whatsapp"></i> {{__('Contáctanos por WhatsApp')}}
                        </a>
                    </div>
    
    
                    {{-- Planes de pago --}}
                    @if ( $unit->price != 0 and $unit->status == 'Disponible' )

                        <h3 class="mb-3 text-brown fs-2 text-center">{{__('Planes de pago')}}</h3>

                        <ul class="nav nav-pills mb-0 justify-content-center bg-darkgreen rounded-top-3 overflow-hidden" id="pills-tab" role="tablist">

                            @php
                                $i = 0;
                            @endphp

                            @foreach ($unit->paymentPlans as $plan)

                                <li class="nav-item col text-center" role="presentation">
                                    <button class="nav-link rounded-0 fs-5 w-100 @if($i == 0) active @endif" id="pills-{{$plan->id}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$plan->id}}" type="button" role="tab" aria-controls="pills-{{$plan->id}}" aria-selected="true">
                                        {{$plan->name}}
                                    </button>
                                </li>

                                @php
                                    $i++;
                                @endphp

                            @endforeach
                            
                        </ul>

                        <div class="tab-content plans p-3 p-lg-4 rounded-bottom-3" id="pills-tabContent">

                            @php
                                $i = 0;
                            @endphp

                            @foreach ($unit->paymentPlans as $plan)
                                <div class="tab-pane fade @if($i == 0) show active @endif" id="pills-{{$plan->id}}" role="tabpanel" aria-labelledby="pills-{{$plan->id}}-tab" tabindex="0">
                                    @php
                                        $total = $unit->price;
                                        $down_payment = $total * ($plan->down_payment / 100);
                                        $monthly_payment = $total *  ($plan->months_percent/100);
                                        $closing_payment = $total * ($plan->closing_payment / 100);
                                    @endphp
                                
                                    <h4 class="fs-3 text-brown">{{$plan->name}}</h4>

                                    <ul class="list-unstyled fs-4 mb-0">
                                        <li>
                                            <strong>+ {{__('Enganche')}} {{$plan->down_payment}}%: </strong>
                                            <span>${{ number_format($down_payment) }} {{$unit->currency}}</span>
                                        </li>
                
                                        @if ( isset($plan->months_amount) and isset($plan->months_quantity) )
                                            <li>
                                                <strong>+ {{$plan->months_quantity}} {{__('Mensualidades de')}} ${{ number_format($plan->months_amount) }}: </strong>

                                                @php
                                                    $months_total = $plan->months_amount * $plan->months_quantity;
                                                @endphp

                                                <div class="ms-4">${{ number_format($months_total) }} <small>{{$unit->currency}}</small> {{__('en Total')}}</div>
                                            </li>
                                        @endif
                
                                        <li>
                                            <strong>+ {{__('Crédito hipotecario contra entrega')}}: </strong> 
                                            <div class="ms-4">{{__('Saldo pendiente')}}</div>
                                        </li>
                                    </ul>
                                </div>

                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        
                        </div>
                    @endif
    
                </div>


            </div>

        </div>
        

        {{-- Amenidades --}}
        <div class="row justify-content-center mb-6">
            <div class="col-12 px-0">

                <div class="glide" id="amenities-carousel">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides py-0 py-lg-5">

                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('img/icons/lobby.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">Lobby</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/lobby-2.webp')}}" alt="Fogateros Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                            {{-- <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('img/icons/sala-espera.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('Sala de espera')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/waiting-room.webp')}}" alt="Sala de espera Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li> --}}
                            
                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('img/icons/rooofgarden.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('Roofgarden')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/roof-garden.webp')}}" alt="Roofgarden Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('/img/icons/jacuzzi.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('Jacuzzi')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('img/jacuzzi.webp')}}" alt="Jacuzzi Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('/img/icons/bbq.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('BBQ')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/bbq.webp')}}" alt="BBQ Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-4 align-self-center">
                                                    <img src="{{asset('/img/icons/gimnasio.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-8 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('Gimnasio')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/gym.webp')}}" alt="Gimnasio Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                            <li class="glide__slide py-3 px-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 start-0 w-100 row justify-content-center">

                                        <div class="col-8 col-lg-6 p-2 p-lg-3 rounded-bottom-3 bg-darkgreen">

                                            <div class="row justify-content-center">
                                                <div class="col-3 align-self-center">
                                                    <img src="{{asset('/img/icons/fogatero.png')}}" alt="" class="w-100">
                                                </div>
                                                <div class="col-9 align-self-center">
                                                    <div class="fs-5">{{__('Amenidades')}}:</div>
                                                    <span class="fw-light">{{__('Fogatero')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                         
                                    </div>
    
                                    <img src="{{asset('/img/fogata.webp')}}" alt="Fogatero Calella Living" class="w-100 rounded-4 shadow object-fit-cover" style="min-height:35vh;">
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left btn btn-white rounded-circle" data-glide-dir="<">
                            <i class="fa-solid fa-2x fa-arrow-left"></i>
                        </button>

                        <button class="glide__arrow glide__arrow--right btn btn-white rounded-circle" data-glide-dir=">">
                            <i class="fa-solid fa-2x fa-arrow-right"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


@script 

<script>
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
</script>
@endscript