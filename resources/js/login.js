import gsap from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("authForm");
    const formTitle = document.getElementById("formTitle");
    const formFields = document.getElementById("formFields");
    const submitBtn = document.getElementById("submitBtn");
    const formLink = document.getElementById("formLink");



    let showingLogin = true;

    const originalHeight = form.offsetHeight;

    const createInput = ({ type, name, placeholder, required }) => {
        const input = document.createElement("input");
        input.type = type;
        input.name = name;
        if (type !== "file" && placeholder) input.placeholder = placeholder;
        if (required) input.required = true;
        input.className = "w-full p-3 border rounded mb-2";
        return input;
    };



    form.style.overflow = "hidden";

    function toggleForm() {
        // inklappen
        gsap.to(formFields.children, {
            autoAlpha: 0,
            y: -10,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {


                formFields.innerHTML = "";


                if (showingLogin) {
                    form.action = "/register";
                } else {
                    form.action = "/login";
                }

                if (showingLogin) {
                    [
                        { type: "text", name: "firstname", placeholder: "First Name", required: true },
                        { type: "text", name: "middlename", placeholder: "Middle Name", required: false },
                        { type: "text", name: "lastname", placeholder: "Last Name", required: true },
                        { type: "file", name: "profilepicture", placeholder: "Profile Picture", required: false },
                        { type: "text", name: "phonenumber", placeholder: "Phone Number", required: false },
                        { type: "email", name: "email", placeholder: "Email", required: true },
                        { type: "password", name: "password", placeholder: "Password", required: true },
                        { type: "password", name: "password_confirmation", placeholder: "Confirm Password", required: true }
                    ].forEach(f => formFields.appendChild(createInput(f)));
                } else {

                    [
                        { type: "email", name: "email", placeholder: "Email", required: true },
                        { type: "password", name: "password", placeholder: "Password", required: true }
                    ].forEach(f => formFields.appendChild(createInput(f)));
                }


                formTitle.textContent = showingLogin ? "Register" : "Login";
                submitBtn.textContent = showingLogin ? "Register" : "Login";
                formLink.textContent = showingLogin ? "Login" : "Register";


                const targetHeight = formFields.scrollHeight + 210;
                gsap.to(form, { height: targetHeight, duration: 1, ease: "power2.out" });


                gsap.fromTo(formFields.children, { autoAlpha: 0, y: -10 }, { autoAlpha: 1, y: 0, duration: 0.25, stagger: 0.05 });

                showingLogin = !showingLogin;
            }
        });
    }




    formLink.addEventListener("click", e => { e.preventDefault(); toggleForm(); });


    form.style.height = originalHeight + "px";
});
