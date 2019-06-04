/// <reference types="bootstrap"/>
/// <reference types="jquery"/>

interface EModal {

    readonly version: string;

    size: {
        [key: string]: string
    };

    addLabel(yes: string, no: string): void;

    /**
     * Gets data from URL to eModal body
     * @param {Object | String} data - this can be the message string or the full detailed object
     * @param {String} title - the string that will be shown in modal header
     * @returns {Promise} Promise with modal $DOM element
     */
    ajax(data: EDataOptions | string, title?: string): Promise<JQuery>;

    /**
     * Non blocking alert whit bootstrap.
     * @param {Object | String} data - this can be the message string or the full detailed object.
     * @param {String} title - the string that will be shown in modal header.
     * @returns {Promise} Promise with modal $DOM element
     */
    alert(data: EDataOptions | string, title?: string): Promise<JQuery.Event>;

    /**
     * Close the current open eModal
     * @returns {JQuery} eModal DOM element
     */
    close(): JQuery;

    /**
     * Non blocking confirm dialog with bootstrap.
     * @param {Object | String} data - this can be the message string or the full detailed object.
     * @param {String} title - the string that will be shown in modal header.
     * @returns {Promise} Promise with modal $DOM element
     */
    confirm(data: EDataOptions | string, title?: string): Promise<void>;

    /**
     * Remove all Dom elements in recycle bin.
     * @returns {JQuery} All removed elements
     */
    emptyBin(): JQuery;

    /**
     * Will load a URL in iFrame inside the modal body.
     * @param {Object | String} data - this can be the URL string or the full detailed object.
     * @param {String} title - the string that will be shown in modal header.
     * @returns {Promise} Promise with modal $DOM element
     */
    iframe(data: EDataOptions | string, title?: string): Promise<void>;

    /**
     * Provides one value form.
     * @param {Object | String} data - this can be the value string label or the full detailed object.
     * @param {String} title - the string that will be shown in modal header.
     * @returns {Promise} Promise with modal $DOM element
     */
    prompt(data: EDataOptions | string, title?: string): Promise<void>;

    setId(id: string | number | symbol): void;

    /**
     * Set or change eModal options.
     * @param {Object} overrideOptions
     * @returns {Object} merged eModal options
     */
    setEModalOptions(overrideOptions: EModalOptions): object;

    /**
     * Set or change bootstrap modal options.
     * @param {Object} overrideOptions
     * @returns {Object} merged eModal options
     */
    setModalOptions(overrideOptions: ModalOptions): ModalOptions;
}

interface EModalOptions {
    allowContentRecycle?: boolean,
    confirmLabel?: string,
    labels?: ELabel,
    loadingHtml?: string,
    size?: Size,
    title?: string,
    autofocus?: boolean
}

interface EDataOptions extends EModalOptions {
    message?: string | HTMLElement | JQuery;
    subtitle?: string;
    loading?: boolean;
    useBin?: boolean;
    css?: JQuery.PlainObject<string | number | ((this: HTMLElement, index: number, value: string) => string | number | void | undefined)>;
    buttons?: Array<EButton> | false
}

interface EButton {
    [key: string]: any
}

interface ELabel {
    [key: string]: string
}

type Size = 'sm' | 'lg' | 'xl';

declare const eModal: EModal;

