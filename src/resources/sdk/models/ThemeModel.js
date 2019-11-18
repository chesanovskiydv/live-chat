class ThemeModel {

    /**
     * @type {String}
     */
    fontColor = '#333';

    /**
     * @type {string}
     */
    backgroundColor = '#d2d6de';

    /**
     * @param {String} fontColor
     * @param {String} backgroundColor
     */
    constructor(fontColor = '#333', backgroundColor = '#d2d6de') {
        this.fontColor = fontColor;
        this.backgroundColor = backgroundColor;
    }
}

export default ThemeModel;

export const themes = {
    default: new ThemeModel('#333', '#d2d6de'),
    primary: new ThemeModel('#fff', '#3c8dbc'),
    info: new ThemeModel('#fff', '#00c0ef'),
    warning: new ThemeModel('#fff', '#f39c12'),
    success: new ThemeModel('#fff', '#00a65a'),
    danger: new ThemeModel('#fff', '#dd4b39'),
};
