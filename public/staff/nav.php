<nav class="navbar navbar-expand-lg sticky-top fs-5 shadow p-3 mb-5">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
            <i class="bi bi-list"></i> <?= TITLE; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <button class="nav-link btn btn-light dropdown-toggle fs-5 dropdown-toggle-no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="icon_text"></span>
                    </button>
                    <ul class="dropdown-menu ">
                        <li>
                            <a class="dropdown-item btn_dark" href="#"><i class="bi bi-moon-stars"></i> Dark</a>
                        </li>
                        <li>
                            <a class="dropdown-item btn_light" href="#"><i class="bi bi-brightness-high"></i> Light</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light <?= ($page == "dashboard") ? 'active' : '' ?>" href="index">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" href="#">
                        Notifications <span class="badge text-bg-secondary">4</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a href="#" class="btn btn-danger" onclick="logOut()">
                        <i class="bi bi-box-arrow-left"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-1">
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                Menu
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == "dashboard") ? 'active_link' : '' ?>" aria-current="page" href="index">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="borrow" class="nav-link <?= ($page == "borrow") ? 'active_link' : '' ?>" aria-current="page">
                                <i class="bi bi-journal-arrow-up"></i>
                                Borrow Equipment
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="" class="nav-link <?= ($page == "returned") ? 'active_link' : '' ?>" aria-current="page">
                                <i class="bi bi-ui-checks"></i>
                                Returned Equipment
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="" class="nav-link <?= ($page == "log") ? 'active_link' : '' ?>" aria-current="page">
                                <i class="bi bi-activity"></i>
                                Activity Log
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="logOutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-body">
        <h3 class="modal-title fs-5 text-danger">You are about to end your current session. Please save your work before continuing.</h3>
        <br>
        <span class="mb-4">
            If you accept, you will be logged out.
        </span>
        <div class="float-end mt-4">
            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
            <a  href="../../logout" class="btn btn-danger ">Accept & log out</a>
        </div>
      </div>
    </div>
  </div>
</div>

