import React from 'react';
import { useQuery, VideoProjectIdType } from '../gqty';
import VideoPlayer from './VideoPlayer';


export default function VideoGallery(props: {
    id: string;
}) {
    const { id } = props;

    const project = useQuery().videoProject({
        id,
        idType: VideoProjectIdType.DATABASE_ID
    });

    const { videos = [] } = project.videoAttributes ?? {};

    return (
        <div className="w-full flex flex-col items-center">
            {videos?.map((v, index) => (
                <VideoPlayer
                    key={index}
                    type={v.file.mimeType}
                    src={v.file.mediaItemUrl}
                    className="mx-4"
                />
            ))}
        </div>
    )
}
