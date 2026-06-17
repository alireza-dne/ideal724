const toggleOn = document.querySelector('.toggle-on');
const toggleOff = document.querySelector('.toggle-off');
const searchLogo = document.querySelector('.search-logo');
const times = document.querySelector('.times')
const serachBox = document.querySelector('.serach-box')
const fullscreen = document.querySelector('.fullscreen');
const ownBell = document.querySelector('.own-bell');
const notifications = document.querySelector('.notifications')
const commentLogo = document.querySelector('.comment-logo');
const comments = document.querySelector('.comments');
const headerProfile = document.querySelector('.header-profile');
const headerProfileTitle = document.querySelector('.header-profile .title');
const elem = document.documentElement;
const expand = document.querySelector('.expand');
const compress = document.querySelector('.compress');
const sidebarDropdownToggles = document.querySelectorAll('.sidebar-dropdown-toggle');
const sidebar = document.querySelector('#sidebar');
const mainBody = document.querySelector('.main-body');
const ellipsis = document.querySelector('.ellipsis');
const bodyHeader = document.querySelector('.body-header');





toggleOn.addEventListener('click', changeToggle);
toggleOff.addEventListener('click', changeToggle);
searchLogo.addEventListener('click', showSearchBox);
times.addEventListener('click', hideSearchBox)
fullscreen.addEventListener('click', full)
ownBell.addEventListener('click', notification)
commentLogo.addEventListener('click', comment);
headerProfileTitle.addEventListener('click', profile);
expand.addEventListener('click', openFullscreen);
compress.addEventListener('click', closeFullscreen);
for (let i = 0; i < sidebarDropdownToggles.length; i++) {
    sidebarDropdownToggles[i].onclick = function() { sidebarDropdownToggleAccordion(i) }
}
ellipsis.addEventListener('click', bodyHeaderChanger);



function sidebarDropdownToggleAccordion(i) {
    let sideBarScrollHeighr = (sidebarDropdownToggles[i].querySelector('.sidebar-dropdown')).scrollHeight;
    sidebarDropdownToggles[i].classList.toggle('active');

    if (sidebarDropdownToggles[i].classList.contains('active')) {
        sidebarDropdownToggles[i].querySelector('.sidebar-dropdown').style.height = sideBarScrollHeighr + 'px';
    } else {
        sidebarDropdownToggles[i].querySelector('.sidebar-dropdown').style.height = 0;
    }
}

function changeToggle() {
    toggleOn.classList.toggle('active');
    toggleOff.classList.toggle('active');
    sidebarStatus();
}

function showSearchBox() {
    serachBox.classList.add('active');
}

function hideSearchBox() {
    serachBox.classList.remove('active');

}

function full() {
    fullscreen.classList.toggle('full');
}

function notification() {
    notifications.classList.toggle('active');
}

function comment() {
    comments.classList.toggle('active');
}

function profile() {
    headerProfile.classList.toggle('active');
}

function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
    }
}

function sidebarStatus() {
    sidebar.classList.toggle('active');
    mainBody.classList.toggle('active');

}

function bodyHeaderChanger() {
    bodyHeader.classList.toggle('active');
}

if (window.innerWidth <= 768) {
    toggleOn.classList.remove('active');
    toggleOff.classList.add('active');

}