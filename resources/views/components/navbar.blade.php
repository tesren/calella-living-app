<div>
    @if ( strpos($route, 'home') == false )
        <nav class="navbar navbar-dark navbar-expand-xl bg-darkgreen">
    
            <div class="container-fluid">
    
                <a class="navbar-brand" href="{{route('home')}}" wire:navigate >
                    <img width="80px" src="{{asset('img/logo-calella-blanco.webp')}}" alt="Logo de Calella living">
                </a>
    
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    
                    <div class="offcanvas-header bg-darkgreen">
                        <div class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img width="80px" src="{{asset('img/logo-calella-blanco.webp')}}" alt="Logo de Calella living">
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
    
                    <div class="offcanvas-body bg-darkgreen">
    
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" >
    
                            <li class="nav-item" role="presentation">
                                <a class="px-4 nav-link fs-5" wire:navigate href="{{ route('home') }}">
                                    {{__('Inventario')}}
                                </a>
                            </li>
    
                            <li class="nav-item">
    
                                @if (app()->getLocale() == 'es')
                                    
                                    @if($route == 'es.unit')
                
                                        <a class="px-3 nav-link ms-2 ms-lg-0 fs-5" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('unit', ['name'=>$unit_name], true, 'en');}}" >
                                            <i class="fa-solid fa-globe"></i> EN
                                        </a>
    
                                    @else
    
                                        <a href="{{$url = route($route, [], true, 'en')}}" wire:navigate class="px-3 nav-link ms-2 ms-lg-0 fs-5" title="{{__('Cambiar idioma')}}" >
                                            <i class="fa-solid fa-globe"></i> EN
                                        </a>
    
                                    @endif
    
                                @else
                                    
                                    @if($route == 'en.unit')
                    
                                        <a class="px-3 nav-link ms-2 ms-lg-0 fs-5" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('unit', ['name'=>$unit_name], true, 'es');}}" >
                                            <i class="fa-solid fa-globe"></i> ES
                                        </a>
    
                                    @else
    
                                        <a href="{{$url = route($route, [], true, 'es')}}" wire:navigate class="px-3 nav-link ms-2 ms-lg-0 fs-5" title="{{__('Cambiar idioma')}}" >
                                            <i class="fa-solid fa-globe"></i> ES
                                        </a>
    
                                    @endif
    
                                @endif
    
                            </li>
                        
                        </ul>
    
                    </div>
    
                </div>
            </div>
    
        </nav>
    @endif
</div>