let descripEngSection = $('#russian-description')    // The description section
let exerciseEnSection = $('#russian-exercise')


let demoRandomWords = $('#random-demo-words'); //Demo for random word
let demoChoiceWords = $('#choice-demo-words'); //Choice words demo
let demoTajikWord = $("#demo-text-tajik");
let nextButton = $("#next");
let showAnswerButton = $("#show");
let messageWords = $('.message');
let showALlAnswersBtn = $('#showAllAnswer');



function howManyTask(howMany = 10, btn = false) {
    if(btn !== false && btn.classList.contains('infinity')) {
        showAnswerButton[0].remove();
        nextButton[0].remove();
        $('.next-show').append(`<button id='infinityBtn' class='btn-tsk  activeBtn'>Ҷавоб</button>
                                <button id='nextInfinityBtn' class='btn-tsk'>Баъди</button>`);
    }
    $.ajax({
        url: 'api/russian/get',
        method: "GET",
        data: {howMany},
        success: function (data) {
            startTask(new EnRu(data));
        },
        error: function(){
            console.log('Some problem is here')
        }
    })
}


function startTask(EnRu)  {
    descripEngSection.addClass('hidden');
    exerciseEnSection.removeClass('hidden');

    nextButton.click(function() {
        if(nextButton.hasClass('activeBtn') && EnRu.nextTask()) {
            nextButton.toggleClass('activeBtn');
            showAnswerButton.toggleClass('activeBtn');
        }
    })

    showAnswerButton.click(function(){
        if(showAnswerButton.hasClass('activeBtn') && EnRu.showAnswer()) {
            nextButton.toggleClass('activeBtn');
            showAnswerButton.toggleClass('activeBtn');
        }
    })

    let infinityBtn = $("#infinityBtn");
    infinityBtn.click(function() {
        if(infinityBtn.hasClass('activeBtn') && EnRu.showAnswerInfinity()) {
            infinityBtn.toggleClass('activeBtn');
            nextInfinityBtn.toggleClass('activeBtn');
        }
    });

    let nextInfinityBtn = $("#nextInfinityBtn");
    nextInfinityBtn.click(function() {
        if(nextInfinityBtn.hasClass('activeBtn')) {
            infinityBtn.toggleClass('activeBtn');
            nextInfinityBtn.toggleClass('activeBtn');
            EnRu.nextInfinity();
        }
    })


    showALlAnswersBtn.click(function() {
        EnRu.showAllAnswer();
    })

}

class EnRuHtml{
    /*
    * @task is object
    * task have randomWord and tajik Sentence
    * */
    prepareWordHhtml(task, num) {
        for(let i = 0; i < task.randomWordEn.length; i++ ) {
            let button = this.createElement('button', false,'word');
            button.innerHTML += `
                <span class="text">${task.randomWordEn[i]} </span>
                <i class="fa fa-volume-up listen"></i>
            `;
            demoRandomWords.append(button);
        }
        demoTajikWord.text(num  + task.tjSentence);
        this.addToDemoWord();
    }

    createElement(element,  text, className) {
        let newElement = document.createElement(element);
        if(text) newElement.innerText = text;
        if(className) newElement.classList.add(className);

        return newElement;
    }

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

    clearDemos() {
        demoRandomWords.html('')
        demoChoiceWords.html('');
    }

    isDemoEmpty() {
        return demoRandomWords.find('button').length > 0;
    }

    sayMessage(where, text, format = 0) {
        if(format) {
            where.html(text);
        } else{
            where.text(text);
        }
    }

    getSentenceText() {
        let words = demoChoiceWords.find('button');
        words.filter((index, val) => {
            words[index] =  val.innerText.trim(' ');
        })
        return Array.from(words).join(' ');
    }

    clearClickWordTop() {
        let words = demoChoiceWords.find('button');
        words.filter((index, val) => {
            val.className = ''
        })
    }

