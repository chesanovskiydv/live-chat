import {UserModel} from "sdk/models/index";

export default class CustomerModel extends UserModel {

    /**
     * @inheritDoc
     */
    constructor(id = -1, name = 'You', avatar = null) {
        super(id, name, avatar);
    }
}
