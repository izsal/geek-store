//import usePage
import { usePage } from "@inertiajs/inertia-react";

export default function hasAnyPermission(permissions) {
    //destruct auth from props
    const { auth } = usePage().props;

    //get permissions from props
    let allPermissions = auth.permissions;

    let hasPermission = false;

    permissions.forEach(function (item) {
        if (allPermissions[item]) hasPermission = true;
    });

    return hasPermission;
}
