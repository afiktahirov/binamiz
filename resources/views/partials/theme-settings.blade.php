<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Soft UI Konfiquratoru</h5>
                <p>Panel seçimlərimizə baxın.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Yan Panel Rəngləri</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-default active" data-color="default" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Növü</h6>
                <p class="text-sm">2 müxtəlif sidenav növü arasında seçim edin.</p>
            </div>
            <div class="d-flex justify-content-around">
                <button class="btn btn-outline-primary w-45 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Şəffaf</button>
                <button class="btn btn-outline-primary w-45 px-3 mb-2" data-class="bg-white" onclick="sidebarType(this)">Ağ</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">Sidenav növünü yalnız masaüstü görünüşdə dəyişə bilərsiniz.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0">Sabit Navbar</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
            </div>
            <hr class="horizontal dark my-sm-4">
            <div class="mt-2">
                <h6 class="mb-0">Light/Dark</h6>
            </div>
            <div class="form-check form-switch ps-0 is-filled">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
            </div>

            <!-- Reset Settings Button -->
            <!-- <div class="mt-3">
                <h6 class="mb-0">Nizamlamaları Sıfırla</h6>
                <p class="text-sm">Bütün dizayn seçimlərinizi sıfırlayın.</p>
                <button class="btn btn-outline-danger w-100 mb-2" id="resetSettings">Sıfırla</button>
            </div> -->
        </div>
    </div>
</div>