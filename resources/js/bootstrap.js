import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap;

import { Fancybox } from "@fancyapps/ui";
window.Fancybox = Fancybox;

import Glide from '@glidejs/glide'
window.Glide = Glide;