import {env} from "eslint-plugin-vue/lib/configs/base";

const API_BASE_URL = env.VUE_APP_API_BASE_URL || 'https://php-vue-project.000webhostapp.com';

export {
    API_BASE_URL,
};