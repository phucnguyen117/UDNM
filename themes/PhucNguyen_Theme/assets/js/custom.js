document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".youtube-lazy").forEach(function(el) {
        el.addEventListener("click", function() {
            const videoId = this.dataset.id;
            const listId = this.dataset.list;
            const title = this.dataset.title;
            let src = "https://www.youtube-nocookie.com/embed/" + videoId + "?autoplay=1";
            if (listId) src += "&list=" + listId;

            const iframe = document.createElement("iframe");
            iframe.setAttribute("src", src);
            iframe.setAttribute("title", title);
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share");
            iframe.setAttribute("allowfullscreen", "1");
            iframe.setAttribute("loading", "lazy");
            iframe.setAttribute("referrerpolicy", "strict-origin-when-cross-origin");
            iframe.setAttribute("sandbox", "allow-scripts allow-same-origin allow-popups allow-presentation");

            this.innerHTML = "";
            this.appendChild(iframe);
        });
    });
});
