import React, { useState, useEffect } from 'react';
import styled from 'styled-components';
import { useQuery, MediaItemSizeEnum, PostObjectsConnectionOrderbyEnum, OrderEnum } from '../gqty';


const Wrapper = styled.div`
    img {
        max-width: 63%;
        max-height: 90%;
        position: absolute;
        z-index: 1;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity .4s;
        &.show {
            opacity: 1;
        }
    }

    a {
        z-index: 10;
        &.selected {
            h2 {
                color: #ccf4f9;
            }
        }

        &.not-selected {
            h2 {
                opacity: 0;
            }
        }

        h2 {
            font-size: 45px;
            max-width: 900px;
            text-align: center;
            opacity: 1;
            transition: opacity .4s, color .1s;
        }
    }

    h2 {
        font-size: 45px;
        text-align: center;
    }
`;


export default function ProjectsIndex() {
    const projects = useQuery().projects({
        where: {
            orderby: [
                {
                    field: PostObjectsConnectionOrderbyEnum.MENU_ORDER,
                    order: OrderEnum.ASC
                }
            ]
        }
    }).nodes;
    
    const images = projects.reduce((images, p) => {
        const featuredImages = p.projectAttributes?.gallery?.filter(image => {
            return image?.imageAttributes?.featured;
        }).map(image => {
            return image.sourceUrl({ size: MediaItemSizeEnum._1536X1536 });
        })

        return images.concat(featuredImages);
    }, []);

    const [selected, setSelected] = useState(null);
    const [image, setImage] = useState(null);

    useEffect(() => {
        if (!selected) {
            setImage(null);
            return;
        }

        const selectedProject = projects.find(item => item.id === selected) ?? null;
        const featured = selectedProject?.projectAttributes.gallery.filter(image => image.imageAttributes.featured) ?? [];
        const randomIndex = Math.floor((Math.random()) * ((featured.length - 1) + 1));
        setImage(featured[randomIndex].sourceUrl({ size: MediaItemSizeEnum._1536X1536 }));
    }, [selected]);

    return (
        <Wrapper className="w-full h-full flex justify-between pt-4 pb-24">
            {images.map((src, index) => (
                <img
                    key={index}
                    src={src}
                    className={`mt-6 ${image === src ? 'show' : ''}`}
                />
            ))}

            <div className="w-full h-full flex flex-col justify-between items-center mx-4">
                {projects.map((p, index) => (
                    <a
                        key={index}
                        href={p.link}
                        className={`flex mb-16 lg:mb-0 ${selected === p.id ? 'selected' : ''} ${!!selected && selected !== p.id ? 'not-selected' : ''}`}
                        onMouseEnter={() => setSelected(p.id)}
                        onMouseLeave={() => setSelected(null)}
                    >
                        <h2>
                            {p.title()}
                        </h2>
                    </a>
                ))}
            </div>
        </Wrapper>
    );
}
