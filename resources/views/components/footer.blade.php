
<footer class="row justify-content-evenly pt-5 pb-3 bg-darkgreen">
    
    <div class="col-8 col-lg-3 col-xxl-2 mb-5 mb-lg-0">
        <img src="{{asset('/img/logo-calella-blanco.webp')}}" alt="Logo de Calella Living" class="w-100">
    </div>

    <div class="col-12 col-lg-3 mb-5 mb-lg-0 text-center text-lg-start px-4 px-lg-3">
        <div class="fs-3 mb-3">{{__('Domicilio')}}</div>

        <address class="fs-5 fw-light mb-3">
            <i class="fa-solid fa-location-dot"></i> Av. Eugenio Garza Sada 124 I, Los Pocitos, Aguascalientes, Aguascalientes.
        </address>

    </div>

    <div class="col-12 col-lg-3 mb-5 mb-lg-0 text-center text-lg-start">
        
        <div class="fs-3 mb-3">{{__('Contacto')}}</div>

        <a href="mailto:info@domusvallarta.com" class="link-light fs-5 text-decoration-none d-block mb-2 fw-light">
            <i class="fa-solid fa-envelope"></i> info@calellaliving.com
        </a>

        <a href="tel:+523322005523" class="link-light fs-5 text-decoration-none d-block mb-2 fw-light">
            <i class="fa-solid fa-phone"></i> +52 332 555 5555
        </a>

        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook page" class="link-light text-decoration-none fs-4 me-3">
            <i class="fa-brands fa-facebook-f"></i>
        </a>

        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram page" class="link-light text-decoration-none fs-4">
            <i class="fa-brands fa-instagram"></i>
        </a>
        
    </div>

    <div class="col-12 pt-2 px-3 text-center">
        <i class="fa-regular fa-copyright"></i> Copyright 2024 {{__('Todos los derechos reservados')}} | <a href="{{--route('privacy', request()->query() )--}}" wire:navigate class="link-light fw-light">{{__('Aviso de Privacidad')}}</a>
    </div>

</footer>