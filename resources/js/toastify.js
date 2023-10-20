function showToastify(text, color) {
    Toastify({
        text: text,
        duration: 5000,
        gravity: "top",
        position: "center",
        backgroundColor: color,
        stopOnFocus: true,
    }).showToast();
}
