import $ from 'jquery'

const toto = () => {
  return 'toto'
}

setTimeout(function() {
  console.log(toto())
  $('body').css('background-color', 'blue')
}, 1000)
