loadMenuData();
var userId = $("#userSildeBar").val(); 
console.log("Userid:------", userId);
setTimeout(() => {
    document.querySelectorAll("sidebar-item").forEach(item =>{
        item.addEventListener("click", () => {
            item.classList.toggle("collapse")
            item.querySelector('.sidebar-link collapsed').classList.toggle("show")
        })
    })
}, 2000);
function loadMenuData() {
   
    var sendData = {
        action: "getUserMenus",
        // "userId": userId,
    };
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../api/authorities.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;
            var menuElement = "";
            var category = "";
            if (status) {
                response.forEach(menu => {
                    if(menu['categoryName'] !== category){
                        if(category !== ''){
                            menuElement += '</ul></li></ul>';
                        }
                        menuElement += `
                        <ul class="sidebar-nav" >
            
                        <li class="sidebar-item active">
                        <a
                            data-bs-target="#dashboards"
                            data-bs-toggle="collapse"
                            class="sidebar-link"
                        >
                            <i class="align-middle ${menu['categoryIcon']}" ></i>
                            <span class="align-middle">${menu['categoryName']}</span>
                            <span class="badge badge-sidebar-primary">></span>
                        </a>
                        <ul
                        id="dashboards"
                        class="sidebar-dropdown list-unstyled collapse show"
                        data-bs-parent="#sidebar"
                        id=""
                    >
                       
                        `;

                        category = menu['categoryName'];
                      
                    }
                    menuElement +=  `
                    <li class="sidebar-item active">
                    <a class="sidebar-link" href="../views/${menu['link']}">${menu['linkName']}</a
                    >
                    </li>
                    `
                    

                })
                $("#userMenu").append(menuElement);

                let href =window.location.href.split("/");
                let url = href[href.length-1];
                let currentPage= document.querySelector(`[current_link='${url}"]`);
                currentPage.classList = "active";
                currentPage.parentElement.classList.toggle("show")
            } 
        },
    });
}