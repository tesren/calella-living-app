<div>

    @php
        $contact = request()->query('contact');
    @endphp

    @if ($contact != 'no')
        <a href="https://wa.me/523225555555?text={{ urlencode(__("Hola, vengo del sitio web de Calella Living")) }}" class="position-fixed bottom-0 end-0 z-3 m-3" data-bs-toggle="tooltip" data-bs-title="{{ __('¡Envíanos un mensaje!') }}" target="_blank" rel="noopener noreferrer">
            <img width="70px" src="{{asset('/img/whatsapp-btn.webp')}}" alt="Contactar por WhatsApp">
        </a>
    @endif

    @script
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        </script>
    @endscript
</div>
