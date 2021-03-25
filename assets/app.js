/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/style.scss';
import './fonts/fonts.css';

// start the Stimulus application
import './bootstrap';

//Create global $ and jQuery variables
import $ from 'jquery';
global.$ = global.jQuery = $;

import bootstrap from "bootstrap";
require('bootstrap-icons/font/bootstrap-icons.css');

console.log('Mon Webpack junior');


