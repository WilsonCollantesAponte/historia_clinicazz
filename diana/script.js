document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('emergencyForm');
    const fechaNacimiento = document.getElementById('fechaNacimiento');
    const edad = document.getElementById('edad');

    fechaNacimiento.addEventListener('change', function () {
        const today = new Date();
        const birthDate = new Date(this.value);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        edad.value = age;
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Historia Clínica Guardada');
        form.reset();
    });
});
