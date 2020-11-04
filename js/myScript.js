function smoothScroll(x) {
    var element = x;

    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}