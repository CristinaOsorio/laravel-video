function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById('toggleIcon-' + id);
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        return;
    }
    
    input.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
    
}

window.togglePasswordVisibility = togglePasswordVisibility;

export default togglePasswordVisibility;