@props(['id'])

<div id="{{ $id }}" onclick="closeModal('{{ $id }}')" class="hidden opacity-0 transition-opacity duration-300 fixed left-0 top-0 bg-black/40 backdrop-blur-xs w-screen h-screen z-100 justify-center items-center">
  <div onclick="event.stopImmediatePropagation()" class="bg-neutral-800 rounded-xl shadow-lg px-5 py-6 w-[90%] md:w-[60%] lg:w-[30%] flex flex-col gap-3">
    {{ $slot }}
  </div>
</div>