function SelectVocab(Id){
    $.post("php/main.php",
    {
      id: Id
    },
    function(data, status){
        if(!status) return;
        var element = document.getElementsByClassName('like')[Id - 1].getElementsByTagName("span")[0];
        element.innerHTML = parseInt(element.innerHTML) + 1;
    });
}