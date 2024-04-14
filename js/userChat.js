

const  searchBar = document.querySelector(".users .search input");
const  userList = document.querySelector(".users .users-list");




searchBar.onkeyup = () => {

    let searchTerm = searchBar.value;

    if(searchTerm != "") {

    }

    let xrm = new XMLHttpRequest();

    xrm.open("POST", "search.php", true);

    xrm.onload = () => {
        if(xrm.readyState == XMLHttpRequest.DONE) {
            if(xrm.status === 200) {
                let data = xrm.response;
                userList.innerHTML = data;
            }
        }
    }

    xrm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xrm.send("searchTerm=" + searchTerm);
}