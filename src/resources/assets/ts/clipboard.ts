import {Tippy, ReferenceElement, Content} from "tippy.js";

declare const tippy: Tippy;

interface Event extends ClipboardJS.Event {
    trigger: ReferenceElement
}

/**
 * @param {Event} event
 * @param {Content} content
 */
function showTooltip(event: Event, content: Content): void {
    if (event.trigger._tippy) {
        event.trigger._tippy.setContent(content);
        event.trigger._tippy.show();
    }
}

/**
 * @param {string} action
 * @return {string}
 */
function fallbackMessage(action: string): string {
    let actionMsg: string = '',
        actionKey: string = (action === 'cut' ? 'X' : 'C');

    if (/iPhone|iPad/i.test(navigator.userAgent)) {
        actionMsg = 'No support :(';
    } else if (/Mac/i.test(navigator.userAgent)) {
        actionMsg = 'Press ⌘-' + actionKey + ' to ' + action;
    } else {
        actionMsg = 'Press Ctrl-' + actionKey + ' to ' + action;
    }

    return actionMsg;
}

/**
 * @param {ClipboardJS.Target} target
 * @param {ClipboardJS.Options} options
 * @return {ClipboardJS}
 */
function initClipboardJs(target: ClipboardJS.Target, options: ClipboardJS.Options = {}): ClipboardJS {
    tippy(target, {
        trigger: "manual",
    });

    return (new ClipboardJS(target, options))
        .on("success", (e: Event) => showTooltip(e, 'Copied!'))
        .on("error", (e: Event) => showTooltip(e, fallbackMessage(e.action)));
}

(<any>window).initClipboardJs = initClipboardJs;
