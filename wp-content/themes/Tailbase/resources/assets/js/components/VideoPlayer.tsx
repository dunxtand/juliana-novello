import React, { useRef, useState, useEffect } from 'react';
import styled from 'styled-components';


const Video = styled.video`
    @media (min-width: 1024px) {
        width: 900px;
    }
`;


export default function VideoPlayer(props: {
    type: string;
    src: string;
    className?: string;
}) {
    const {
        type,
        src,
        className = ''
    } = props;

    const ref = useRef(null);

    const [fullscreenSupported, setFullscreenSupported] = useState(true);

    useEffect(() => {
        // @ts-ignore
        setFullscreenSupported(document.fullscreenEnabled || document.mozFullscreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled)
    }, []);

    return (!type || !src) ? null : (
        <div className={className ?? ''}>
            <Video
                ref={ref}
                muted
            >
                <source
                    type={type}
                    src={src}
                />
            </Video>

            <div className="flex justify-end mt-1">
                <a
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        ref.current.muted = false;
                        ref.current.play();
                    }}
                >
                    play
                </a>
                <a
                    href="#"
                    onClick={e => {
                        e.preventDefault();
                        ref.current.pause();
                        ref.current.muted = true;
                    }}
                    className="ml-4"
                >
                    pause
                </a>
                {fullscreenSupported && (
                    <a
                        href="#"
                        onClick={e => {
                            e.preventDefault();
                            ref.current.requestFullscreen();
                        }}
                        className="ml-4"
                    >
                        fullscreen
                    </a>
                )}
            </div>
        </div>
    )
}
