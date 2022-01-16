export function validateJSON (val) {
    try {
        JSON.parse(val);
        return true;
    } catch (e) {
        return false;
    }
};


export function preloadImage (src) {
    const image = new Image();
    image.src = src;
    image.onload = () => console.log(`${src} loaded`);
}


export function noop () {}
