

export default class SessionService {
  static debounce(func, wait, immediate) {
    let timeout
    return function () {
      let context = this, args = arguments
      let later = function () {
        timeout = null
        if (!immediate) func.apply(context, args)
      }
      let callNow = immediate && !timeout
      clearTimeout(timeout)
      timeout = setTimeout(later, wait)
      if (callNow) func.apply(context, args)
    }
  }

  static debounce_promise (task, ms) {
    let t = { promise: null, cancel: _ => void 0 }
    return async (...args) => {
      try {
        t.cancel()
        t = self.deferred(ms)
        await t.promise
        await task(...args)
      }
      catch (_) { /* prevent memory leak */ }
    }
  }

  static deferred (ms) {
    let cancel, promise = new Promise((resolve, reject) => {
      cancel = reject
      setTimeout(resolve, ms)
    })
    return { promise, cancel }
  }

  static debounce_next (fn, delay) {
    let timeoutID = null
    return function () {
      clearTimeout(timeoutID)
      let args = arguments
      let that = this
      timeoutID = setTimeout(function () {
        fn.apply(that, args)
      }, delay)
    }
  }
}