let quizAnswered = false; // Variável de controle para verificar se o quiz já foi respondido corretamente
i = 0;


function checkAnswer() {

    selectedAnswer = document.querySelector('input[name="letra_respondida"]:checked');
    if (selectedAnswer) {
        if (selectedAnswer.value === correctAnswer[i]) {
            selectedAnswer.parentElement.classList.add("correct");
            document.getElementById("resultMessage" + i).textContent = "Resposta correta!";
            quizAnswered = true; // Marcar o quiz como respondido corretamente
        } else {
            selectedAnswer.parentElement.classList.add("incorrect");
            document.getElementById("resultMessage" + i).textContent = "Resposta incorreta!";
        }
        disableRadioButtons(i);// Desativar os radio buttons após a resposta correta
        i++;
    }
}

function disableRadioButtons(i) {
    const radioButtons = document.querySelectorAll('input[type="radio"]' && 'input[name="' + i + '"]');
    radioButtons.forEach((radioButton) => {
        radioButton.disabled = true;
    });
}
