function initClipboardJs(target: ClipboardJS.Target, options: ClipboardJS.Options = {}): ClipboardJS {
    return (new ClipboardJS(target, options));
}

(<any>window).initClipboardJs = initClipboardJs;
