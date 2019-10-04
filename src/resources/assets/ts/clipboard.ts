function initClipboardJs(target: Trigger, options: ClipboardOptions = {}): ClipboardInstance {
    return (new ClipboardJS(target, options));
}

(<any>window).initClipboardJs = initClipboardJs;
