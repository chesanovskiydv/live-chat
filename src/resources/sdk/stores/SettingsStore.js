import {themes} from "sdk/models";


export default class SettingsStore {

    /**
     * @type {ThemeModel}
     */
    theme;

    /**
     * @type {Object}
     */
    chatSettings = {
        isOpened: false
    };

    /**
     * @param {ThemeModel} theme
     * @param {Object} chatSettings
     */
    constructor(theme = themes.default, chatSettings = {}) {
        this.theme = theme;
        this.chatSettings = Object.assign(this.chatSettings, chatSettings);
    }
}
