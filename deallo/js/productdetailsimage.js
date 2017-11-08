// Get the modal







function imgModal(){
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('item-display');
    var modal = document.getElementById('myModal');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}




// When the user click the modal image, it will close
function closemodal(){
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
} 