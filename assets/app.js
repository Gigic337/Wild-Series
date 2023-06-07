/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
require('bootstrap');

// start the Stimulus application
import './bootstrap';
console.log('Hello Webpack Encore !')

// assets/app.js

// returns the final, public path to this file
// path is relative to this file - e.g. assets/images/logo.png
import logoPath from '../assets/images/—Pngtree—board announcement under construction cone_7649845.png';

let html = `<img src="${logoPath}" alt="Under construct">`;
