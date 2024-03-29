let descripEngSection = $('#english-description') // The description section before starting exercise
let exerciseEnSection = $('#english-exercise') //The exercise section for learning by default is hidden


let demoRandomWords = $('#random-demo-words'); //Demo for random word
let demoChoiceWords = $('#choice-demo-words'); //Choice words demo
let demoTajikWord = $("#demo-text-tajik"); //demo for sentence
let nextButton = $("#next"); // next button
let showAnswerButton = $("#show"); // answer button
let messageWords = $('.message'); // demo for showing message
let showALlAnswersBtn = $('#showAllAnswer'); // all answer div


let bgPercent = 0;


// starting task after choosing user how many task wants to do
function howManyTask(howMany = 10, target = false) {
    if(target !== false && target.classList.contains('infinity')) {
        showAnswerButton[0].remove();
        nextButton[0].remove();
        $('.next-show').append(`<button id='infinityBtn' class='btn-tsk  activeBtn'>Ҷавоб</button>
                                <button id='nextInfinityBtn' class='btn-tsk'>Баъди</button>`);
    }
    $.ajax({
        url: 'api/english/get',
        method: "GET",
        data: {howMany},
        header: {
            contentType: "application/json"
        },
        success: function (data) {
            //after request returns object json
            bgPercent = 100 / data.length;
            startTask(new English(data));
        },
        error: function(){
            console.log('Some problem is here')
        }
    })
}

// starting task in page
function startTask(English)  {
    descripEngSection.addClass('hidden');
    exerciseEnSection.removeClass('hidden');

    //next button in 10 or 20 task
    nextButton.click(function() {
        if(nextButton.hasClass('activeBtn') && English.nextTask()) {
            nextButton.toggleClass('activeBtn');
            showAnswerButton.toggleClass('activeBtn');
        }
    })

    //show answer  and start next task
    showAnswerButton.click(function(){
        if(showAnswerButton.hasClass('activeBtn') && English.showAnswer()) {

            //adding width to counter bg
            $('.counter .percent').css({
                width: '+=' + bgPercent + '%',
            })

            nextButton.toggleClass('activeBtn');
            showAnswerButton.toggleClass('activeBtn');
        }
    })

    //infinity task if user choice it
    let infinityBtn = $("#infinityBtn");
    infinityBtn.click(function() {
        if(infinityBtn.hasClass('activeBtn') && English.showAnswerInfinity(English.data[0])) {
            infinityBtn.toggleClass('activeBtn');
            nextInfinityBtn.toggleClass('activeBtn');
        }
    });

    //next button of infinity task
    let nextInfinityBtn = $("#nextInfinityBtn");
    nextInfinityBtn.click(function() {
        if(nextInfinityBtn.hasClass('activeBtn')) {
            infinityBtn.toggleClass('activeBtn');
            nextInfinityBtn.toggleClass('activeBtn');
            English.nextInfinity();
        }
    })

    //showing all correct and incorrect tasks
    showALlAnswersBtn.click(function() {
        English.showAllAnswer();
    })

}





class EnglishHtml{
    /**
    * @task is object
    * task have randomWord and tajik Sentence
    * */
    prepareWordHhtml(task, num) {
        for(let i = 0; i < task.randomWordEn.length; i++ ) {
            if(task.randomWordEn[i] && task.randomWordEn[i] !== ''){
                let button = this.createElement('button', false,'word');
                button.innerHTML += `<span class="text listen">${task.randomWordEn[i]}</span>`;
                demoRandomWords.append(button);
            }
        }
        demoTajikWord.text(num  + task.tjSentence);
        this.addToDemoWord();
    }

    /**
     * Create element
     * @param element
     * @param text
     * @param className
     * @returns {*}
     */
    createElement(element,  text, className) {
        let newElement = document.createElement(element);
        if(text) newElement.innerText = text;
        if(className) newElement.classList.add(className);

        return newElement;
    }

    /**
     * Add button word to checking demo
     * @return void
     */
    addToDemoWord() {
        let words = $('.word .text');
        words.each((item, val) => {
            val.onclick = function()  {
                let parent = $(this).parent('button');
                if(parent.hasClass('choice-word')){
                    parent.removeClass('choice-word');
                    demoRandomWords.append(parent);
                } else  if (parent.hasClass('word')){
                    demoChoiceWords.append(parent)
                    parent.addClass('choice-word');
                }
            }
        })
    }

    /**
     * Clear demos words after clicking next task
     * @return  void
     */
    clearDemos() {
        demoRandomWords.html('')
        demoChoiceWords.html('');
    }

