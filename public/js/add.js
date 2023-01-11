
const ModalContainer = document.querySelector('[ModalContainer]')
const ModalBackground = document.querySelector('[ModalBackground]')
const ModalContent = document.querySelector('[ModalContent]'),
    ModalHeader = document.querySelector('[ModalHeader]'),
    ModalBody = document.querySelector('[ModalBody]');
var isCreatePostModalOpen = false;
var isFirstTimeCreatePostModalOpen = false;

const openCreatePost = () => {
    if (!isCreatePostModalOpen) {
        if (!isFirstTimeCreatePostModalOpen) {
            ModalContent.classList.remove('hidden')
            isFirstTimeCreatePostModalOpen = true
        }
        ModalContent.classList.remove('Modal-ScaleOut-Center');
        ModalBackground.classList.remove('invisible')
        ModalBackground.classList.remove('opacity-0')
        ModalContainer.classList.add('ModalContainer')
        ModalContent.classList.add('Modal-ScaleIn-Center');
        isCreatePostModalOpen = true;
    }
}

const closeCreatePost = () => {
    if (isCreatePostModalOpen) {
        ModalContent.classList.remove('Modal-ScaleIn-Center')
        ModalContent.classList.add('Modal-ScaleOut-Center')
        setTimeout(() => {
            ModalContainer.classList.remove('ModalContainer')
        }, 200);
        ModalBackground.classList.add('invisible')
        ModalBackground.classList.add('opacity-0')
        isCreatePostModalOpen = false;
    }
}

const onClkToggleCreatePost = () => {
    console.log('click')
    if (!isCreatePostModalOpen) {
        openCreatePost();
        return
    }
    closeCreatePost();
}

const main = document.getElementsByClassName('content')[0]
const searchBar = document.getElementsByClassName('searchbar')[0]
const actionsModal = document.getElementById('actions-modal');
const Modal = document.getElementById('Modal')

var isSearchOpened = false;
var isModalOpen = false;

const openSearchBar = () => {
    if (!isSearchOpened) {
        main.classList.add('sidebar-reducer')
        setTimeout(() => {
            searchBar.classList.add('visible-searchBar')
            searchBar.classList.remove('hide-searchBar')
        }, 500);
        isSearchOpened = true
    }
}

const closeSearchBar = () => {
    if (isSearchOpened) {
        searchBar.classList.remove('visible-searchBar')
        searchBar.classList.add('hide-searchBar')
        setTimeout(() => {
            main.classList.remove('sidebar-reducer')
        }, 500);
        isSearchOpened = false
    }
}

const openMoreActions = () => {
    if (!isModalOpen) {
        Modal.classList.remove('Modal-Slide-Down')
        Modal.classList.add('Modal-Slide-Up')
        isModalOpen = true;
    }
}

const closeMoreActions = () => {
    if (isModalOpen) {
        Modal.classList.add('Modal-Slide-Down')
        Modal.classList.remove('Modal-Slide-Up')
        isModalOpen = false;
    }
}

const onClkSearchBtn = () => {
    if (!isSearchOpened) {
        if (isModalOpen) {
            closeMoreActions()
            setTimeout(() => {
                openSearchBar();
            }, 300);
            return
        }
        openSearchBar();
        return
    }
    closeSearchBar();
}

const onClkMoreActionBtn = () => {
    console.log(Modal)
    if (!isModalOpen) {
        if (isSearchOpened) {
            closeSearchBar()
            setTimeout(() => {
                openMoreActions();
            }, 800);
            return
        }
        openMoreActions();
        return
    }
    closeMoreActions();
}

const PostActionsBtns = document.querySelectorAll('.PostActionsBtn');
const SharePostBtns = document.querySelectorAll('.SharePostBtn');

let isPostActionModalOpen = false;
let isSharePostModalOpen = false;

SharePostBtns.forEach(element => {
    element.onclick = function () {
        const trigger = document.querySelector(element.getAttribute('data-target'));


        const openSharePostModal = () => {
            if (!isSharePostModalOpen) {
                trigger.classList.remove('Modal-Slide-Down')
                trigger.classList.add('Modal-Slide-Up')
                isSharePostModalOpen = true;
            }
        }

        const closeSharePostModal = () => {
            if (isSharePostModalOpen) {
                trigger.classList.add('Modal-Slide-Down')
                trigger.classList.remove('Modal-Slide-Up')
                isSharePostModalOpen = false;
            }
        }

        if (!isSharePostModalOpen) {
            if (isSearchOpened) {
                closeSearchBar()
                setTimeout(() => {
                    openSharePostModal();
                }, 800);
                return
            }
            openSharePostModal();
            return
        }
        closeSharePostModal();
    }
});

PostActionsBtns.forEach(element => {
    element.onclick = function () {
        const trigger = document.querySelector(element.getAttribute('data-target'));


        const openPostActions = () => {
            if (!isPostActionModalOpen) {
                trigger.classList.remove('Modal-Slide-Down')
                trigger.classList.add('Modal-Slide-Up')
                isPostActionModalOpen = true;
            }
        }

        const closePostActions = () => {
            if (isPostActionModalOpen) {
                trigger.classList.add('Modal-Slide-Down')
                trigger.classList.remove('Modal-Slide-Up')
                isPostActionModalOpen = false;
            }
        }

        if (!isPostActionModalOpen) {
            if (isSearchOpened) {
                closeSearchBar()
                setTimeout(() => {
                    openPostActions();
                }, 800);
                return
            }
            openPostActions();
            return
        }
        closePostActions();
    }
});
