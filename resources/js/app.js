require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**CKEDITOR 5 */

import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
window.ClassicEditor = ClassicEditor;

/**DROPZONE */
import { Dropzone } from "dropzone/dist/dropzone";
window.Dropzone = Dropzone;

/** SweetAlert2 */
import Swal from 'sweetalert2';
window.Swal = Swal;
/** glider.js */
import gli from 'glider-js';
window.gli = gli;

/** flexslider */
import flexslider from 'flexslider';
