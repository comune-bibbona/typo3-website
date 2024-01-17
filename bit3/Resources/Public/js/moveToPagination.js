const urlParams = new URLSearchParams(window.location.search);
const currentPage = urlParams.get('tx_news_pi1[currentPage]');
if(currentPage != null){
    const anchor = document.getElementById("paginatedList");
    offset = anchor.getBoundingClientRect();
    window.scrollTo(0, offset.top);
    console.log(offset);
}