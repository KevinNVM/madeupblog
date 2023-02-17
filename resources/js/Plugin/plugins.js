export * from "vue-toastification";

/**
 * @param {str} param0 HTML String
 * @returns String | Undefined
 */
export const escapeHTML = (str = "", stripTags = false) => {
    if (stripTags) {
        var div = document.createElement("div");
        div.innerHTML = str;
        return div.innerText;
    }

    return new Option(str).innerHTML;
};

/**
 * @param {body} param0 posts
 * @returns String | Undefined
 */
export const getPostThumbnail = ({ body = "" }) => {
    // check if post body has img tag
    const parser = new DOMParser();
    const html = parser.parseFromString(body, "text/html");
    const source = html.querySelectorAll("img")[0]?.src;
    return source;
};

export function fallbackCopyTextToClipboard(text = "") {
    var textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        console.log("Fallback: Copying text command was " + msg);
    } catch (err) {
        console.error("Fallback: Oops, unable to copy", err);
        document.body.removeChild(textArea);
        return false;
    }

    document.body.removeChild(textArea);
    return true;
}
export function copyTextToClipboard(text = "") {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(
        function () {
            console.log("Async: Copying to clipboard was successful!");
        },
        function (err) {
            console.error("Async: Could not copy text: ", err);
            return false;
        }
    );
    return true;
}
