// Called when the url of a tab changes.
function checkForValidUrl(tabId, changeInfo, tab) {
    if (tab.url.indexOf('postiles.com') > -1 || tab.url.indexOf('127.0.0.1') > -1) {
        chrome.pageAction.show(tabId);
    }
};

chrome.tabs.onUpdated.addListener(checkForValidUrl);

chrome.pageAction.onClicked.addListener(function(tab) {
    chrome.windows.getCurrent(function (win) {
        chrome.tabs.captureVisibleTab(null, {"format":"png"}, function(imgUrl) {
            chrome.tabs.executeScript(tab.id, { code: 'window.postMessage({ action: "SCREENSHOT", img: "'+imgUrl+'" }, "*")' });
        });    
    });    
});

function install_notice() {
    if (localStorage.getItem('install_time')) {
        return;
    }
        
    var now = new Date().getTime();
    localStorage.setItem('install_time', now);
    alert("You've installed Postile's feedback extension. When visiting postiles, you'll see a icon on the right of your address bar. Click that to send a report. Thanks. You may need to refresh the postiles tab or restart the browser before the first use.");
}

install_notice();