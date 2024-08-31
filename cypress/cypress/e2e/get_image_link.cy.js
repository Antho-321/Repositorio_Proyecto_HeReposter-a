const DEFAULT_TIMEOUT = 30000;
const UPLOAD_TIMEOUT = 5000;

describe('Open Postimages and upload image', () => {
  before(() => {
    Cypress.config('defaultCommandTimeout', DEFAULT_TIMEOUT);
    Cypress.config('requestTimeout', DEFAULT_TIMEOUT);
    Cypress.config('responseTimeout', DEFAULT_TIMEOUT);
    Cypress.config('pageLoadTimeout', 60000);
  });

  beforeEach(() => {
    cy.on('uncaught:exception', () => false);
    cy.intercept('GET', '**/googleads.g.doubleclick.net/**', { statusCode: 204 }).as('adBlock');
    cy.intercept('POST', '*').as('postRequests');
  });

  it('Visits Postimages, uploads an image, and logs the direct link', () => {
    cy.visit('https://postimages.org/', { timeout: DEFAULT_TIMEOUT });

    cy.fixture('-m974fi_image.png', 'binary')
      .then(Cypress.Blob.binaryStringToBlob)
      .then((blob) => {
        cy.get('input[type="file"]', { timeout: UPLOAD_TIMEOUT }).attachFile({
          fileContent: blob,
          fileName: '-m974fi_image.png',
          mimeType: 'image/png'
        });
      });

    cy.wait('@postRequests', { timeout: DEFAULT_TIMEOUT });

    cy.url().then((url) => {
      const domain = url.includes('postimg.cc') ? 'https://postimg.cc' : 'https://postimages.org';
      
      if (domain !== 'https://postimages.org') {
        cy.origin(domain, { args: { DEFAULT_TIMEOUT } }, ({ DEFAULT_TIMEOUT }) => {
          cy.get('input#code_direct[type="text"], input[name="code_direct"]', { timeout: DEFAULT_TIMEOUT })
            .should('be.visible')
            .and('not.have.value', '')
            .invoke('val')
            .then((value) => {
              cy.log(`Direct link: ${value}`);
              return cy.wrap(value);
            });
        }).then((directLink) => {
          cy.task('log', { value: directLink, message: Cypress.env('message') }, { log: false });
        });
      } else {
        cy.get('input#code_direct[type="text"], input[name="code_direct"]', { timeout: DEFAULT_TIMEOUT })
          .should('be.visible')
          .and('not.have.value', '')
          .invoke('val')
          .then((value) => {
            cy.task('log', { value, message: Cypress.env('message') }, { log: false });
          });
      }
    });
  });
});

Cypress.on('fail', (error) => {
  console.error('Test failed:', error.message, '\nStack:', error.stack);
  throw error;
});