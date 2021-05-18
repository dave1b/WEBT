function isValid() {
    let newsletter = document.getElementById('newsletter');
    let email = document.getElementById('email');
    let email2 = document.getElementById('email2');
    console.log(newsletter.checked);
    console.log("hoi");

if(newsletter.checked == true && email.value == "" && email2.value == ""){
    alert('Geben Sie bitte Ihre E-Mail Adresse an.')
    return false;
}
if(newsletter.checked == false && email.value != "" && email2.value != ""){
    alert('Bitte akzeptieren Sie die Checkbox, wenn Sie den Newsletter abbonieren möchten. Ansonsten löschen Sie bitte Ihre Einträge in den E-Mail Feldern.')
    return false;
}


    if (email.value != email2.value) {
        alert('Ihre E-Mail Adresse stimmt nich überein.');
        return false;
    } else if (email == email2) {
        return true;
    }
    return true;
}