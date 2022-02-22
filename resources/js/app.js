require('./bootstrap');

import Alpine from 'alpinejs';

/**CKEDITOR 5 */

import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
window.ClassicEditor = ClassicEditor;

/**DROPZONE */
const { Dropzone } = require("dropzone");

window.Alpine = Alpine;

Alpine.start();
