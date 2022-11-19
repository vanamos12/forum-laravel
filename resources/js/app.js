require('./bootstrap');

require('alpinejs');

import Choices from 'choices.js';

// Create multiselect element

window.choices = (element) => {
    return new Choices(element, {
        removeItemButton: true,
        maxItemCount: 3,
    })
}