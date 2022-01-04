function slugify (str) {
    return str.replaceAll(/\s|_/g, '-');
}


export default [
    ['slugify', slugify]
];
