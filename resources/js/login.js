import gsap from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("authForm");
    const formTitle = document.getElementById("formTitle");
    const formFields = document.getElementById("formFields");
    const submitBtn = document.getElementById("submitBtn");
    const toggleBtn = document.getElementById("toggleBtn");
    const formLink = document.getElementById("formLink");
    const loginAction = "{{ route('login') }}";
    const registerAction = "{{ route('register') }}";


    let showingLogin = true;

    // Save original height for Login
    const originalHeight = form.offsetHeight;

    const createInput = ({ type, name, placeholder, required }) => {
        const input = document.createElement("input");
        input.type = type;
        input.name = name;
        if (type !== "file" && placeholder) input.placeholder = placeholder; // skip placeholder for files
        if (required) input.required = true;
        input.className = "w-full p-3 border rounded mb-2";
        return input;
    };



    form.style.overflow = "hidden";

    function toggleForm() {
        // Fade out current fields
        gsap.to(formFields.children, {
            autoAlpha: 0,
            y: -10,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {

                // Clear fields
                formFields.innerHTML = "";

                // Update form action dynamically
                if (showingLogin) {
                    form.action = "/register"; // Laravel route for registration
                } else {
                    form.action = "/login"; // Laravel route for login
                }

                if (showingLogin) {
                    // Full register fields
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
                    // Login fields
                    [
                        { type: "email", name: "email", placeholder: "Email", required: true },
                        { type: "password", name: "password", placeholder: "Password", required: true }
                    ].forEach(f => formFields.appendChild(createInput(f)));
                }

                // Update text
                formTitle.textContent = showingLogin ? "Register" : "Login";
                submitBtn.textContent = showingLogin ? "Register" : "Login";
                formLink.textContent = showingLogin ? "Login" : "Register";
                toggleBtn.textContent = showingLogin ? "2" : "1";

                // Calculate dynamic height based on content
                const targetHeight = formFields.scrollHeight + 210; // extra padding for title + button + spacing
                gsap.to(form, { height: targetHeight, duration: 0.5, ease: "power2.out" });

                // Fade in new fields
                gsap.fromTo(formFields.children, { autoAlpha: 0, y: -10 }, { autoAlpha: 1, y: 0, duration: 0.25, stagger: 0.05 });

                showingLogin = !showingLogin;
            }
        });
    }



    toggleBtn.addEventListener("click", toggleForm);
    formLink.addEventListener("click", e => { e.preventDefault(); toggleForm(); });

    // Pin initial height
    form.style.height = originalHeight + "px";
});
