// Load Bootstrap JavaScript (modals, dropdowns, etc.)
import 'bootstrap';

// Load Font Awesome icons
import '@fortawesome/fontawesome-free/css/all.min.css';

// Vue setup (keep your existing Vue config)
import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

app.mount('#app');