    /**
     * checking are all words choice
     * @returns {boolean}
     */
    isDemoEmpty() {
        return demoRandomWords.find('button').length > 0;
    }

    /**
     * Say message to user if any error
     * @param where
     * @param text
     * @param format
     */
    sayMessage(where, text, format = 0) {
        if(format) {
            where.html(text);
        } else{
            where.text(text);
        }
    }

    /**
     * Getting all words button and make just text for checking
     * @returns {string}
     */
    getSentenseText() {
        let words = demoChoiceWords.find('button');
        words.filter((index, val) => {
            words[index] =  val.innerText.trim(' ');
        })
        return Array.from(words).join(' ');
    }

    /**
     * After showing answer clear all class name of words on top
     * for not choose user
     */
    clearClickWordTop() {
        let words = demoChoiceWords.find('button');
        words.filter((index, val) => {
            val.className = ''
        })
    }

    /**
     * after ending task show all correct and incorrect sentence
     * @param data
     */
    prepareAllAnswer(data) {
        for(let i = 0; i < data.length; i++) {
            let classAnswer = 'danger'
            if(data[i].isCorrect) {
                classAnswer = 'success'
            }
            $('#allAnswer').append(`
                    <div class="answers">
                                <div class="trans">
                                    <p class="bold white"><span>${i+1}.</span> ${data[i].tajik} </p>
                                </div>
                                <div class="us">
                                    <p class="success"><span class="under-l">Асоси:</span> ${data[i].englishAnswer}</p>
                                </div>
                                <div class="your">
                                    <p class="${classAnswer}"><span class="under-l">Шумо:</span> ${data[i].userAnswer}</p>
                                </div>
                     </div>` )
        }
        $('.showAllAnswer').removeClass('hidden');
    }


    /**
     * Getting all words button and make just text for checking
     * @returns {string}
     */
    getSentenceText() {
        let words = demoChoiceWords.find('button');
        words.filter((index, val) => {
            words[index] =  val.innerText.trim(' ');
        })
        return Array.from(words).join(' ');
    }

}


class  English extends  EnglishHtml{

    count = 1;
    answers = [];

    /**
     * Set data sentence
     * @param data
     */
    constructor(data) {
        super();
        this.data = data;
        if(this.data.length === 1){
            this.infinity(this.data);
        }  else {
            this.prepareWordHhtml(this.parseSentence(this.data[0]), this.count + ". ")
        }
    }

    /**
     * Preparing sentence
     * @param sentence
     * @returns Object
     */
    parseSentence(sentence){
        let randomWordEn = this.doRandomWord(sentence.translate1.split(' '));
        let tjSentence = sentence.sentence;
        return {randomWordEn, tjSentence};
    }

    /**
     * Doing random words from sentence
    * @param item
    * @returns array
    */
    doRandomWord(item) {
        let tmp, current, top = item.length;
        if(top) {
            while(--top) {
                current = Math.floor(Math.random() * (top + 1));
                tmp = item[current];
                item[current] = item[top];
                item[top] = tmp;
            }
        }
        return item;
    }

    /**
     * Next task
     * @returns {boolean}
     */
    nextTask() {
        if(this.isDemoEmpty()) {
            return false;
        }

        if (this.count === this.data.length) {
            this.sayMessage(messageWords, '<p class="success">Офарин! Шумо тамом кардед!</p>', 1)
            $('.finishedBtn').removeClass('hidden')
            $('.next-show').addClass('hidden')
            return false;
        }

        this.sayMessage(messageWords, "<br>", 1);
        this.clearDemos();
        this.prepareWordHhtml(this.parseSentence(this.data[this.count++]), this.count + '. ');

        return true;
    }

