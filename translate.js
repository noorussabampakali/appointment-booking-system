let translations = {};

// Load translations from JSON
fetch('translations.json')
    .then(response => response.json())
    .then(data => translations = data);

document.getElementById("languageSelect").addEventListener("change", function() {
    let selectedLang = this.value;
    
    document.getElementById("welcomeText").innerText = translations[selectedLang].welcome;
    document.getElementById("contentText").innerText = translations[selectedLang].content;
    document.getElementById("appointmentText").innerText = translations[selectedLang].appointment;
    document.getElementById("contactText").innerText = translations[selectedLang].contact;
});
