// JavaScript File
      // Your JavaScript goes here
      var randomNumber = Math.floor(Math.random() * 99) + 1;
      var guesses = document.querySelector('#guesses');
      var lastResult = document.querySelector('#lastResult');
      var lowOrHi = document.querySelector('#lowOrHi');
      var lost = document.querySelector('#lost');
      var won = document.querySelector('#won');

      var guessSubmit = document.querySelector('.guessSubmit');
      var guessField = document.querySelector('.guessField');
      
    
      var guessCount = 1;
      var timesRan = 0;
      var timesWon = 0;
      var timesLost = 0;
      var resetButton = document.querySelector('#reset');
      resetButton.style.display = 'none';
      guessField.focus();
      
      function checkGuess() {
            var userGuess = Number(guessField.value);
            if (guessCount === 1) {
                guesses.innerHTML = 'Previous guesses: ';
                won.innerHTML = 'Times Won: ' + timesWon;
                lost.innerHTML = 'Times Lost: ' + timesLost;
            }
            if(timesRan > 0){
                won.innerHTML = 'Times Won: ' + timesWon;
                lost.innerHTML = 'Times Lost:  ' + timesLost;
            }
            guesses.innerHTML += userGuess + ' ';
            
              if (userGuess === randomNumber) {
                lastResult.innerHTML = 'Congratulations! You got it right!';
                lastResult.style.backgroundColor = 'green';
                lowOrHi.innerHTML = '';
                timesWon++;
                timesLost++;
                setGameOver();
              } else if (guessCount === 7) {
                lastResult.innerHTML = 'Sorry, you lost!';
                timesLost++;
                setGameOver();
              } else {
                lastResult.innerHTML = 'Wrong!';
                lastResult.style.backgroundColor = 'red';
                if(userGuess.isNaN){
                  lowOrHi.innerHTML = 'Not an appropriete value!'; 
                }
                else if(userGuess < randomNumber) {
                  lowOrHi.innerHTML = 'Last guess was too low!';
                }
                else if(userGuess > 99 ){
                  lowOrHi.innerHTML = 'Not an appropriete value!';
                }
                else if(userGuess > randomNumber) {
                  lowOrHi.innerHTML = 'Last guess was too high!';
                }
              }
              timesRan++;
              guessCount++;
              guessField.value = '';
              guessField.focus();
      }
      
      guessSubmit.addEventListener('click', checkGuess);
      
      function setGameOver() {
        guessField.disabled = true;
        guessSubmit.disabled = true;
        resetButton.style.display = 'inline';
        resetButton.addEventListener('click', resetGame);
      }
      
      function resetGame() {
        guessCount = 1;
      
        var resetParas = document.querySelectorAll('.resultParas p');
        for (var i = 0 ; i < resetParas.length ; i++) {
          resetParas[i].textContent = '';
        }
      
        resetButton.style.display = 'none';
      
        guessField.disabled = false;
        guessSubmit.disabled = false;
        guessField.value = '';
        guessField.focus();
      
        lastResult.style.backgroundColor = 'white';
      
        randomNumber = Math.floor(Math.random() * 99) + 1;
        
        
        
        
      }