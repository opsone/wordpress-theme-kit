const fs = require('fs')
const path = require('path')
const chokidar = require('chokidar')
const writeFile = require('./utils/index').writeFile
const filename = path.join(__dirname, '../assets/front/js/assets.js')
const dir = './assets/front/files/images'

const files = []

let timer

chokidar.watch(dir, {
  ignored: /(^|[\/\\])\../,
  persistent: true,
}).on('add', file => {
  files.push(`../files/images/${path.basename(file)}`)
}).on('unlink', file => {
  const index = files.indexOf(`../files/images/${path.basename(file)}`)
  if (index > -1) {
    files.splice(index, 1)
  }
}).on('all', () => {
  clearTimeout(timer)
  timer = setTimeout(() => writeFile(filename, files), 500)
})
