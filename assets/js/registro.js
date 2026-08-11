document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formRegistro');

    if (!form) return;

    const fields = {
        nombre: document.getElementById('nombre'),
        primerApellido: document.getElementById('primerApellido'),
        segundoApellido: document.getElementById('segundoApellido'),
        correo: document.getElementById('correo'),
        telefono: document.getElementById('telefono'),
        clave: document.getElementById('clave')
    };

    const validateField = (name, input) => {
        const value = input.value.trim();
        const errorEl = document.getElementById(name + 'Error');

        let message = '';

        if (name === 'nombre' || name === 'primerApellido') {
            if (!value) {
                message = 'Este campo es obligatorio.';
            } else if (value.length < 2) {
                message = 'Debe tener al menos 2 caracteres.';
            }
        }

        if (name === 'correo') {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!value) {
                message = 'El correo es obligatorio.';
            } else if (!emailPattern.test(value)) {
                message = 'Ingrese un correo válido.';
            }
        }

        if (name === 'telefono') {
            if (value && !/^\d{8,15}$/.test(value.replace(/\s+/g, ''))) {
                message = 'Ingrese un teléfono válido.';
            }
        }

        if (name === 'clave') {
            if (!value) {
                message = 'La contraseña es obligatoria.';
            } else if (value.length < 6) {
                message = 'La contraseña debe tener mínimo 6 caracteres.';
            }
        }

        if (errorEl) {
            errorEl.textContent = message;
        }

        input.classList.remove('valid', 'invalid');
        if (value && !message) {
            input.classList.add('valid');
        } else if (message) {
            input.classList.add('invalid');
        }

        return !message;
    };

    Object.entries(fields).forEach(([name, input]) => {
        if (!input) return;

        input.addEventListener('blur', () => validateField(name, input));
        input.addEventListener('input', () => validateField(name, input));
    });

    form.addEventListener('submit', function (event) {
        let valid = true;

        Object.entries(fields).forEach(([name, input]) => {
            if (!validateField(name, input)) {
                valid = false;
            }
        });

        if (!valid) {
            event.preventDefault();
        }
    });
});
