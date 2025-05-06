function form_shop() {

    let form_v = document.getElementById("my_form_2002");

form_v.addEventListener("submit", (e) => {
    e.preventDefault();

    let email_v = document.getElementById("email_2002").value.trim();
    let name_v = document.getElementById("name_f_2002").value.trim();
    let phone_v = document.getElementById("phone_2002").value.trim();
    let errorMsg = document.getElementById("error-msg");

    // Validation using ternary operators
    return (email_v === "" || name_v === "" || phone_v === "")
        ? (errorMsg.textContent = "First fill the form")
        : (!email_v.includes("@") || !email_v.includes("."))
        ? (errorMsg.textContent = "Email format wrong")
        : (isNaN(phone_v) || phone_v.length !== 10)
        ? (errorMsg.textContent = "Enter a valid 10-digit number")
        : (errorMsg.textContent = "Successfully submitted ");
});

}
form_shop();

