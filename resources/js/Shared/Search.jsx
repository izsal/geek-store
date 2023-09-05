//import React
import React, { useState } from "react";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

export default function Search({ URL }) {
    //define state search
    const [search, setSearch] = useState("");

    //function "searchHandler"
    const searchHandler = (e) => {
        e.preventDefault();

        //fetch to search
        Inertia.get(`${URL}?q=${search}`);
    };

    return (
        <>
            <form onSubmit={searchHandler}>
                <div class="input-group">
                    <input
                        type="text"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                        class="form-control border-0 shadow-sm"
                        placeholder="type keywords and enter..."
                    />
                    <span class="input-group-text-search border-0 shadow-sm">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </form>
        </>
    );
}
