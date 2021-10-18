let descripEngSection = $('#english-description')    // The description section
let exerciseEnSection = $('#english-exercise')


let demoRandomWords = $('#random-demo-words'); //Demo for random word
let demoChoiceWords = $('#choice-demo-words'); //Choice words demo
let demoTajikWord = $("#demo-text-tajik");
let nextButton = $("#next");
let showAnswerButton = $("#show");
let messageWords = $('.message');
let showALlAnswersBtn = $('#showAllAnswer');


function howManyTask(how = 10) {
    $.ajax({
        url: 'english/get',
        method: "GET",
        data: {howMany: how},
        success: function (data) {
            descripEngSection.addClass('hidden');
            exerciseEnSection.removeClass('hidden');
            startTask(new EnRu(data));
        },
        error: function(){
            console.log('Some problem is here')
        }
    })
}


function startTask(EnRu)  {

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
            let button = document.createElement("button");
            button.classList.add('word');
            button.innerText = task.randomWordEn[i];
            demoRandomWords.append(button);
        }
        demoTajikWord.text(num + ". " + task.tjSentence);
        this.adToDemoWord();
    }

    adToDemoWord() {
        let words = $('.word');
        words.each((item, val) => {
            val.onclick = function()  {
               if(this.classList.contains('choice-word')){
                   this.classList.remove('choice-word');
                   demoRandomWords.append(this);
               } else  if (this.classList.contains('word')){
                   demoChoiceWords.append(this)
                   this.classList.add('choice-word');
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

    getSentenseText() {
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
                                    <p><span class="under-l">Асоси:</span> ${data[i].englishAnswer}</p>
                                </div>
                                <div class="your">
                                    <p class="${classAnswer}"><span class="under-l">Шумо:</span> ${data[i].englishUser}</p>
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
        this.data = JSON.parse(data);
        this.prepareWordHhtml(this.parseSentence(this.data[0]), this.count)
    }

    parseSentence(sentence){
        let randomWordEn = this.doRandomWord(sentence.english.split(' '));
        let tjSentence = sentence.tajik;
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
        this.prepareWordHhtml(this.parseSentence(this.data[this.count++]), this.count);
        return true;
    }

    showAnswer() {
        if(this.isDemoEmpty()) {
            this.sayMessage(messageWords, "Лутфан интихоб кунед ҳамаи калимаҳоро!");
            setTimeout(() => messageWords.html('<br>'), 2000);
            return false;
        }

        let englishMain = this.data[this.count - 1].english;
        let englishUser = this.getSentenseText();
        //For show all answer after finishing
        let tajikSent = this.data[this.count - 1].tajik;
        if(englishMain.toLowerCase() === englishUser.toLowerCase()) {
            this.sayMessage(messageWords, '<span class="success">Офарин! Шумо дуруст ҷавоб  додед!</span>', 1);
            this.addAnswerUser(tajikSent, englishMain, englishUser, true);
        } else {
            this.sayMessage(messageWords, "Ooops! Шумо нодуруст ҷовоб додед!");
            this.addAnswerUser(tajikSent, englishMain, englishUser, false);
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
            englishAnswer: answer,
            englishUser: userAnswer,
            isCorrect: isCorrect
        });
    }

}



function closeAllAnswer() {
    $('#allAnswer').html('')
    $('.showAllAnswer').addClass('hidden')
}



