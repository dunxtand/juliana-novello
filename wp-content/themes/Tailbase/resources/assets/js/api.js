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


export {};
