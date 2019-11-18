import {UserStore, MessageStore, SettingsStore} from "sdk/stores";
import {MessageModel, UserModel, CustomerModel, themes} from "sdk/models";


export default function () {
    const usersStore = new UserStore(new CustomerModel());
    const messagesStore = new MessageStore();
    const settingsStore = new SettingsStore(themes.primary, {isOpened: true});

    return {
        usersStore,
        messagesStore,
        settingsStore
    }
}
