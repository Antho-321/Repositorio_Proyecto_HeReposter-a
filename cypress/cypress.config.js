const { defineConfig } = require('cypress');

module.exports = defineConfig({
  chromeWebSecurity: false,
  retries: 2,
  defaultCommandTimeout: 5000,
  watchForFileChanges: false,
  videosFolder: './cypress/cypress/videos',
  screenshotsFolder: './cypress/cypress/screenshots',
  fixturesFolder: './cypress/cypress/fixtures',
  headless: true,
  video: false,
  screenshotOnRunFailure: false,
  browser: 'electron',
  viewportWidth: 1280,
  viewportHeight: 720,
  e2e: {
    setupNodeEvents(on, config) {
      on('task', {
        log(message) {
          console.log(message)
          return null
        },
      })
    },
    baseUrl: 'http://localhost:7000',
    specPattern: './cypress/cypress/e2e/**/*.cy.{js,jsx,ts,tsx}',
    supportFile: './cypress/cypress/support/e2e.js',
    reporter: 'dot',
    video: false,
    screenshotOnRunFailure: false,
  },
});