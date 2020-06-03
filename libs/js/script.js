
function toggleSideBar() {
    var sideBar = document.getElementById("js__sidebar");
    var main_page = document.getElementById("js__main-page");

    if (sideBar.style.width === '250px')
    {

        sideBar.style.width = '0px';
        main_page.style.marginLeft='0px';
    }
    else
    {
        sideBar.style.width = '250px';
        main_page.style.marginLeft='250px';
    }
}