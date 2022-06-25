const currentDate = new Date();
const lastUpdateKey = "lastUpdated";

const months = {
    0: 'January',
    1: 'February',
    2: 'March',
    3: 'April',
    4: 'May',
    5: 'June',
    6: 'July',
    7: 'August',
    8: 'September',
    9: 'October',
    10: 'November',
    11: 'December'
}

function calculateLastUpdate() {
    let lastUpdated = getLocalStorageItem(lastUpdateKey);
    if(lastUpdated){
        lastUpdated = new Date(lastUpdated);
    } else {
        lastUpdated = currentDate;
    }
    
    saveLocalStorageItem(lastUpdateKey, currentDate);
    
    let lastUpdatedTextDisplay = `Last Updated: ${leadZeros(lastUpdated.getDate())} ${months[lastUpdated.getMonth()]}, ${lastUpdated.getFullYear()}`;
    document.getElementById("last-updated").innerHTML = lastUpdatedTextDisplay;
}

function leadZeros(num) {
    return num.toString().padStart(2,'0');
}

calculateLastUpdate();