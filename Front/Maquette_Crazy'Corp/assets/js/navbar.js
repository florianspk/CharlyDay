function myFunction() {
    let input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("inputFocus");
    filter = input.value.toUpperCase();
    console.log(filter);
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

let btnDelete = document.getElementById('clear');
let inputFocus = document.getElementById('inputFocus');
btnDelete.addEventListener('click', function(e)
{
    e.preventDefault();
    inputFocus.value = ''
});
document.addEventListener('click', function(e)
{
    if (document.getElementById('first').contains(e.target))
    {
        inputFocus.classList.add('isFocus')
    }
    else
    {
        inputFocus.classList.remove('isFocus')
    }
});
