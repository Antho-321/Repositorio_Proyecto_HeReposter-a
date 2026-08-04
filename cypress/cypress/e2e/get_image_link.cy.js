const DEFAULT_TIMEOUT = 15000; // Reduced from 30000
const UPLOAD_TIMEOUT = 3000; // Reduced from 5000

describe('Open Postimages and upload image', () => {
  before(() => {
    Cypress.config('defaultCommandTimeout', DEFAULT_TIMEOUT);
    Cypress.config('requestTimeout', DEFAULT_TIMEOUT);
    Cypress.config('responseTimeout', DEFAULT_TIMEOUT);
    Cypress.config('pageLoadTimeout', 30000); // Reduced from 60000
  });

  beforeEach(() => {
    cy.on('uncaught:exception', () => false);
    cy.intercept('GET', '**/googleads.g.doubleclick.net/**', { statusCode: 204 }).as('adBlock');
  });

  it('Visits Postimages, uploads an image, and logs the direct link', () => {
    cy.visit('https://postimages.org/', { timeout: DEFAULT_TIMEOUT });

    cy.fixture('image.png', 'binary')
      .then(Cypress.Blob.binaryStringToBlob)
      .then((blob) => {
        cy.get('input[type="file"]', { timeout: UPLOAD_TIMEOUT }).attachFile({
          fileContent: blob,
          fileName: 'image.png',
          mimeType: 'image/png'
        });
      });

    // Replace wait with a more specific assertion
    const domain='https://postimg.cc';
    cy.origin(domain, { args: { DEFAULT_TIMEOUT } }, ({ DEFAULT_TIMEOUT }) => {
        cy.get('input#code_direct[type="text"], input[name="code_direct"]', { timeout: DEFAULT_TIMEOUT })
          .should('be.visible')
          .and('not.have.value', '')
          .invoke('val')
          .then((value) => {
            return cy.wrap(value);
          });
      }).then((directLink) => {
        cy.task('log', { enlace_modelo: directLink }, { log: false });
      });
  });
});

Cypress.on('fail', (error) => {
  console.error('Test failed:', error.message, '\nStack:', error.stack);
  throw error;
});