    /**
     * showing answer in 10 or 20 task
     * @returns {boolean}
     */
    showAnswer() {
        if (this.isDemoEmpty()) {
            this.sayMessage(messageWords, "Лутфан интихоб кунед ҳамаи калимаҳоро!");
            setTimeout(() => messageWords.html('<br>'), 2000);
            return false;
        }

        //the user's answer
        let userAnswer = this.getSentenceText().toLowerCase();

        //db data
        let englishMain = this.data[this.count - 1];
        let translate1 = englishMain.translate1 ? this.removeSpaceFromSentence(englishMain.translate1.toLowerCase()) : '';
        let translate2 = englishMain.translate2 ? this.removeSpaceFromSentence(englishMain.translate2.toLowerCase()) : '';
        let translate3 = englishMain.translate3 ? this.removeSpaceFromSentence(englishMain.translate3.toLowerCase()) : '';

        //For showing all answer after finishing
        let tajikSent = this.data[this.count - 1].sentence;

        if (userAnswer === translate1) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
            this.addAnswerUser(tajikSent, this.firstLetterToUpper(translate1), this.firstLetterToUpper(userAnswer), true);
        } else if (userAnswer === translate2) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
            this.addAnswerUser(tajikSent, this.firstLetterToUpper(translate2), this.firstLetterToUpper(userAnswer), true);
        } else if (userAnswer === translate3) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
            this.addAnswerUser(tajikSent, this.firstLetterToUpper(translate2), this.firstLetterToUpper(userAnswer), true);
        } else {
            this.sayMessage(messageWords, `<p class="danger">Ooops! Шумо нодуруст ҷовоб додед!</p>
                                                <p class='green'>Ҷавоби дуруст: <strong>${this.firstLetterToUpper(translate1)}</strong></p>`, 1);
            this.addAnswerUser(tajikSent, this.firstLetterToUpper(translate1), this.firstLetterToUpper(userAnswer), false);
        }

        this.clearClickWordTop();


        return true;
    }



    /**
     * Showing all answer after end
     */
    showAllAnswer() {
        this.prepareAllAnswer(this.answers);
    }

    /**
     * Add answer user to all answers for showing in end
     * @param tajik
     * @param answer
     * @param userAnswer
     * @param isCorrect
     */
    addAnswerUser(tajik, answer, userAnswer, isCorrect){
        this.answers.push({
            tajik: tajik,
            englishAnswer: answer,
            userAnswer: userAnswer,
            isCorrect: isCorrect
        });
    }

    /**
     * data in infinity task
     * @param data
     */
    infinity(data) {
        this.prepareWordHhtml(this.parseSentence(data[0]), '');
    }


    /**
     * next infinity request
     */
    nextInfinity() {
        let obj = this;
        $.ajax({
            url: 'api/english/get',
            method: "GET",
            data: {howMany: 1},
            success: function (data) {
                obj.prepareNextInfinity(data);
            },
            error: function () {
                console.log('Some problem is here')
            }
        })

    }

    /**
     * @return void
     * @param data
     */
    prepareNextInfinity(data){
        this.data = data;
        this.sayMessage(messageWords, '<br>', 1);
        this.clearDemos();
        this.prepareWordHhtml(this.parseSentence(data[0]), '');
    }

    showAnswerInfinity(data) {

        if(this.isDemoEmpty()) {
            this.sayMessage(messageWords, "Лутфан интихоб кунед ҳамаи калимаҳоро!");
            setTimeout(() => messageWords.html('<br>'), 2000);
            return false;
        }

        //db data
        let englishMain = data;
        let translate1 = englishMain.translate1 ? this.removeSpaceFromSentence(englishMain.translate1.toLowerCase()) : '';
        let translate2 = englishMain.translate2 ? this.removeSpaceFromSentence(englishMain.translate2.toLowerCase()) : '';
        let translate3 = englishMain.translate3 ? this.removeSpaceFromSentence(englishMain.translate3.toLowerCase()) : '';


        let userAnswer = this.getSentenceText().toLowerCase();

        if(userAnswer === translate1 || userAnswer === translate2 || userAnswer === translate3) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
        } else {
            this.sayMessage(messageWords, `<p>Ooops! Шумо нодуруст ҷовоб додед!</p>
                                           <p class='green'>Ҷавоби дуруст: ${this.firstLetterToUpper(translate1)}</p>`, 1);
        }
        this.clearClickWordTop();
        return true;
    }

    /**
     * Make the first letter to upper case
     * @param text
     * @returns {string}
     */
    firstLetterToUpper(text){
        return text.charAt(0).toUpperCase() + text.slice(1);
    }

    /**
     * Remove all space from sentence;
     * @param sentence
     * @return string|null;
     */
    removeSpaceFromSentence(sentence)
    {
        if(sentence) {
            sentence = sentence.split(' ');
            let newSentence = [];
            for(let i in sentence) {
                if(sentence[i] !== '' && sentence[i] !== null){
                   newSentence.push(sentence[i]);
                }
            }
            return newSentence.join(' ');
        }
        return sentence;
    }


}


function closeAllAnswer() {
    $('#allAnswer').html('')
    $('.showAllAnswer').addClass('hidden')
}

$('#newTask').click(function () {
        window.location.reload();
    })
