function wrap (promise) {
    return promise.then(res => {
        if (!res.ok) {
            return res.json().then(err => {
                throw new Error(err);
            });
        }

        return res.json();
    });
}


const getCarouselData = pageId => wrap(fetch(`/wp-json/pages/${pageId}/carousel-data`));

const getTeamMembers = () => wrap(fetch('/wp-json/team/members'));

const getContactForm = pageId => wrap(fetch(`/wp-json/contact/${pageId}/form`));

const addContactFormEntry = (pageId, data) => wrap(fetch(`/wp-json/contact/${pageId}/entries`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
}));

const getJobs = pageId => wrap(fetch('/wp-json/jobs/all'));


export {
    getCarouselData,
    getTeamMembers,
    getContactForm,
    addContactFormEntry,
    getJobs
};
