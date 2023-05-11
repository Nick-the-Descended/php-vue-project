import {env} from "eslint-plugin-vue/lib/configs/base";

const API_BASE_URL = env.VUE_APP_API_BASE_URL || 'http://localhost:8000';


export {
    API_BASE_URL,
};