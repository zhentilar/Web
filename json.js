// JSON dosyasını fetch et
fetch('sorular.json')
    .then(response => response.json())
    .then(data => {
        const quizDiv = document.getElementById('quiz');
        
        // Soruları ekrana yazdır
        data.questions.forEach((soru, index) => {
            const soruDiv = document.createElement('div');
            soruDiv.className = 'soru';
            soruDiv.innerHTML = `
                <p>${index + 1}. ${soru.question}</p>
                ${Object.entries(soru.options).map(([key, value]) => 
                    `<label>
                        <input type="radio" name="soru${index}" value="${key}"> 
                        ${key}: ${value}
                    </label>`
                ).join('<br>')}
            `;
            quizDiv.appendChild(soruDiv);
        });
    });

function sonucuHesapla() {
    const sorular = document.querySelectorAll('.soru');
    let dogru = 0;

    sorular.forEach((soru, index) => {
        const secilen = soru.querySelector(`input[name="soru${index}"]:checked`);
        if (secilen && secilen.value === 'C') {
            dogru++;
        }
    });

    document.getElementById('sonuc').innerHTML = 
        `Toplam ${sorular.length} sorudan ${dogru} doğru yaptınız.`;
}