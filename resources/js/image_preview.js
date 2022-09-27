const placeholder =
    "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png";
const preview = document.getElementById("preview");
const imageField = document.getElementById("image-field");

imageField.addEventListener("input", () => {
    // if(imageField.value) preview.src= imageField.value;
    // else preview.src = placeholder;

    preview.src = imageField.value || placeholder;
});
