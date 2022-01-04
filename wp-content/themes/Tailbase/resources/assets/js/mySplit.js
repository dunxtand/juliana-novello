import Splitting from "splitting";

// Will apply incremental opacity transition to any text content assigned class 'splitMeByWord'

export default function() {
  const wordTarget = document.getElementsByClassName('splitMeByWord');

  for (let i = 0; i < wordTarget.length; i++) {

    const delay = parseInt(wordTarget[i].dataset.delay) || 0;

    setTimeout(() => {
      wordTarget[i].style.opacity = 1; // show element (0 on load)

      const results = Splitting({ target: wordTarget[i], by: 'lines' });

      results[0]['lines'].forEach(
        (element, index) => element.forEach(
          (jelement, jindex) => {
            jelement.classList.add("line-"+index);
            jelement.classList.add("word-"+jindex);
          }
        )
      );
    }, delay);
  }


  const lineTarget = document.getElementsByClassName('splitMeByLine');

  for (let i = 0; i < lineTarget.length; i++) {

    const delay = parseInt(lineTarget[i].dataset.delay) || 0;

    setTimeout(() => {
      lineTarget[i].style.opacity = 1; // show element (0 on load)

      const results = Splitting({ target: lineTarget[i], by: 'lines' });

      results[0]['lines'].forEach(
        (element, index) => element.forEach(
          jelement => {
            jelement.classList.add("line-"+index);
          }
        )
      );
    }, delay);
  }
}
