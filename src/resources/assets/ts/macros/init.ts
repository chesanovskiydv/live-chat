import * as Macros from './index';

jQuery(document).ready(function () {
    for (let value of Object.values(Macros)) {
        value.init();
    }
});
