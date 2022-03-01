import React, { useEffect, useRef, useState } from 'react';
import styled from 'styled-components';
import { useQuery, PostObjectsConnectionOrderbyEnum, OrderEnum, VideoProject_Videoattributes_videos } from '../gqty';


const Video = styled.video<{
    show: boolean;
}>`
    width: 1000px;
    max-width: 80%;
    max-height: 90%;
    position: absolute;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    transition: opacity .4s;
    opacity: ${props => props.show ? 1 : 0};
`;


const Link = styled.a`
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
`;


const Title = styled.h2`
    font-size: 45px;
    max-width: 900px;
    text-align: center;
    opacity: 1;
    transition: opacity .4s, color .1s;
`;


export default function VideosIndex() {
    const projects = useQuery().videoProjects({
        where: {
            orderby: [
                {
                    field: PostObjectsConnectionOrderbyEnum.MENU_ORDER,
                    order: OrderEnum.ASC
                }
            ]
        }
    }).nodes;

    const videoRef = useRef(null);

    const [selected, setSelected] = useState(null);
    const [selectedVideo, setSelectedVideo] = useState<VideoProject_Videoattributes_videos | null>(null);
    
    useEffect(() => {
        if (window.innerWidth < 1024) {
            setSelectedVideo(null);
            return;
        }

        const videos = projects?.find(p => p.id === selected)?.videoAttributes?.videos ?? [];
        const randomIndex = Math.floor((Math.random()) * ((videos.length - 1) + 1));
        setSelectedVideo(videos[randomIndex] ?? null);
    }, [selected]);

    useEffect(() => {
        if (selectedVideo && selectedVideo.file.mediaItemUrl) {
            videoRef.current.currentTime = 0;
            videoRef.current.muted = false;
            videoRef.current.play();
        } else {
            videoRef.current.pause();
            videoRef.current.muted = true;
        }
    }, [selectedVideo]);

    return (
        <>
            <Video
                ref={videoRef}
                show={!!selected}
                muted
            >
                {!!selectedVideo && (
                    <source
                        type={selectedVideo.file.mimeType}
                        src={selectedVideo.file.mediaItemUrl}
                    />
                )}
            </Video>

            <div className="w-full h-full flex flex-col justify-center items-center mx-4">
                {projects?.map((p, index) => (
                    <Link
                        key={index}
                        href={p.link}
                        className={`flex mb-16 lg:mb-0 ${selected === p.id ? 'selected' : ''} ${!!selected && selected !== p.id ? 'not-selected' : ''}`}
                        onMouseEnter={() => setSelected(p.id)}
                        onMouseLeave={() => setSelected(null)}
                    >
                        <Title>
                            {p.title()}
                        </Title>
                    </Link>
                ))}
            </div>
        </>
    );
}
