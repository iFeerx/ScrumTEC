<div>
    <button wire:click='openModal'></button>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if ($usuario_detalle_id>0)
    <dialog>
        Yo soy el usuario;
    </dialog>
    @endif
</div>
