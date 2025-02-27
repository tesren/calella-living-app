<nav class="navbar navbar-dark navbar-expand-xl bg-brown py-0">

    <div class="container-fluid ps-0">

        <a class="navbar-brand bg-white py-2 py-lg-4 px-3 px-lg-5 ff-marquez text-brown fs-2 le-3" href="{{route('home')}}" wire:navigate >{{__('Nuestro Inventario')}}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header">
                <div class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" id="sectionTabs" role="tablist">

                    @php
                        $i = 0;
                    @endphp

                    @foreach ( $sections as $section)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($i==0) active @endif "  href="#" id="section-{{$section->id}}-tab" data-bs-toggle="tab" data-bs-target="#{{$section->id}}-tab-pane" role="tab" aria-controls="{{$section->id}}-tab-pane" >{{__($section->name)}}</a>
                        </li>

                        @php
                            $i++;
                        @endphp
                        
                    @endforeach
                
                </ul>

            </div>

        </div>
    </div>

</nav>