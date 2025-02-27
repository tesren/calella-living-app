<div>
    {{-- Stop trying to control. --}}

    <div class="row justify-content-between mb-6" id="contact-section">

        <div class="col-12 col-lg-6 align-self-center text-center px-4 px-lg-3">

            <div class="fs-1">
                {{__('Quieres ver más opciones?')}}
            </div>
            <div class="fs-4 fw-light mb-4">{{__('Vuelve a nuestro inventario y compara más información')}}.</div>

            <a href="{{ route('home') }}" wire:navigate class="btn btn-green fs-5 fw-light px-5">{{__('Ver inventario')}}</a>
           
        </div>


        <div class="col-12 col-lg-6 col-xxl-5 position-relative ">

            <div class="p-4 p-lg-5 bg-brown rounded-5 shadow">

                <img width="180px" class="d-block mx-auto mb-4" src="..." alt="Logo de Calella Living">

                <form wire:submit="save" id="lead_form">
                            
                    <div class="row fs-5 fw-light">
            
                        <div class="col-12 mb-3">
                            <label for="full_name" class="me-3 align-self-center">{{__('Nombre')}}:</label>
                            <input type="text" wire:model="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" required>
                        </div>
            
                        <x-honeypot/>
            
                        <div class="col-12 mb-3">
                            <label for="contact_email" class="me-3 align-self-center">{{__('Correo')}}:</label>
                            <input type="email" wire:model="contact_email" id="contact_email" class="form-control" required>
                        </div>
            
                        <div class="col-12 mb-3">
                            <label for="contact_phone" class="me-3 align-self-center">{{__('Teléfono')}}:</label>
                            <input type="tel" wire:model="contact_phone" id="contact_phone" class="form-control">
                        </div>
            
                        <div class="col-12 mb-4">
                            <label for="message" class="me-3">{{__('Notas')}}:</label>
                            <textarea wire:model="message" id="message" cols="30" required class="form-control" rows="3"></textarea>
                        </div>
            
                        <input type="hidden" wire:model="url" id="url" value="{{ request()->fullUrl() }}">
            
                        <div class="col-12 text-center mb-3">
                            <button type="submit" class="btn btn-light fs-5 w-100" @if(session('message')) disabled @endif>
                                {{__('Enviar')}}
                            </button>
                        </div>
            
                    </div>
            
                </form>
            </div>
        
            {{-- Mensaje de éxito --}}
            @if (session('message'))
                <div class="text-white rounded-2 p-3 bg-success fw-semibold fs-5 text-center mt-3 mb-4">
                    <i class="fa-regular fa-circle-check"></i> {{__(session('message'))}}
                </div>

                @script
                <script>
                    const confirmationModal = new bootstrap.Modal('#confirmationModal');
                    confirmationModal.show();
                </script>
                @endscript
            @endif

            <div wire:loading class="text-center fs-5 my-3 text-warning"> 
                <i class="fa-solid fa-spin fa-spinner"></i> {{__('Enviando, por favor espere')}}
            </div>            
        </div>

    </div>
    
    {{-- Modal de confirmación --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-white bg-red">

                <div class="modal-header">
                    <div class="modal-title fs-5 fw-light" id="exampleModalLabel">
                        <i class="fa-regular fa-circle-check"></i> {{__('Formulario enviado')}}
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <div class="fs-1">{{__('¡Gracias!')}}</div>
                    <div class="fs-5 mb-4 fw-light">{{__('Su mensaje fue enviado exitosamente, nos comunicaremos con usted lo más pronto posible')}}</div>
                </div>
                
            </div>
        </div>
    </div>

</div>