<nav id="adminSidebar" class="admin-sidebar shadow-sm">

    <div class="brand">
        <div class="brand-inner">
            <img src="../../assets/images/logo.png" alt="BaoBites">
            <div class="title nav-text">BaoBites</div>
        </div>
    </div>

    <button id="sidebarToggle" class="sidebar-toggle-btn">
        <i class="bi bi-list"></i>
    </button>

    <div class="nav-section p-3 pt-2">
        <ul class="nav flex-column">

            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="admin.php">
                    <i class="bi bi-speedometer2 nav-icon"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="manage_recipes.php">
                    <i class="bi bi-journal-text nav-icon"></i>
                    <span class="nav-text">Manage Recipes</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="manage_users.php">
                    <i class="bi bi-people nav-icon"></i>
                    <span class="nav-text">Manage Users</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="reports.php">
                    <i class="bi bi-flag nav-icon"></i>
                    <span class="nav-text">Reports</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="logout-container">
        <a href="../logout.php" class="btn btn-outline-danger logout-btn">
            <i class="bi bi-box-arrow-right"></i>
            <span class="nav-text ms-2">Logout</span>
        </a>
    </div>

</nav>

<script>
$("#sidebarToggle").on("click", function () {
    const sidebar = $("#adminSidebar");
    const main = $("#adminMain");
    const icon = $(this).find("i");

    sidebar.toggleClass("collapsed");
    main.toggleClass("collapsed");

    // switch icon
    if (sidebar.hasClass("collapsed")) {
        icon.removeClass("bi-list").addClass("bi-x-lg");
    } else {
        icon.removeClass("bi-x-lg").addClass("bi-list");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const current = window.location.pathname.split("/").pop();

    document.querySelectorAll(".admin-sidebar .nav-link").forEach(link => {
        if (link.getAttribute("href") === current) {
            link.classList.add("active-menu");
        }
    });
});
</script>
