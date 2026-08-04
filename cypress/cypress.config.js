const { defineConfig } = require('cypress');
const path = require('path');

// Define base_path function
const base_path = (relativePath) => path.join(__dirname, relativePath);

module.exports = defineConfig({
  chromeWebSecurity: false,
  retries: 2,
  defaultCommandTimeout: 5000,
  watchForFileChanges: false,
  videosFolder: base_path('cypress/videos'),
  screenshotsFolder: base_path('cypress/screenshots'),
  fixturesFolder: base_path('cypress/fixtures'),
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
    specPattern: base_path('cypress/e2e/**/*.cy.{js,jsx,ts,tsx}'),
    supportFile: base_path('cypress/support/e2e.js'),
    reporter: 'dot',
    video: false,
    screenshotOnRunFailure: false,
  },
});