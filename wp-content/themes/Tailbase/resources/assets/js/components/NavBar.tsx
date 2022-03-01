import React, { useState } from 'react';
import styled from 'styled-components';
import { useQuery, MenuLocationEnum, MediaItemSizeEnum } from '../gqty';



export default function NavBar() {
    const items = useQuery().menuItems({
        where: {
            location: MenuLocationEnum.MAIN_MENU
        }
    }).nodes;

    const [tooltip, setTooltip] = useState(null);

    return (
        <>
            <a href="/">
                <h3>
                    juliana roccoforte novello
                </h3>
            </a>

            <div className="fixed bottom-0 lg:top-0 lg:right-0 lg:bottom-auto flex w-full lg:w-auto justify-center items-center mb-2 lg:mb-0 lg:mr-2 lg:mt-2">
                {tooltip && (
                    <div className="mr-2">
                        {tooltip}
                    </div>
                )}

                {items.map((item, index) => (
                    <a
                        key={index}
                        href={item.path}
                        className="flex items-center mx-4"
                    >
                        <img
                            src={item.menuItemAttributes?.image?.sourceUrl({ size: MediaItemSizeEnum.MEDIUM }) ?? ''}
                            alt={item.label}
                            onMouseOver={() => setTooltip(item.label ?? null)}
                            onMouseOut={() => setTooltip(null)}
                            style={{ width: 40 }}
                        />
                    </a>
                ))}
            </div>
        </>
    );
}