    prepareAllAnswer(data) {
        for(let i = 0; i < data.length; i++) {
            let classAnswer = 'danger'
            if(data[i].isCorrect) {
                classAnswer = 'success'
            }
            $('#allAnswer').append(`
                    <div class="answers  bg-white">
                                <div class="trans">
                                    <p class="bold"><span>${i+1}.</span> ${data[i].tajik} </p>
                                </div>
                                <div class="us">
                                    <p><span class="under-l">Асоси:</span> ${data[i].russianAnswer}</p>
                                </div>
                                <div class="your">
                                    <p class="${classAnswer}"><span class="under-l">Шумо:</span> ${data[i].russianUser}</p>
                                </div>
                     </div>` )
        }
        $('.showAllAnswer').removeClass('hidden');
    }

}




class  EnRu extends  EnRuHtml{
    count = 1;
    answers = [];
    constructor(data) {
        super();
        this.data = data;
        if(this.data.length === 1){
            this.infinity(this.data);
        }  else {
            this.prepareWordHhtml(this.parseSentence(this.data[0]), this.count + ". ")
        }
    }

    parseSentence(sentence){
        let randomWordEn = this.doRandomWord(sentence.translate_1.split(' '));
        let tjSentence = sentence.sentence;
        return {randomWordEn, tjSentence};
    }

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
    nextTask() {
        if(this.isDemoEmpty()) {
            return false;
        }

        this.sayMessage(messageWords, "<br>", 1);
        this.clearDemos();
        this.prepareWordHhtml(this.parseSentence(this.data[this.count++]), this.count + ". ");
        return true;
    }

    showAnswerInfinity() {
        if(this.isDemoEmpty()) {
            this.sayMessage(messageWords, "Лутфан интихоб кунед ҳамаи калимаҳоро!");
            setTimeout(() => messageWords.html('<br>'), 2000);
            return false;
        }

        let russianMain = this.data[0].translate_1;
        let russianUser = this.getSentenceText();
        if(russianMain.toLowerCase() === russianUser.toLowerCase()) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
        } else {
            this.sayMessage(messageWords, "Ooops! Шумо нодуруст ҷовоб додед!");
        }
        this.clearClickWordTop();
        return true;
    }

    showAnswer() {
        if(this.isDemoEmpty()) {
            this.sayMessage(messageWords, "Лутфан интихоб кунед ҳамаи калимаҳоро!");
            setTimeout(() => messageWords.html('<br>'), 2000);
            return false;
        }

        let russianMain = this.data[this.count - 1].translate_1;
        let russianUser = this.getSentenceText();
        //For show all answer after finishing
        let tajikSent = this.data[this.count - 1].sentence;
        if(russianMain.toLowerCase() === russianUser.toLowerCase()) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
            this.addAnswerUser(tajikSent, russianMain, russianUser, true);
        } else {
            this.sayMessage(messageWords, "Ooops! Шумо нодуруст ҷовоб додед!");
            this.addAnswerUser(tajikSent, russianMain, russianUser, false);
        }
        this.clearClickWordTop();

        if(this.count == this.data.length) {
            this.sayMessage(messageWords, '<h4 class="success">Офарин! Шумо тамом кардед!</h4>', 1)
            $('.finishedBtn').removeClass('hidden')
            $('.next-show').addClass('hidden')
            return;
        }
        return true;
    }

    showAllAnswer() {
        this.prepareAllAnswer(this.answers);
    }

    addAnswerUser(tajik, answer, userAnswer, isCorrect){
        this.answers.push({
            tajik: tajik,
            russianAnswer: answer,
            russianUser: userAnswer,
            isCorrect: isCorrect
        });
    }

    infinity(data) {
       this.prepareWordHhtml(this.parseSentence(data[0]), '');
    }

    nextInfinity() {
        let obj = this;
        $.ajax({
            url: 'api/russian/get',
            method: "GET",
            data: {howMany: 1},
            success: function (data) {
                obj.sayMessage(messageWords, '<br>', 1);
                obj.clearDemos();
                obj.prepareWordHhtml(obj.parseSentence(data[0]), '');
            },
            error: function(){
                console.log('Some problem is here')
            }
        })
    }



}


function closeAllAnswer() {
    $('#allAnswer').html('')
    $('.showAllAnswer').addClass('hidden')
}

$('#newTask').click(function () {
    window.location.reload();
})



$(document).on("click", function(event){
    if(event.target.classList.contains('listen')){
        let parent = event.target.parentElement;
        let text = parent.innerText;
        var msg = new SpeechSynthesisUtterance();
        msg.text = text;
        window.speechSynthesis.speak(msg);
    }
})
