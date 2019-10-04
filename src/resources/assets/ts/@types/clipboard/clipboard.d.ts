/// <reference types="tiny-emitter"/>

interface Clipboard {

    /**
     * Defines if attributes would be resolved using internal setter functions
     * or custom functions that were passed in the constructor.
     * @param {Object} options
     */
    resolveOptions(options?: ClipboardOptions): void;

    /**
     * Adds a click event listener to the passed trigger.
     * @param {String|HTMLElement|HTMLCollection|NodeList} trigger
     */
    listenClick(trigger: Trigger): void;

    /**
     * Defines a new `ClipboardAction` on each click event.
     * @param {Event} e
     */
    onClick(e: Event): void;

    /**
     * Default `action` lookup function.
     * @param {Element} trigger
     */
    defaultAction: ActionFunction;

    /**
     * Default `target` lookup function.
     * @param {Element} trigger
     */
    defaultTarget: TargetFunction

    /**
     * Default `text` lookup function.
     * @param {Element} trigger
     */
    defaultText: TextFunction;

    /**
     * Destroy lifecycle.
     */
    destroy(): void;
}

interface ClipboardConstructor {
    /**
     * @param {String|HTMLElement|HTMLCollection|NodeList} trigger
     * @param {Object} options
     */
    new(trigger: Trigger, options?: ClipboardOptions): ClipboardInstance;

    /**
     * Returns the support of the given action, or all actions if no action is
     * given.
     * @param {String} [action]
     */
    isSupported(action?: Array<Action> | Action): boolean;
}

interface ClipboardOptions {
    action?: ActionFunction;
    target?: TargetFunction;
    text?: TextFunction;
    container?: HTMLElement | NodeList;
}

interface ActionFunction {
    /**
     * `action` lookup function.
     * @param {Element} trigger
     */
    (trigger: Trigger): Action | void;
}

interface TargetFunction {
    /**
     * `target` lookup function.
     * @param {Element} trigger
     */
    (trigger: Trigger): HTMLInputElement | void;
}

interface TextFunction {
    /**
     * `text` lookup function.
     * @param {Element} trigger
     */
    (trigger: Trigger): string | void;
}

interface ClipboardAction {
    action: Action | void;
    text: string | void;
    trigger: Element;
    clearSelection: Function;
}

type Action = 'copy' | 'cut';

type Trigger = String | HTMLElement | HTMLCollection | NodeList;

type ClipboardInstance = Clipboard & TinyEmitter;

/**
 * Base class which takes one or more elements, adds event listeners to them,
 * and instantiates a new `ClipboardAction` on each click.
 */
declare const ClipboardJS: ClipboardConstructor;
