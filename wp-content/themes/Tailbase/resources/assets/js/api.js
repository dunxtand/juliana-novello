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


const getContactForm = pageId => wrap(fetch(`/wp-json/contact/${pageId}/form`));

const addContactFormEntry = (pageId, data) => wrap(fetch(`/wp-json/contact/${pageId}/entries`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
}));


export {
    getContactForm,
    addContactFormEntry
};
