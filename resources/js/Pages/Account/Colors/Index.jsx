//import react
import React from "react";

//import layout
import LayoutAccount from "../../../Layouts/Account";

//import Head, usePage, Link
import { Head, usePage, Link } from "@inertiajs/inertia-react";

//import permissions
import hasAnyPermission from "../../../Utils/Permissions";

//import component search
import Search from "../../../Shared/Search";

//import component pagination
import Pagination from "../../../Shared/Pagination";

export default function ColorIndex() {
    //destruct props "colors"
    const { colors } = usePage().props;

    return (
        <>
            <Head>
                <title>Colors - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3 col-12 mb-2">
                                <Link
                                    href="/account/colors/create"
                                    class="btn btn-md btn-success border-0 shadow w-100"
                                    type="button"
                                >
                                    <i class="fa fa-plus-circle me-2"></i>
                                    Tambah
                                </Link>
                            </div>
                            <div class="col-md-9 col-12 mb-2">
                                <Search URL={"/account/colors"} />
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row mt-2 mb-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-palette"></i> Colors
                                </span>
                            </div>
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-bordered table-striped table-hovered">
                                        <thead>
                                            <tr>
                                                <th
                                                    scope="col"
                                                    style={{ width: "5%" }}
                                                >
                                                    No.
                                                </th>
                                                <th
                                                    scope="col"
                                                    style={{ width: "15%" }}
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    style={{ width: "15%" }}
                                                >
                                                    Color
                                                </th>
                                                <th
                                                    scope="col"
                                                    style={{ width: "15%" }}
                                                >
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {colors.data.map((color, index) => (
                                                <tr key={index}>
                                                    <td className="text-center">
                                                        {++index +
                                                            (colors.current_page -
                                                                1) *
                                                                colors.per_page}
                                                    </td>
                                                    <td>{color.name}</td>
                                                    <td className="text-center">
                                                        <img
                                                            src={color.image}
                                                            className="rounded-circle"
                                                            width={"30"}
                                                        />
                                                    </td>
                                                    <td className="text-center">
                                                        {hasAnyPermission([
                                                            "colors.edit",
                                                        ]) && (
                                                            <Link
                                                                href={`/account/colors/${color.id}/edit`}
                                                                className="btn btn-primary btn-sm me-2"
                                                            >
                                                                <i className="fa fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {hasAnyPermission([
                                                            "colors.delete",
                                                        ]) && (
                                                            <button className="btn btn-danger btn-sm">
                                                                <i className="fa fa-trash"></i>
                                                            </button>
                                                        )}
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>

                                <Pagination
                                    links={colors.links}
                                    align={"end"}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
