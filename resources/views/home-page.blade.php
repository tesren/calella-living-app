<div>
    @section('titles')
        <title>Calella Living - {{__('Departamentos y locales comerciales en venta en Aguascalientes')}}</title>
        <meta name="description" content="{{__('Descubre Calella Living en Aguascalientes, un exclusivo desarrollo de departamentos de 1 y 2 recámaras y locales comerciales. Disfruta de increíbles amenidades como terraza, jacuzzi, fogatas y asadores. Vive con estilo y comodidad en una ubicación privilegiada. ¡Conoce más!')}}">
    @endsection
    

    <div class="row position-relative">

        <div class="col-12 col-lg-4 bg-white py-2 py-lg-3 px-3 px-lg-5 ff-marquez text-brown fs-2 le-3 text-center">
            {{__('Nuestro Inventario')}}
        </div>

        <div class="col-12 col-lg-8 bg-brown py-2 home-nav">
            <ul class="nav nav-pills d-flex h-100 justify-content-center" id="sectionTabs" role="tablist">

                @php
                    $i = 0;
                @endphp

                @foreach ( $sections as $section)
                
                    <li class="nav-item me-3 align-self-center" role="presentation">
                        <a class="px-4 nav-link @if($activeSection == $section->id) active @endif" wire:click="setActiveSection({{$section->id}})" href="#" id="section-{{$section->id}}-tab" data-bs-toggle="tab" data-bs-target="#{{$section->id}}-tab-pane" role="tab" aria-controls="{{$section->id}}-tab-pane" >
                            <i class="fa-regular fa-eye"></i> {{__($section->name)}}
                        </a>
                    </li>

                    @php
                        $i++;
                    @endphp
                    
                @endforeach
            </ul>
        </div>

        <div class="position-absolute end-0 top-0 col-1 text-center mt-4 d-none d-lg-block">

            @if (app()->getLocale() == 'es')         
                <a href="{{$url = route('home', [], true, 'en')}}" wire:navigate class="px-3 nav-link ms-2 ms-lg-0 fs-5 link-light" title="{{__('Cambiar idioma')}}" >
                    <i class="fa-solid fa-globe"></i> EN
                </a>
            @else
                <a href="{{$url = route('home', [], true, 'es')}}" wire:navigate class="px-3 nav-link ms-2 ms-lg-0 fs-5 link-light" title="{{__('Cambiar idioma')}}" >
                    <i class="fa-solid fa-globe"></i> ES
                </a>
            @endif

        </div>

    </div>


    <div class="row">

        {{-- Fachadas --}}
        <div class="col-12 col-lg-7 px-0 align-self-center">
            <div class="tab-content" id="myTabContent">

                @php
                    $i = 0;
                @endphp

                @foreach ($sections as $section)

                    @php
                        $section_img = 'media/'.$section->img_path;
                    @endphp 

                    <div class="tab-pane fade @if($activeSection == $section->id) show active @endif" id="{{$section->id}}-tab-pane" role="tabpanel" tabindex="0">

                        <div class="position-relative overflow-x-scroll">
                            <img src="{{asset($section_img)}}" alt="" class="inventory-img">
    
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="position-absolute start-0 top-0 px-0 svg-home" viewBox="{{$section->viewbox}}">
                    
                                @foreach ($section->units as $unit)
                    
                                    <a wire:click.prevent="updateUnit({{$unit->id}})" class="text-decoration-none d-none d-lg-block link-light {{ strtolower($unit->status) }}-class" href="#unit-preview">
                                        <polygon class="" points="{{$unit->shape->points ?? '0,0'}}">    
                                        </polygon>
                                        
                                        <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                                            font-size="30" fill="#fff" class="fw-light">
                    
                                            @if ($unit->status == 'Disponible')
                                                <tspan class="fw-normal">
                                                    {{$unit->name}}                                                    
                                                </tspan>
                                            @else
                                                <tspan class="fw-normal" dx="-1.2em">
                                                    {{__($unit->status)}}
                                                </tspan>
                                            @endif
                                            
                                        </text>
                                    </a>

                                    <a class="text-decoration-none d-block d-lg-none link-light {{ strtolower($unit->status) }}-class" href="#unit-preview" data-bs-toggle="modal" data-bs-target="#unitModal-{{$unit->id}}">
                                        <polygon class="" points="{{$unit->shape->points ?? '0,0'}}">    
                                        </polygon>
                                        
                                        <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                                            font-size="28" fill="#fff" class="fw-light">
                    
                                                @if ($unit->status == 'Disponible')
                                                    <tspan class="fw-normal">
                                                        {{$unit->name}}                                                    
                                                    </tspan>
                                                @else
                                                    <tspan class="fw-normal" dx="-1em">
                                                        {{__($unit->status)}}
                                                    </tspan>
                                                @endif
                                            
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
        <div class="col-12 col-lg-5 px-0">

            {{-- escritorio --}}
            @if ( isset($selected_unit) )

                {{-- seccion --}}
                <div wire:key="unit-{{ $selected_unit->id }}" class="d-none d-lg-block position-relative">
                    @php
                        $select_unit_imgs = $selected_unit->unitType->getMedia('gallery');
                    @endphp
    
                    @if ($select_unit_imgs->count() > 0)
                        <img src="{{ $select_unit_imgs[0]->getUrl('medium') }}" alt="Imagen de departamento {{$selected_unit->name}}" class="w-100 object-fit-cover" style="max-height: 250px;">
                    @endif
    
                    <div class="p-4  position-relative">
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
                            {{__($selected_unit->status)}}
                        </div>

                        <h2>
                            @if ( in_array($selected_unit->unitType->id, [10,11,12,13] ) )
                                {{$selected_unit->name}}
                            @else
                                {{__('Depto.')}} {{$selected_unit->name}}
                            @endif
                        </h2>
    
                        @if ( $selected_unit->price != 0 and $selected_unit->status == 'Disponible' )
                            <div class="fs-2 fw-bold mb-4">
                                ${{ number_format($selected_unit->price) }} {{$selected_unit->currency}}
                            </div>
                        @endif
    
                        <h2 class="text-brown fs-3">{{__('Características')}}</h2>
    
                        <div class="row px-0 fs-5">
    
                            <div class="col-12 col-lg-5">
                                <i class="fa-solid fa-bed"></i> {{$selected_unit->unitType->bedrooms}} {{__('Recámaras')}}
                            </div>
    
                            <div class="col-12 col-lg-4">
                                <i class="fa-solid fa-bath"></i> {{$selected_unit->unitType->bathrooms}} {{__('Baños')}}
                            </div>
    
                            <div class="col-12 col-lg-3">
                                <i class="fa-solid fa-arrow-turn-up"></i> 
                                @if ($selected_unit->floor == 0)
                                    {{__('Planta baja')}}
                                @else
                                    {{__('Piso')}} {{$selected_unit->floor}}
                                @endif 
                            </div>
    
                            <div class="col-12 mt-2">
                                <i class="fa-solid fa-compass"></i> {{__('Orientación')}}: {{__($selected_unit->orientation)}} 
                            </div>
    
                        </div>
    
    
                        {{-- Medidas --}}
                        <h2 class="text-brown mt-4 fs-3">{{__('Dimensiones')}}</h2>
    
                        <div class="row px-0 fs-5 mb-4">
    
                            <div class="col-12 col-lg-6 col-xxl-4">
                                <i class="fa-solid fa-expand"></i> {{__('Interior')}}: {{$selected_unit->interior_const}} m²
                            </div>
    
                            <div class="col-12 col-lg-6 col-xxl-4">
                                <i class="fa-solid fa-maximize"></i> {{__('Terraza')}}: {{$selected_unit->exterior_const}} m²
                            </div>
    
                            <div class="col-12 col-xxl-4">
                                <i class="fa-solid fa-house"></i> {{__('Total')}}: {{$selected_unit->const_total}} m²
                            </div>
    
                        </div>
    
                        <div class="text-center">
                            <a href="{{ route('unit', ['name'=>$selected_unit->name] ) }}" class="btn btn-green fs-5 px-5" wire:navigate>
                                {{__('Más información')}}
                            </a>
                        </div>

                    </div>

                    <div class="bg-white position-absolute top-0 start-0 w-100 h-100 justify-content-center text-center row"  wire:loading wire:target="updateUnit" wire:key="loading-indicator">
                        <div class="col-12 align-self-center mt-5 fs-4" >
                            <i class="fa-solid fa-circle-notch fa-spin fa-3x"></i>
                            <div>{{__('Cargando...')}}</div>
                        </div>
                    </div>

                </div>

            @else

                <div class="position-relative">
                    <div class="p-4 p-lg-5 text-center">
                        <h2>
                            <i class="fa-solid fa-arrow-pointer"></i> {{__('Da clic en una unidad')}}
                        </h2>
                    </div>
    
                    <div class="bg-white position-absolute top-0 start-0 w-100 h-100 justify-content-center text-center my-4 row"  wire:loading wire:target="updateUnit" wire:key="loading-indicator">
                        <div class="col-12 align-self-center mt-5 fs-4" >
                            <i class="fa-solid fa-circle-notch fa-spin fa-3x"></i>
                            <div>{{__('Cargando...')}}</div>
                        </div>
                    </div>
                </div>

            @endif

            {{-- Movil --}}
            @foreach ($all_units as $modal_unit)
                <div class="modal fade" id="unitModal-{{$modal_unit->id}}" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content bg-white">

                                <div class="modal-body p-0 text-center rounded-top overflow-hidden">

                                    @php
                                        $mobile_select_unit_imgs = $modal_unit->unitType->getMedia('gallery');
                                    @endphp

                                    @if ($mobile_select_unit_imgs->count() > 0)
                                        <img src="{{ $mobile_select_unit_imgs[0]->getUrl('medium') }}" alt="Imagen de departamento {{$modal_unit->name}}" class="w-100 object-fit-cover" style="max-height: 250px;" loading="lazy">
                                    @endif

                                    @php
                                        if ($modal_unit->status == 'Vendida') {
                                            $status_class = 'bg-danger';
                                        }
                                        elseif($modal_unit->status == 'Apartada'){
                                            $status_class = 'bg-warning';
                                        }
                                        else {
                                            $status_class = 'bg-success';
                                        }
                                    @endphp

                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            
                                    <div class="p-3">
                                        
                                        <div class="badge {{ $status_class }} fs-6 fw-light rounded-pill mb-2">
                                            {{__($modal_unit->status)}}
                                        </div>
                
                                        <h2 class="fs-1">
                                            @if ( in_array($modal_unit->unitType->id, [10,11,12,13] ) )
                                                {{$modal_unit->name}}
                                            @else
                                                {{__('Depto.')}} {{$modal_unit->name}}
                                            @endif
                                        </h2>
                    
                                        @if ( $modal_unit->price != 0 and $modal_unit->status == 'Disponible' )

                                            <div class="fs-2 fw-bold mb-4">
                                                ${{ number_format($modal_unit->price) }} {{$modal_unit->currency}}
                                            </div>

                                        @endif
                    
                                        <h2 class="text-brown fs-3">{{__('Características')}}</h2>
                    
                                        <div class="row px-0 fs-5">
                    
                                            <div class="col-12 mb-1">
                                                <i class="fa-solid fa-bed"></i> {{$modal_unit->unitType->bedrooms ?? '0'}} {{__('Recámaras')}}
                                            </div>
                    
                                            <div class="col-12 mb-1">
                                                <i class="fa-solid fa-bath"></i> {{$modal_unit->unitType->bathrooms ?? '0'}} {{__('Baños')}}
                                            </div>
                    
                                            <div class="col-12 mb-1">
                                                <i class="fa-solid fa-arrow-turn-up"></i> 
                                                @if ($modal_unit->floor == 0)
                                                    {{__('Planta baja')}}
                                                @else
                                                    {{__('Piso')}} {{$modal_unit->floor}}
                                                @endif 
                                            </div>
                    
                                            <div class="col-12">
                                                <i class="fa-solid fa-compass"></i> {{__('Orientación')}}: {{__($modal_unit->orientation)}} 
                                            </div>
                    
                                        </div>
                    
                    
                                        {{-- Medidas --}}
                                        <h2 class="text-brown mt-4 fs-3">{{__('Dimensiones')}}</h2>
                    
                                        <div class="row px-0 fs-5 mb-4">
                    
                                            <div class="col-12 mb-1">
                                                <i class="fa-solid fa-expand"></i> {{__('Interior')}}: {{$modal_unit->interior_const}} m²
                                            </div>
                    
                                            <div class="col-12 mb-1">
                                                <i class="fa-solid fa-maximize"></i> {{__('Terraza')}}: {{$modal_unit->exterior_const}} m²
                                            </div>
                    
                    
                                            <div class="col-12">
                                                <i class="fa-solid fa-house"></i> {{__('Total')}}: {{$modal_unit->const_total}} m²
                                            </div>
                    
                                        </div>
                                    </div>
                
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cerrar')}}</button>
                                    <a href="{{ route('unit', [ 'name'=>$modal_unit->name ] ) }}" class="btn btn-green" wire:navigate>
                                        {{__('Más información')}}
                                    </a>     
                                </div>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    </div>



</div>
