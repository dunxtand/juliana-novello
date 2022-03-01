import React, { useState, useEffect } from 'react';
import styled, { css } from 'styled-components';
import { useQuery, ProjectIdType, MediaItemSizeEnum } from '../gqty';


const Lightbox = styled.div<{
    show: boolean;
}>`
    background: rgba(0, 0, 0, .8);

    ${props => {
        if (props.show) {
            return css`
                transition: opacity .3s, z-index 0s;
            `;
        }
    }}

    opacity: ${props => props.show ? 1 : 0};
    z-index: ${props => props.show ? 100 : -100};

    img {
        position: absolute;
        opacity: 0;
        max-height: 94%;
        z-index: 101;
        transition: opacity .3s;
        max-width: 100%;
        @media(min-width: 640px) {
            max-width: 80%;
        }
        &.show {
            opacity: 1;
        }
    }

    .controls {
        color: white;
        z-index: 101;
    }

    .controls-prev, .controls-next {
        font-size: 50px;
        z-index: 102;
    }

    .controls-prev {
        transform: rotate(180deg);
    }

    .controls-close {
        font-size: 30px;
    }
`;


export default function ProjectGallery(props: {
    id: string;
}) {
    const { id } = props;

    const project = useQuery().project({
        id,
        idType: ProjectIdType.DATABASE_ID
    });

    const { gallery } = project?.projectAttributes ?? {};

    const [currentIndex, setCurrentIndex] = useState(null);
    const currentImage = gallery[currentIndex] ?? null;

    return (
        <div className="flex flex-wrap items-center justify-center w-full lg:w-3/4 mx-auto">
            {gallery?.map((image, index) => (
                <a
                    key={index}
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        setCurrentIndex(index);
                    }}
                    className="w-full lg:w-1/2"
                >
                    <img
                        src={image.sourceUrl({ size: MediaItemSizeEnum.MEDIUM_LARGE })}
                        alt=""
                        className="image-item m-4"
                        style={{ maxWidth: '90%' }}
                    />
                </a>
            ))}

            <Lightbox
                show={typeof currentIndex === 'number'}
                className="fixed top-0 flex justify-center items-center w-full h-screen"
            >
                <a
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        const prev = currentIndex - 1 < 0
                            ? gallery.length - 1
                            : currentIndex - 1;
                        setCurrentIndex(prev);
                    }}
                    className="controls controls-prev absolute bottom-0 sm:bottom-auto left-0 ml-4"
                >
                    ➬
                </a>

                {gallery.map((image, index) => (
                    <img
                        key={index}
                        src={image.sourceUrl({ size: MediaItemSizeEnum._1536X1536 })}
                        className={currentIndex === index ? 'show' : ''}
                    />
                ))}

                <a
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        setCurrentIndex(null);
                    }}
                    className="controls controls-close absolute top-0 right-0 mt-2 mr-6"
                >
                    &#x2715;
                </a>

                <a
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        const next = currentIndex + 1 > (gallery.length - 1)
                            ? 0
                            :currentIndex + 1;
                        setCurrentIndex(next);
                    }}
                    className="controls controls-next absolute bottom-0 sm:bottom-auto right-0 mr-4"
                >
                    ➫
                </a>
            </Lightbox>
        </div>
    )
}
