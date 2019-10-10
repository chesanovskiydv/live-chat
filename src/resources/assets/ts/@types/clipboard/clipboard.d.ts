declare namespace ClipboardJS {
    interface Options {
        /**
         * Overwrites default command ('cut' or 'copy').
         * @param {Target} target Current element
         */
        action?(target: Target): Action;

        /**
         * Overwrites default target input element.
         * @param {Target} target Current element
         * @returns <input> element to use.
         */
        target?(target: Target): Element;

        /**
         * Returns the explicit text to copy.
         * @param {Target} target Current element
         * @returns Text to be copied.
         */
        text?(target: Target): string;

        /**
         * For use in Bootstrap Modals or with any
         * other library that changes the focus
         * you'll want to set the focused element
         * as the container value.
         */
        container?: Element | NodeList;
    }

    interface Event {
        action: string;
        text: string;
        trigger: Element;

        clearSelection(): void;
    }

    type Action = 'copy' | 'cut';

    type Target = string | Element | NodeListOf<Element>;
}

class ClipboardJS {
    /**
     * @param {ClipboardJS.Target} selector
     * @param {ClipboardJS.Options} [options]
     */
    constructor(selector: ClipboardJS.Target, options?: ClipboardJS.Options);

    /**
     * Subscribes to events that indicate the result of a copy/cut operation.
     * @param {String} type Event type ('success' or 'error').
     * @param handler Callback function.
     */
    on(type: "success" | "error", handler: (e: ClipboardJS.Event) => void): this;
    on(type: string, handler: (...args: any[]) => void): this;

    /**
     * Destroy lifecycle.
     */
    destroy(): void;

    /**
     * Returns the support of the given action, or all actions if no action is
     * given.
     * @param {String} [action]
     */
    static isSupported(action?: Array<ClipboardJS.Action> | ClipboardJS.Action): boolean;
}
