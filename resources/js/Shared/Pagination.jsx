//import react
import React from "react";

//import Link
import { Link } from "@inertiajs/inertia-react";

export default function Pagination({ links, align }) {
    return (
        <>
            <nav>
                <ul className={`pagination justify-content-${align} mb-0`}>
                    {links.map((link, index) => (
                        <li
                            className={`page-item ${
                                link.url == null
                            } ? 'disabled' : '' ${link.active ? "active" : ""}`}
                            key={index}
                        >
                            <Link
                                className="page-link"
                                href={link.url === null ? "#" : link.url}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            ></Link>
                        </li>
                    ))}
                </ul>
            </nav>
        </>
    );
}
