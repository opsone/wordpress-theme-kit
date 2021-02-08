import { Controller } from 'stimulus'

export default class extends Controller {
  storeControllerInElement() {
    this.element[this.formattedIdentifier] = this
  }

  hasController(targetedIdentifier, { targetedId = false, targetedClass = false } = {}) {
    return (
      this.getController(targetedIdentifier, {
        targetedId,
        targetedClass,
      }) !== null
    )
  }

  getController(targetedIdentifier, { targetedId = false, targetedClass = false } = {}) {
    return this.application.controllers.find(
      this.controllersFilterScope(targetedIdentifier, {
        targetedId,
        targetedClass,
      })
    )
  }

  getControllers(targetedIdentifier, { targetedId = false, targetedClass = false } = {}) {
    return this.application.controllers.filter(
      this.controllersFilterScope(targetedIdentifier, {
        targetedId,
        targetedClass,
      })
    )
  }

  controllersFilterScope(targetedIdentifier, { targetedId = false, targetedClass = false } = {}) {
    return ({
      context: {
        identifier,
        element: { id, classList },
      },
    }) => {
      let condition = identifier === targetedIdentifier

      if (targetedId) {
        condition = identifier === targetedIdentifier && id === targetedId
      } else if (targetedClass) {
        condition =
          identifier === targetedIdentifier && classList.contains(targetedClass)
      }

      return condition
    }
  }

  get formattedIdentifier() {
    return this.identifier
      .split(/[-_]/)
      .map((w) => w.replace(/./, (m) => m.toUpperCase()))
      .join('')
      .replace(/^\w/, (c) => c.toLowerCase())
  }
}
