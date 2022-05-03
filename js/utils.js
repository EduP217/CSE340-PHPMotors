function saveLocalStorageItem(key,value) {
    localStorage.setItem(key, value);
}

function getLocalStorageItem(key) {
    return localStorage.getItem(key);
}

function validateLocalStorageKey(key) {
    return getLocalStorageItem(key) === true;
}