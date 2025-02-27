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
                
                <div class="fs-1 fw-semibold mb-5">${{ number_format($unit->price) }} {{$unit->currency}}</div>

                <h2 class="text-brown">{{__('Características')}}</h2>

                <div class="row px-0 fs-4">

                    <div class="col-6 col-lg-3">
                        <i class="fa-solid fa-bed"></i> {{$unit->unitType->bedrooms}} {{__('Recámaras')}}
                    </div>

                    <div class="col-6 col-lg-2">
                        <i class="fa-solid fa-bath"></i> {{$unit->unitType->bathrooms}} {{__('Baños')}}
                    </div>

                    <div class="col-12 col-lg-2">
                        <i class="fa-solid fa-arrow-turn-up"></i> {{__('Piso')}} {{$unit->floor}} 
                    </div>

                    <div class="col-12 col-lg-4">
                        <i class="fa-solid fa-compass"></i> {{__('Orientación')}} {{$unit->orientation}} 
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
                    <a href="#contact-section" class="btn btn-brown fs-5 py-3 px-5 my-5">
                        {{__('Ponte en contacto con nosotros')}}
                    </a>
    
    
                    {{-- Plan de pago --}}
                    <h3 class="mb-3 text-brown fs-2">{{__('Plan de pago')}}</h3>
    
                    @foreach ($unit->paymentPlans as $plan)
    
                        @php
                            $total = $unit->price;
                            $down_payment = $total * ($plan->down_payment / 100);
                            $monthly_payment = $total *  ($plan->months_percent/100);
                            $closing_payment = $total * ($plan->closing_payment / 100);
                        @endphp
                    
                        <ul class="list-unstyled fs-4">
                            <li>
                                <strong>+ {{__('Enganche')}} {{$plan->down_payment}}%: </strong>
                                <span>${{ number_format($down_payment) }} {{$unit->currency}}</span>
                            </li>
    
                            <li>
                                <strong>+ {{$plan->months_quantity}} {{__('Mensualidades')}} {{$plan->months_percent}}%: </strong>
                                <span>${{ number_format($monthly_payment) }} {{$unit->currency}}</span>
                            </li>
    
                            <li>
                                <strong>+ {{__('Crédito')}} {{$plan->closing_payment}}%: </strong>
                                <span>${{ number_format($closing_payment) }} {{$unit->currency}}</span>
                            </li>
                        </ul>
    
                    @endforeach
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