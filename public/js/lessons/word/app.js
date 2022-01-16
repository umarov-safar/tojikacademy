/**
 * Demo for showing main word
 * @type {*|jQuery|HTMLElement}
 */
let demoText = $('#demo-text');

/**
 * Demo for random words
 * @type {*|jQuery|HTMLElement}
 */
let demoTranslates = $('#random-demo-words');



class Word {

    /**
     * The count of word for showing next word
     * @type {number}
     */
    count = 0;

    /**
     * set words
     * @param words
     */
    constructor(words) {
        this.words = words;
    }

    /**
     * initialize learning for user
     */
    initialize() {
        let object = this.words[this.count];
        let incorrectWords = this.words[this.count].incorrectWords;
        demoText.text(object.word);
        this.prepareIncorrectWords(object.correct, incorrectWords);
    }

    /**
     * Preparing word for user
     * create button
     * @param correct
     * @param incorrectWords
     */
    prepareIncorrectWords(correct, incorrectWords) {
        incorrectWords = this.doRandomIncorrectWords(incorrectWords);
        for(let iW in incorrectWords){
            let html;
            if(incorrectWords[iW].toLowerCase() == correct.toLowerCase())
            {
                html = `<button class="word correct">
                   <span class="text">${incorrectWords[iW]}</span>
                </button>`;
            } else {
                html = `<button class="word">
                   <span class="text">${incorrectWords[iW]}</span>
                </button>`;
            }
            demoTranslates.append(html);
        }

    }

    /**
     * Make random incorrect words and returns array
     * @param  incorrectWord
     * @returns {*}
     */
    doRandomIncorrectWords (incorrectWord) {
        let tmp, current, top = incorrectWord.length;
        if(top) {
            while(--top) {
                current = Math.floor(Math.random() * (top + 1));
                tmp = incorrectWord[current];
                incorrectWord[current] = incorrectWord[top];
                incorrectWord[top] = tmp;
            }
        }
        return incorrectWord;
    }


    nextWord() {

        this.count++;

        if (this.count >= this.words.length) {
            $('#end-message').html(`<h3>Офарин! Шумо ${this.count} луғат омухтед.</h3>`);

            demoTranslates.find('.word').removeClass('word');

            return null;
        }

        demoTranslates.html('');

        let object = this.words[this.count];
        let incorrectWords = this.words[this.count].incorrectWords;
        demoText.text(object.word);
        this.prepareIncorrectWords(object.correct, incorrectWords);

        this.showAnswerEvent();
    }


    showAnswerEvent() {
        $('button.word').click(function(){
            if($(this).hasClass('correct')){
                $(this).addClass('correct-answer');
            } else {
                $(this).addClass('wrong-answer');
                $('button.correct').addClass('correct-answer');
            }

            $('button.next').addClass('activeBtn');

        })
    }
}

// words is from blade and has array of object words


word = new Word(words);
word.initialize();
word.showAnswerEvent();

$('#next').click(function() {
    if($(this).hasClass('activeBtn')){
        word.nextWord();
        $(this).removeClass('activeBtn');
    }
})
