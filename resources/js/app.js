import './bootstrap';
import Swal from 'sweetalert2';
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// Configuración global de SweetAlert2
window.Swal = Swal;

// Configuración para Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
    background: '#1a1a1a',
    color: '#ffffff'
});

window.Toast = Toast;

// Configuración global para Swal
Swal.defaultParams = {
    background: '#1a1a1a',
    color: '#ffffff'
};




// Register FilePond plugins
FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

// Initialize FilePond
document.addEventListener('DOMContentLoaded', () => {
    const inputElement = document.querySelector('input[type="file"].filepond');

    FilePond.create(inputElement, {
        allowMultiple: true,
        maxFiles: 10, // Ajusta este número según tus necesidades
        acceptedFileTypes: ['image/*'], // Acepta solo imágenes
        server: {
            process: '/upload', // Ruta de tu controlador para procesar la subida
            revert: '/revert', // Ruta para revertir la subida (opcional)
        }
    });
});
