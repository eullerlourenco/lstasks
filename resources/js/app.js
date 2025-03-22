import "./bootstrap";

function openModal(id) {
    let modal = document.querySelector(`#${id}`);
    modal.classList.toggle("hidden");
    modal.classList.toggle("flex");
    setTimeout(() => {
        modal.classList.toggle("opacity-100");
        modal.classList.add("opacity-100");
    }, 20);
}

function closeModal(id) {
    let modal = document.querySelector(`#${id}`);
    modal.classList.toggle("opacity-100");
    setTimeout(() => {
        modal.classList.toggle("hidden");
        modal.classList.toggle("flex");
    }, 500);
}

window.openModal = openModal;
window.closeModal = closeModal;
