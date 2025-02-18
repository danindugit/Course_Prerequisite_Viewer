const { defineConfig } = require('cypress')

module.exports = defineConfig({
  e2e: {
    baseUrl: 'https://cis3760f23-14.socs.uoguelph.ca',
  },
})