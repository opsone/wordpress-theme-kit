const fs = require('fs')
const path = require('path')

module.exports.writeFile = (filename, files) => {
  return new Promise((resolve, reject) => {
    fs.readFile(filename, 'utf8', (err, data) => {
      if (err) reject(err)
      let result =
`/*****************************
* Fichier auto-générer       *
* Ne pas modifier ce fichier */
`

      for (let file of files) {
        result += `
import '${file}'`
      }
      result += `
`

      fs.writeFile(filename, result, 'utf8', err => reject(err))
      resolve()
    })
  })
}
