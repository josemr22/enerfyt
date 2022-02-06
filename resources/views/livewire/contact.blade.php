<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="z-index: 1000 !important; background-color:orange !important;">
    <form wire:submit.prevent="store">
        <h4 class="mtext-105 cl0 txt-center p-b-30">
            Envíanos un Mensaje
        </h4>

        <div class="bor8 how-pos4-parent">
            <input class="stext-111 cl00 plh3 size-116 p-l-62 p-r-30" type="text" wire:model="name" placeholder="Nombre">
            <img class="how-pos4 pointer-none" src="/page-img/icons/user.png" alt="ICON" width="22px">
        </div>
        @error('name') <span class="error ml-1 text-danger">{{ $message }}</span> @enderror

        <div class="bor8 m-t-20 how-pos4-parent">
            <input class="stext-111 cl00 plh3 size-116 p-l-62 p-r-30" type="email" wire:model="email" placeholder="Email">
            <img class="how-pos4 pointer-none" src="/page-img/icons/email.png" alt="ICON" width="22px">
        </div>
        @error('email') <span class="error ml-1 text-danger">{{ $message }}</span> @enderror

        <div class="bor8 m-t-20 how-pos4-parent">
            <input class="stext-111 cl00 plh3 size-116 p-l-62 p-r-30" type="number" wire:model="phone" placeholder="Número Telefónico">
            <img class="how-pos4 pointer-none" src="/page-img/icons/telephone.png" alt="ICON" width="22px">
        </div>
        @error('phone') <span class="error ml-1 text-danger">{{ $message }}</span> @enderror

        @if ($type=='appointment')
            <div class="bor8 m-t-20 how-pos4-parent">
                <input class="stext-111 cl00 plh3 size-116 p-l-62 p-r-30" type="date" wire:model="appointment_date" >
                <img class="how-pos4 pointer-none" src="/page-img/icons/comment.png" alt="ICON" width="22px">
            </div>
            @error('appointment_date') <span class="error ml-1 text-danger">{{ $message }}</span> @enderror
            <input type="hidden" wire:model="type">   
        @else
            <input type="hidden" wire:model="type">   
        @endif

        <div class="bor8 m-t-30">
            <textarea class="stext-111 cl00 plh3 size-120 p-lr-28 p-tb-25" style="min-height:0px !important" wire:model="message" placeholder="¿Cómo podemos ayudarte?"></textarea>
        </div>
        @error('message') <span class="error ml-1 text-danger">{{ $message }}</span> @enderror

        <button type="submit" class="flex-c-m stext-101 m-t-30 cl0 size-121 bg3 bor1 hov-btn5 p-lr-15 trans-04 pointer">
            Enviar
        </button>
    </form>
</div>
