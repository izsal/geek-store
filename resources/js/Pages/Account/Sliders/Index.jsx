//import react
import React from "react";

//import layout
import LayoutAccount from "../../../Layouts/Account";

//import Head, usePage
import { Head, usePage } from "@inertiajs/inertia-react";

//import component delete
import Delete from "../../../Shared/Delete";

//import component slider create
import SliderCreate from "./Create";

export default function SliderIndex() {
    //destruct props "sliders"
    const { sliders } = usePage().props;

    return (
        <>
            <Head>
                <title>Sliders - Geek Store</title>
            </Head>
            <LayoutAccount>
                <SliderCreate />

                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-images"></i> Image
                                    Sliders
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
                                                    style={{ width: "20%" }}
                                                >
                                                    Image
                                                </th>
                                                <th
                                                    scope="col"
                                                    style={{ width: "15%" }}
                                                >
                                                    Link
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
                                            {sliders.data.map(
                                                (slider, index) => (
                                                    <tr key={index}>
                                                        <td className="text-center">
                                                            {++index +
                                                                (sliders.current_page -
                                                                    1) *
                                                                    sliders.per_page}
                                                        </td>
                                                        <td className="text-center">
                                                            <img
                                                                src={
                                                                    slider.image
                                                                }
                                                                width={"200"}
                                                                className="rounded-3"
                                                            />
                                                        </td>
                                                        <td className="text-center">
                                                            {slider.link}
                                                        </td>
                                                        <td className="text-center">
                                                            <Delete
                                                                URL={
                                                                    "/account/sliders"
                                                                }
                                                                id={slider.id}
                                                            />
                                                        </td>
                                                    </tr>
                                                )
                                            )}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
