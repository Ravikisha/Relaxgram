const main = document.getElementsByClassName('content')[0]
const searchBar = document.getElementsByClassName('searchbar')[0]
const actionsModal = document.getElementById('actions-modal');
const cryptoModal = document.getElementById('crypto-modal');

var isSearchOpened = false;
var isMoreActionsOpened = false;

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
    if (!isMoreActionsOpened) {
        cryptoModal.classList.remove('cypto-modal-slidedown-animation');
        cryptoModal.classList.add('cypto-modal-slideup-animation');
        isMoreActionsOpened = true;
    }
}

const closeMoreActions = () => {
    if (isMoreActionsOpened) {
        cryptoModal.classList.remove('cypto-modal-slideup-animation');
        cryptoModal.classList.add('cypto-modal-slidedown-animation');
        isMoreActionsOpened = false;
    }
}

const onClkSearchBtn = () => {
    if (!isSearchOpened) {
        if (isMoreActionsOpened) {
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
    if (!isMoreActionsOpened) {
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


//selecting all required elements
const dropArea = document.querySelector(".drag-area"),
    button = dropArea.querySelector("button"),
    input = dropArea.querySelector("input");
let file; //this is a global variable and we'll use it inside multiple functions

const targetEl = document.getElementById('defaultModal');

button.onclick = () => {
    input.click(); //if user click on the button then the input also clicked
}

input.addEventListener("change", function () {
    //getting user select file and [0] this means if user select multiple files then we'll select only the first one
    file = this.files[0];
    dropArea.classList.add("active");
    showFile(); //calling function
});


//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event) => {
    event.preventDefault(); //preventing from default behaviour
    dropArea.classList.add("active");
    dragText.textContent = "Release to Upload File";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event) => {
    event.preventDefault(); //preventing from default behaviour
    //getting user select file and [0] this means if user select multiple files then we'll select only the first one
    file = event.dataTransfer.files[0];
    showFile(); //calling function
});

function showFile() {
    let fileType = file.type; //getting selected file type
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
    if (validExtensions.includes(fileType)) { //if user selected file is an image file
        let fileReader = new FileReader(); //creating new FileReader object
        fileReader.onload = () => {
            let fileURL = fileReader.result; //passing user file source in fileURL variable
            let imgTag = `<div class="border w-[60%] h-full flex justify-center items-center bg-[#F7F7F2]">
            <img class="create-post-modal-img" src=${fileURL} alt="">
          </div>

          <div class="w-[40%] h-full p-3">
            <div class="flex gap-2 items-center">
              <img class="rounded-full h-[30px] w-[30px]" src="/public/imgs/pawan.jpeg" alt="">
              <span class="text-xs font-semibold">pawan_13g</span>
            </div>

            <div class="mt-5">
              <!-- <input type="area" class="appearance-none p-0 outline-none border-0 w-full h-[200px]" placeholder="Write a caption"> -->
              <textarea name="caption-text" class="w-full h-[120px] border-0 bg-[#e7e7e7] rounded-md" placeholder="Write a caption.."></textarea>
            </div>
          </div>`; //creating an img tag and passing user selected file source inside src attribute
            dropArea.classList.toggle('post-section')
            dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
        }
        fileReader.readAsDataURL(file);
    } else {
        alert("This is not an Image File!");
        dropArea.classList.remove("active");
        dragText.textContent = "Drag & Drop to Upload File";
    }
}

const options = {
    placement: 'bottom-right',
    backdrop: 'dynamic',
    backdropClasses: 'hidden',
};
console.log(targetEl)
const modal = new Modal(targetEl, options);
console.log(modal)
