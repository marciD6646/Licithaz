import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const navbarToggle = document.getElementById("navbar-toggle");
    const navbarMenu = document.getElementById("navbar-menu");

    if (!navbarToggle || !navbarMenu) {
        return;
    }

    navbarToggle.addEventListener("click", () => {
        const isOpen = navbarMenu.classList.toggle("is-open");
        navbarToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
});
