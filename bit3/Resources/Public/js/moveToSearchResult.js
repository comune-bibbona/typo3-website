const anchor = document.getElementById("searchResult");
offset = anchor.getBoundingClientRect();
window.scrollTo(0, offset.top);
console.log(offset);