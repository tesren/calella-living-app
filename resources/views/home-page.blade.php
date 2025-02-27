<div>
    @section('titles')
        <title>Calella Living - {{__('Departamentos y locales comerciales en venta en Aguascalientes')}}</title>
        <meta name="description" content="{{__('Descubre Calella Living en Aguascalientes, un exclusivo desarrollo de departamentos de 1 y 2 recámaras y locales comerciales. Disfruta de increíbles amenidades como terraza, jacuzzi, fogatas y asadores. Vive con estilo y comodidad en una ubicación privilegiada. ¡Conoce más!')}}">
    @endsection
    


    <div class="row">

        {{-- Fachadas --}}
        <div class="col-12 col-lg-8 px-0">
            <div class="tab-content" id="myTabContent">

                @php
                    $i = 0;
                @endphp

                @foreach ($sections as $section)

                    @php
                        $section_img = 'media/'.$section->img_path;
                    @endphp 

                    <div class="tab-pane fade @if($i==0) show active @endif" id="{{$section->id}}-tab-pane" role="tabpanel" tabindex="0">

                        <div class="position-relative overflow-x-scroll">
                            <img src="{{asset($section_img)}}" alt="" class="inventory-img">
    
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="position-absolute start-0 top-0 px-0" viewBox="{{$section->viewbox}}">
                    
                                @foreach ($section->units as $unit)
                    
                                    <a wire:click.prevent="updateUnit({{$unit->id}})" class="text-decoration-none d-none d-lg-block link-light {{ strtolower($unit->status) }}-class" href="#unit-preview">
                                        <polygon class="" points="{{$unit->shape->points ?? '0,0'}}">    
                                        </polygon>
                                        
                                        <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                                            font-size="36" fill="#fff" class="fw-light">
                    
                                            <tspan class="fw-normal">{{$unit->name}}</tspan>
                                            
                                        </text>
                                    </a>

                                    <a wire:click.prevent="updateUnit({{$unit->id}})" class="text-decoration-none d-block d-lg-none link-light {{ strtolower($unit->status) }}-class" href="#unit-preview" data-bs-toggle="modal" data-bs-target="#unitModal">
                                        <polygon class="" points="{{$unit->shape->points ?? '0,0'}}">    
                                        </polygon>
                                        
                                        <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                                            font-size="36" fill="#fff" class="fw-light">
                    
                                            <tspan class="fw-normal">{{$unit->name}}</tspan>
                                            
                                        </text>
                                    </a>
                                    
                                @endforeach
            
                            </svg>
                        </div>
                        

                    </div>

                    @php
                        $i++;
                    @endphp

                @endforeach
                
            </div>
        </div>

        {{-- Preview de la unidad --}}
        <div class="col-12 col-lg-4 px-0">

            {{-- escritorio --}}
            @if ( isset($selected_unit) )

                {{-- seccion --}}
                <div wire:key="unit-{{ $selected_unit->id }}" class="d-none d-lg-block">
                    @php
                        $select_unit_imgs = $selected_unit->unitType->getMedia('gallery');
                    @endphp
    
                    @if ($select_unit_imgs->count() > 0)
                        <img src="{{ $select_unit_imgs[0]->getUrl('medium') }}" alt="Imagen de departamento {{$selected_unit->name}}" class="w-100 object-fit-cover" style="max-height: 250px;">
                    @endif
    
                    <div class="p-4 p-lg-5 position-relative">
                        @php
                            if ($selected_unit->status == 'Vendida') {
                                $status_class = 'bg-danger';
                            }
                            elseif($selected_unit->status == 'Apartada'){
                                $status_class = 'bg-warning';
                            }
                            else {
                                $status_class = 'bg-success';
                            }
                        @endphp

                        <div class="badge {{ $status_class }} fs-5 fw-light rounded-pill position-absolute top-0 end-0 me-4 mt-4 me-lg-5 mt-lg-5">
                            {{__($unit->status)}}
                        </div>

                        <h2>
                            {{__('Depto.')}} {{$selected_unit->name}}
                        </h2>
    
                        <div class="fs-2 fw-bold mb-4">
                            ${{ number_format($selected_unit->price) }} {{$selected_unit->currency}}
                        </div>
    
                        <h2 class="text-brown fs-3">{{__('Características')}}</h2>
    
                        <div class="row px-0 fs-5">
    
                            <div class="col-12 col-lg-5">
                                <i class="fa-solid fa-bed"></i> {{$selected_unit->unitType->bedrooms}} {{__('Recámaras')}}
                            </div>
    
                            <div class="col-12 col-lg-4">
                                <i class="fa-solid fa-bath"></i> {{$selected_unit->unitType->bathrooms}} {{__('Baños')}}
                            </div>
    
                            <div class="col-12 col-lg-3">
                                <i class="fa-solid fa-arrow-turn-up"></i> {{__('Piso')}} {{$selected_unit->floor}} 
                            </div>
    
                            <div class="col-12 mt-2">
                                <i class="fa-solid fa-compass"></i> {{__('Orientación')}} {{$selected_unit->orientation}} 
                            </div>
    
                        </div>
    
    
                        {{-- Medidas --}}
                        <h2 class="text-brown mt-4 fs-3">{{__('Dimensiones')}}</h2>
    
                        <div class="row px-0 fs-5 mb-4">
    
                            <div class="col-12 col-lg-6">
                                <i class="fa-solid fa-expand"></i> {{__('Interior')}}: {{$selected_unit->interior_const}} m²
                            </div>
    
                            <div class="col-12 col-lg-6">
                                <i class="fa-solid fa-maximize"></i> {{__('Terraza')}}: {{$selected_unit->exterior_const}} m²
                            </div>
    
    
                            <div class="col-12 mt-2">
                                <i class="fa-solid fa-house"></i> {{__('Total')}}: {{$selected_unit->const_total}} m²
                            </div>
    
                        </div>
    
                        <div class="text-center">
                            <a href="{{ route('unit', ['name'=>$selected_unit->name] ) }}" class="btn btn-green fs-5 px-5" wire:navigate>
                                {{__('Más información')}}
                            </a>
                        </div>
    
                    </div>
    
                    <div class="text-center my-5" wire:loading wire:target="updateUnit" wire:key="loading-indicator">
                        <div class="align-self-center fs-4">
                            <i class="fa-solid fa-circle-notch fa-spin fa-3x"></i>
                            <div>{{__('Cargando...')}}</div>
                        </div>
                    </div>

                </div>

            @else

                <div class="p-4 p-lg-5 text-center">
                    <h2>
                        <i class="fa-solid fa-arrow-pointer"></i> {{__('Da clic en una unidad')}}
                    </h2>
                </div>

            @endif

            {{-- Movil --}}
            <div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    <div class="modal-content bg-white">
                        @if ( isset($selected_unit) )

                            <div class="modal-body p-0 text-center rounded-top overflow-hidden">
                                @if ($select_unit_imgs->count() > 0)
                                    <img src="{{ $select_unit_imgs[0]->getUrl('medium') }}" alt="Imagen de departamento {{$selected_unit->name}}" class="w-100 object-fit-cover" style="max-height: 250px;">
                                @endif

                                @php
                                    if ($selected_unit->status == 'Vendida') {
                                        $status_class = 'bg-danger';
                                    }
                                    elseif($selected_unit->status == 'Apartada'){
                                        $status_class = 'bg-warning';
                                    }
                                    else {
                                        $status_class = 'bg-success';
                                    }
                                @endphp

                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        
                                <div class="p-3">
                                    
                                    <div class="badge {{ $status_class }} fs-6 fw-light rounded-pill mb-2">
                                        {{__($unit->status)}}
                                    </div>
            
                                    <h2 class="fs-1">
                                        {{__('Departamento')}} {{$selected_unit->name}}
                                    </h2>
                
                                    <div class="fs-2 fw-bold mb-4">
                                        ${{ number_format($selected_unit->price) }} {{$selected_unit->currency}}
                                    </div>
                
                                    <h2 class="text-brown fs-3">{{__('Características')}}</h2>
                
                                    <div class="row px-0 fs-5">
                
                                        <div class="col-12 mb-1">
                                            <i class="fa-solid fa-bed"></i> {{$selected_unit->unitType->bedrooms}} {{__('Recámaras')}}
                                        </div>
                
                                        <div class="col-12 mb-1">
                                            <i class="fa-solid fa-bath"></i> {{$selected_unit->unitType->bathrooms}} {{__('Baños')}}
                                        </div>
                
                                        <div class="col-12 mb-1">
                                            <i class="fa-solid fa-arrow-turn-up"></i> {{__('Piso')}} {{$selected_unit->floor}} 
                                        </div>
                
                                        <div class="col-12">
                                            <i class="fa-solid fa-compass"></i> {{__('Orientación')}} {{$selected_unit->orientation}} 
                                        </div>
                
                                    </div>
                
                
                                    {{-- Medidas --}}
                                    <h2 class="text-brown mt-4 fs-3">{{__('Dimensiones')}}</h2>
                
                                    <div class="row px-0 fs-5 mb-4">
                
                                        <div class="col-12 mb-1">
                                            <i class="fa-solid fa-expand"></i> {{__('Interior')}}: {{$selected_unit->interior_const}} m²
                                        </div>
                
                                        <div class="col-12 mb-1">
                                            <i class="fa-solid fa-maximize"></i> {{__('Terraza')}}: {{$selected_unit->exterior_const}} m²
                                        </div>
                
                
                                        <div class="col-12">
                                            <i class="fa-solid fa-house"></i> {{__('Total')}}: {{$selected_unit->const_total}} m²
                                        </div>
                
                                    </div>
                                </div>
            

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cerrar')}}</button>
                                <a href="{{ route('unit', ['name'=>$selected_unit->name] ) }}" class="btn btn-green" wire:navigate>
                                    {{__('Más información')}}
                                </a>                            
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>

    </div>



</div>
