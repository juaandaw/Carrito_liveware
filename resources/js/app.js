require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**CKEDITOR 5 */

/**DROPZONE */
import  Dropzone  from "dropzone/src/dropzone";
window.Dropzone = Dropzone;

/** SweetAlert2 */
import Swal from 'sweetalert2/src/sweetalert2';
window.Swal = Swal;
/** glider.js */
import gli from 'glider-js';
window.gli = gli;


/** jquery */
import jquery from 'jquery/src/jquery'
window.jQuery = jquery;
/** flexslider */
import flexslider from 'flexslider';

/** piakday */
window.Pikaday = require("pikaday");


