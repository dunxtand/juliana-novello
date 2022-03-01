import React, { useState, useEffect } from 'react';
import styled from 'styled-components';
import { useQuery, PostObjectsConnectionOrderbyEnum, OrderEnum, PostObjectFieldFormatEnum } from '../gqty';


const Wrapper = styled.div`
    height: 100%;

    a {
        h2 {
            font-size: 45px;
            transition: opacity .4s, color .3s;
        }

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
    }

    .selected-content {
        width: 500px;
        position: absolute;
        top: 90px;
    }
`;


export default function WritingIndex() {
    const posts = useQuery().posts({
        where: {
            orderby: [
                {
                    field: PostObjectsConnectionOrderbyEnum.DATE,
                    order: OrderEnum.ASC
                }
            ]
        }
    }).nodes;

    const [selectedIndex, setSelectedIndex] = useState(null);
    const [content, setContent] = useState('');
    const [timeouts, setTimeouts] = useState([]);

    useEffect(() => {
        const post = posts[selectedIndex];

        if (post) {
            const tempContainer = document.createElement('div');
            tempContainer.innerHTML = post.content();
            const postContent = tempContainer.textContent;

            let letters = postContent
                .split('')
                .map(letter => {
                    if (letter === '\n' || letter === '\r') {
                        return '<br>';
                    }
                    return letter;
                })
                .filter((letter, index, arr) => {
                    if (letter !== '<br>') {
                        return true;
                    }
                    return arr[index + 1] !== letter;
                });
            
            if (letters[0] === '<br>') {
                letters = letters.slice(1);
            }

            setTimeouts(
                letters.map((letter, index) => {
                    return setTimeout(() => {
                        setContent(prevContent => prevContent + letter);
                    }, index * 45);
                })
            );

        } else {
            setContent('');
            timeouts.forEach(timeoutID => clearTimeout(timeoutID));
            setTimeouts([]);
        }
        
    }, [selectedIndex]);

    return (
        <Wrapper className="flex flex-col justify-between items-center">
            {posts.map((p, index) => {
                // shortcut to make a request for the content
                p.content();

                return (
                    <a
                        key={index}
                        href={p.link}
                        onMouseEnter={() => setSelectedIndex(index)}
                        onMouseLeave={() => setSelectedIndex(null)}
                        className={`relative flex justify-center mb-16 lg:mb-6 mx-4 ${selectedIndex === index ? 'selected' : ''} ${selectedIndex !== null && selectedIndex !== index ? 'not-selected' : ''}`}
                    >
                        <h2 className="text-center">
                            {p.title()}
                        </h2>

                        {selectedIndex === index && (
                            <div
                                dangerouslySetInnerHTML={{ __html: content }}
                                className="selected-content lin-libertine"
                            />
                        )}
                    </a>
                );
            })}
        </Wrapper>
    );
}
