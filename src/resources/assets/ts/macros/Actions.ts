interface ConfirmationAttributes {
    title: string,
    text: string,
}

export default class Actions {

    protected dataAttributePrefix: string;

    get dataAttributeKey(): string {
        return `${this.dataAttributePrefix}-key`;
    }

    get confirmationAttributes(): ConfirmationAttributes {
        return {
            title: `${this.dataAttributePrefix}-confirmation-title`,
            text: `${this.dataAttributePrefix}-confirmation-text`
        };
    }

    /**
     * @param {String} dataAttributePrefix
     */
    constructor(dataAttributePrefix?: string) {
        this.dataAttributePrefix = dataAttributePrefix || 'data-action-form';
    }

    /**
     * Initialize a Macros.
     *
     * @param {String} dataAttributePrefix
     */
    public static init(dataAttributePrefix?: string): void {
        let instance = new Actions(dataAttributePrefix);

        jQuery(document).on('click', `[${instance.dataAttributeKey}]`, instance.handle.bind(instance));
    }

    /**
     * Execute an Action.
     *
     * @param {JQuery.TriggeredEvent} event
     */
    protected handle(event: JQuery.TriggeredEvent): void {
        let $this = jQuery(event.currentTarget),
            id = $this.attr(`${this.dataAttributeKey}`),
            confirmation = {
                title: $this.attr(this.confirmationAttributes.title),
                text: $this.attr(this.confirmationAttributes.text)
            };
        let doAction = () => jQuery(`#${id}`).trigger('submit');

        if (typeof confirmation.title === 'string' && typeof confirmation.text === 'string') {
            eModal.confirm(confirmation.text, confirmation.title)
                .then(doAction);
        } else {
            doAction();
        }

        event.preventDefault();
    }
}
