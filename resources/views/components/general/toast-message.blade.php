@props([
    'message' => '',
    'type' => 'success',
])

<div id="toast-{{ $type }}"
    class="flex items-center w-full max-w-xs p-4 text-neutral-500 rounded-lg shadow-sm fixed bottom-5 right-5 transition-opacity duration-500 @if($type === 'success') bg-green-700 @else bg-red-950 @endif"
    role="alert">
    <div
        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-white bg-blue-100 rounded-lg  @if ($type === 'success') bg-green-500 @else bg-red-600 @endif">
        <i class="fa-solid @if ($type === 'success') fa-check @else fa-triangle-exclamation @endif"></i>
    </div>
    <div class="ms-3 text-sm text-white font-normal">{{ $message }}</div>
    <button type="button"
        class="ms-auto cursor-pointer -mx-1.5 -my-1.5 text-neutral-300 hover:text-neutral-600 rounded-lg focus:ring-2 focus:ring-neutral-300 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-transparent duration-200 ease-in @if($type === 'success') text-green-700 @else text-red-400 @endif"
        id="close-toast-{{ $type }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <i class="fa-solid fa-times"></i>
    </button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toast = document.getElementById("toast-{{ $type }}");
        const closeButton = document.getElementById("close-toast-{{ $type }}");

        if (toast) {
            setTimeout(() => {
                toast.style.opacity = "0";
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 4000);
            closeButton.addEventListener("click", () => {
                toast.style.opacity = "0";
                setTimeout(() => {
                    toast.remove();
                }, 500);
            });
        }
    });
</script>
