const fs = require('fs')
const path = require('path')
const writeFile = require('./utils/index').writeFile
const filename = path.join(__dirname, '../assets/front/js/assets.js')
const dir = './assets/front/files/images'

fs.readdir(dir, (err, files) => {
  const data = []

  for (let file of files) {
    if (file === '.DS_Store' || file === '.gitkeep') {
      continue
    }
    data.push(`../files/images/${file}`)
  }

  writeFile(filename, data)
})
