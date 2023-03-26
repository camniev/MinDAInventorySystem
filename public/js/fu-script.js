//CAMERON
// scripts for file upload
const divForm = document.querySelector(".div-fu-form"),
fileInput = document.querySelector(".file-input"),
uploadedArea = document.querySelector(".uploaded-area");

// form click event
divForm.addEventListener("click", () =>{
	fileInput.click();
});

fileInput.onchange = ({target})=>{
  let file = target.files[0]; //getting file [0] this means if user has selected multiple files then get first one only
  if(file){
    let fileName = file.name; //getting file name
    let fileSize = file.size;
    if(fileName.length >= 12){ //if file name length is greater than 12 then split it and add ...
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }
    uploadFile(fileName, fileSize); //calling uploadFile with passing file name as an argument
  }
}

// display file uploaded script
function uploadFile(name, fileSize){
    fileSizeFormatted = (fileSize / (1024*1024)).toFixed(2) + " MB";
    let uploadedHTML = `<li class="row-upload">
                          <div class="fu-content upload">
                            <i class="fas fa-file-excel-o"></i>
                            <div class="details">
                              <span class="name">${name} • Ready for Upload</span>
                              <span class="size">${fileSizeFormatted}</span>
                            </div>
                          </div>
                          <i class="fas fa-upload"></i>
                        </li>`;
    uploadedArea.classList.remove("onprogress");
    uploadedArea.innerHTML = uploadedHTML; 
}